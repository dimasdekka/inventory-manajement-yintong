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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 30)->unique();
            $table->string('nama_barang', 150);
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('restrict');
            $table->foreignId('supplier_id')->nullable()->constrained('supplier')->onDelete('restrict');
            $table->string('merek', 100)->nullable();
            $table->text('spesifikasi')->nullable();
            $table->integer('jumlah')->default(0);
            $table->string('satuan', 20);
            $table->string('lokasi_penyimpanan', 150);
            $table->enum('kondisi_barang', ['baik', 'rusak_ringan', 'rusak_berat'])->default('baik');
            $table->date('tanggal_masuk');
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('total_nilai_aset', 18, 2)->default(0.00);
            $table->string('pic', 100)->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('stok_minimum')->default(5);
            $table->string('barcode_path', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
