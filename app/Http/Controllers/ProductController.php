<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Category; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        // Eager loading 'user' dan 'category' agar performa tetap kencang
        $products = Product::with(['user', 'category'])->get();

        return view('product.index', compact('products'));
    }

    public function create()
    {
        // Mengambil data kategori untuk dropdown di form
        $categories = Category::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('product.create', compact('users', 'categories'));
    }

    /**
     * PERTEMUAN 6: Menggunakan StoreProductRequest untuk Validasi
     */
    public function store(StoreProductRequest $request)
    {
        // Data category_id sudah divalidasi di StoreProductRequest
        $validated = $request->validated();

        Product::create($validated);

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        // Load category juga saat melihat detail produk
        $product = Product::with('category')->findOrFail($id);

        return view('product.view', compact('product'));
    }

    public function edit(Product $product)
    {
        // [PERTEMUAN 5] Otorisasi Policy
        Gate::authorize('update', $product);

        $categories = Category::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view('product.edit', compact('product', 'users', 'categories'));
    }

    /**
     * PERTEMUAN 6: Menggunakan UpdateProductRequest untuk Validasi
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        // [PERTEMUAN 5] Otorisasi Policy
        Gate::authorize('update', $product);

        // Ambil data yang sudah lolos validasi (termasuk category_id)
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
        // Menggunakan Gate untuk rule akses khusus Admin
        Gate::authorize('export-product');
        
        return "Fungsi export sedang dalam pengembangan. Hanya Admin yang bisa melihat pesan ini.";
    }
}