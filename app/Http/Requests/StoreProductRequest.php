<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Ubah ke true agar diizinkan
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|min:3|max:255',
            'quantity' => 'required|integer|min:1',
            'price'    => 'required|numeric|min:0',
            'user_id'  => 'required|exists:users,id',
            'category_id' => 'required|exists:category,id'
        ];
    }

  public function messages(): array
    {
        return [
            'name.required'     => 'Nama produk jangan dikosongin ya!',
            'name.min'          => 'Nama produk minimal 3 huruf dong.',
            'quantity.min'      => 'Stok minimal harus 1 ya.', // Tambahan
            'price.numeric'     => 'Harga harus berupa angka.',
            'price.min'         => 'Masa harganya gratis? Kasih minimal 0 deh.', 
            'category_id.required' => 'Pilih kategorinya dulu!'// Tambahan
        ];
    }
}
