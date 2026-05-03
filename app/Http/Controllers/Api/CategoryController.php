<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * GET: List semua kategori
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'message' => 'Success retrieve categories',
            'data' => $categories
        ], 200);
    }

    /**
     * POST: Simpan kategori baru
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|unique:category,name',
            ]);

            $category = Category::create($validated);

            return response()->json([
                'message' => 'Category created successfully',
                'data' => $category
            ], 201);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * GET: Detail satu kategori
     */
    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json(['data' => $category], 200);
    }

    /**
     * PUT: Update kategori
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) return response()->json(['message' => 'Not found'], 404);

        $category->update($request->all());

        return response()->json([
            'message' => 'Category updated',
            'data' => $category
        ], 200);
    }

    /**
     * DELETE: Hapus kategori
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) return response()->json(['message' => 'Not found'], 404);

        $category->delete();
        // Ganti 204 menjadi 200 biar pesannya muncul
        return response()->json(['message' => 'Category deleted'], 200);
    }
}