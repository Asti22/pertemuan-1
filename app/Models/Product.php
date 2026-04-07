<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambahkan ini jika ada

class Product extends Model
{
    use HasFactory;

    // Tambahkan baris di bawah ini:
    protected $fillable = [
        'name',
        'quantity',
        'price',
        'user_id',
    ];
    
    // Relasi ke User (opsional, tapi berguna untuk tampilan Owner)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}