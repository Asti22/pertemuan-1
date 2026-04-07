<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate; // Tambahkan ini

class ProductController extends Controller
{
    public function index()
    {
        // Menggunakan with('user') agar loading lebih cepat (Eager Loading)
        $products = Product::with('user')->get();

        return view('product.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ]);

        Product::create($validated);

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('product.create', compact('users'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product.view', compact('product'));
    }

    public function edit(Product $product)
    {
        // [PERTEMUAN 5] Cek apakah user boleh edit produk ini
        Gate::authorize('update', $product);

        $users = User::orderBy('name')->get();

        return view('product.edit', compact('product', 'users'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // [PERTEMUAN 5] Proteksi saat proses update
        Gate::authorize('update', $product);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'quantity' => 'sometimes|integer',
            'price' => 'sometimes|numeric',
            'user_id' => 'sometimes|exists:users,id',
        ]);

        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // [PERTEMUAN 5] Proteksi saat proses delete
        Gate::authorize('delete', $product);

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus');
    }

    // [TAMBAHAN TUGAS KELAS B] Fungsi Export Dummy
    public function export()
    {
        Gate::authorize('export-product');
        
        return "Fungsi export sedang dalam pengembangan. Hanya Admin yang bisa melihat pesan ini.";
    }
}