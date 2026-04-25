<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database (Sesuai modul UCP: 'category')
     */
    protected $table = 'category';

    /**
     * Kolom yang boleh diisi secara massal (Mass Assignment)
     */
    protected $fillable = ['name'];

    /**
     * Relasi One-to-Many ke Tabel Product
     * Digunakan untuk menghitung total product di UCP 1
     */
    public function products(): HasMany
    {
        // Parameter kedua adalah foreign key 'category_id' yang ada di tabel product
        return $this->hasMany(Product::class, 'category_id');
    }
}