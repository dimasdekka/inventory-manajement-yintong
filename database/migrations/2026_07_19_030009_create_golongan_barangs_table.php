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
        Schema::create('golongan_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');
            $table->string('kode_golongan', 10);
            $table->string('nama_golongan', 100);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->unique(['kategori_id', 'kode_golongan']);
        });

        Schema::table('barang', function (Blueprint $table) {
            $table->foreignId('golongan_id')->nullable()->after('kategori_id')->constrained('golongan_barang')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropForeign(['golongan_id']);
            $table->dropColumn('golongan_id');
        });

        Schema::dropIfExists('golongan_barang');
    }
};
