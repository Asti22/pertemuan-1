<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
// IMPORT Form Request buatan kita
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        // Eager Loading 'user' agar tidak lambat saat narik data
        $products = Product::with('user')->get();

        return view('product.index', compact('products'));
    }

    /**
     * PERTEMUAN 6: Menggunakan StoreProductRequest untuk Validasi
     */
    public function store(StoreProductRequest $request)
    {
        // Laravel otomatis menjalankan validasi sebelum masuk ke sini.
        // Jika gagal, user langsung dikembalikan ke form dengan pesan error.
        
        $validated = $request->validated();

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
        // [PERTEMUAN 5] Otorisasi Policy
        Gate::authorize('update', $product);

        $users = User::orderBy('name')->get();

        return view('product.edit', compact('product', 'users'));
    }

    /**
     * PERTEMUAN 6: Menggunakan UpdateProductRequest untuk Validasi
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        // [PERTEMUAN 5] Otorisasi Policy
        Gate::authorize('update', $product);

        // Ambil data yang sudah lolos validasi
        $validated = $request->validated();

        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        // [PERTEMUAN 5] Otorisasi Policy
        Gate::authorize('delete', $product);

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus');
    }

    /**
     * [TAMBAHAN TUGAS KELAS B] Fungsi Export
     */
    public function export()
    {
        Gate::authorize('export-product');
        
        return "Fungsi export sedang dalam pengembangan. Hanya Admin yang bisa melihat pesan ini.";
    }
}