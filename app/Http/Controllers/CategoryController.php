<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * TAMPILAN LIST: Menampilkan semua kategori + jumlah produk
     */
    public function index()
    {
        // withCount('products') mengambil data relasi otomatis
        $categories = Category::withCount('products')->get();
        return view('category.index', compact('categories'));
    }

    /**
     * FORM TAMBAH: Menampilkan halaman create
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * PROSES SIMPAN: Menyimpan data kategori baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:category,name|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('category.index')->with('success', 'Category added successfully!');
    }

    /**
     * FORM EDIT: Menampilkan halaman edit untuk kategori tertentu
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * PROSES UPDATE: Memperbarui data kategori
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:category,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('category.index')->with('success', 'Category updated!');
    }

    /**
     * PROSES HAPUS: Menghapus kategori
     */
    public function destroy(Category $category)
    {
        // Karena di migration kita pakai cascadeOnDelete,
        // semua produk dalam kategori ini akan otomatis ikut terhapus.
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted!');
    }
}