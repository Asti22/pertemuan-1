<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Pastikan nama tabelnya 'products' (sesuai database kamu)
        Schema::table('products', function (Blueprint $table) {
            // Kita arahkan constrained ke 'category' (sesuai permintaan modul UCP)
            $table->foreignId('category_id')
                  ->nullable()
                  ->after('user_id')
                  ->constrained('category') // Ubah dari 'categories' ke 'category'
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Gunakan array untuk drop foreign agar aman
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};