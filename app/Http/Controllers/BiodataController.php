<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BiodataController extends Controller
{
    public function index()
    {
        return view('about', [
            'nama' => 'Asti Nurul Utami',
            'nim' => '20230140217',
            'prodi' => 'Teknologi Informasi',
            'hobi' => 'Membaca dan Belajar Coding'
        ]);
    }
}