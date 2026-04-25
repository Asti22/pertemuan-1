<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database (Jika kamu mengikuti modul, pastikan namanya 'product' atau 'products')
     */
    protected $table = 'products';

    /**
     * Mass Assignment: Tambahkan 'category_id' agar bisa disimpan saat Create/Update
     */
    protected $fillable = [
        'name',
        'quantity',
        'price',
        'user_id',
        'category_id', // Tambahkan ini untuk UCP 1
    ];

    /**
     * Relasi ke User (Owner Produk)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Category (Sesuai tugas UCP 1)
     */
    public function category(): BelongsTo
    {
        // Parameter kedua adalah foreign key yang kita buat di migration tadi
        return $this->belongsTo(Category::class, 'category_id');
    }
}