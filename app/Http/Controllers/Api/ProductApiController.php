<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * GET: List semua produk
     */
    public function index()
    {
        // Mengambil semua produk beserta relasi kategorinya
        // Pastikan di Model Product sudah ada method category()
        $products = Product::with('category')->get();

        return response()->json([
            'message' => 'Success retrieve products',
            'data' => $products
        ], 200);
    }

    /**
     * POST: Simpan produk baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'quantity'    => 'required|integer',
            'category_id' => 'required|exists:category,id', // Sesuai nama tabel kamu 'category'
        ]);

        $data = $request->all();

        /**
         * Penanganan user_id:
         * Jika kamu sudah pakai Auth (Sanctum/Session), gunakan auth()->id().
         * Jika sedang testing tanpa login, kita hardcode ke ID 1 agar tidak error Null.
         */
        $data['user_id'] = auth()->id() ?? 2; 

        $product = Product::create($data);

        return response()->json([
            'message' => 'Produk berhasil ditambahkan!',
            'data' => $product
        ], 201);
    }

    /**
     * GET: Detail satu produk
     */
    public function show($id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        return response()->json([
            'message' => 'Success retrieve product detail',
            'data' => $product
        ], 200);
    }

    /**
     * PUT: Update data produk
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'quantity'    => 'required|integer',
            'category_id' => 'required|exists:category,id', // Sesuai nama tabel kamu 'category'
        ]);

        // Tetap pastikan user_id tidak hilang saat update jika diperlukan
        $data = $request->all();
        if (!$product->user_id) {
            $data['user_id'] = auth()->id() ?? 2;
        }

        $product->update($data);

        return response()->json([
            'message' => 'Produk berhasil diupdate!',
            'data' => $product
        ], 200);
    }

    /**
     * DELETE: Hapus produk
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Produk berhasil dihapus'
        ], 200);
    }
}