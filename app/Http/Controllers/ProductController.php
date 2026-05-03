<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log; // Tambahkan untuk logging
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk (Web)
     */
    public function index()
    {
        // Eager loading agar tidak terjadi N+1 query problem
        $products = Product::with(['user', 'category'])->get();

        return view('product.index', compact('products'));
    }

    /**
     * Form tambah produk
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('product.create', compact('users', 'categories'));
    }

    /**
     * Simpan produk baru (Web)
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $validated = $request->validated();
            
            // Opsional: Pastikan user_id terisi otomatis dari user yang login jika tidak dikirim dari form
            if (!isset($validated['user_id'])) {
                $validated['user_id'] = auth()->id();
            }

            Product::create($validated);

            return redirect()->route('product.index')->with('success', 'Product created successfully.');
        } catch (\Throwable $e) {
            Log::error('Gagal simpan produk: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    /**
     * Detail produk
     */
    public function show($id)
    {
        $product = Product::with(['category', 'user'])->findOrFail($id);

        return view('product.view', compact('product'));
    }

    /**
     * Form edit produk (Protected by Policy)
     */
    public function edit(Product $product)
    {
        // [PERTEMUAN 5] Otorisasi Policy
        Gate::authorize('update', $product);

        $categories = Category::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('product.edit', compact('product', 'users', 'categories'));
    }

    /**
     * Update data produk (Protected by Policy)
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        // [PERTEMUAN 5] Otorisasi Policy
        Gate::authorize('update', $product);

        $validated = $request->validated();
        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Hapus produk (Protected by Policy)
     */
    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // [PERTEMUAN 5] Otorisasi Policy
        Gate::authorize('delete', $product);

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus');
    }

    /**
     * [TAMBAHAN TUGAS] Fungsi Export (Protected by Gate)
     */
    public function export()
    {
        // Cek Gate 'export-product' dari AppServiceProvider
        if (!Gate::allows('export-product')) {
            abort(403, 'Anda tidak memiliki akses untuk export data.');
        }

        // Contoh download file, pastikan file-contoh.xlsx ada di folder public/
        $filePath = public_path('file-contoh.xlsx');

        if (!file_exists($filePath)) {
            return back()->with('error', 'File template export tidak ditemukan.');
        }

        return response()->download($filePath); 
    }
}