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
        Schema::create('aset_tetaps', function (Blueprint $table) {
            $table->id();
            $table->string('kode_aset')->unique();
            $table->string('nama_aset');
            $table->enum('tipe', ['ruko', 'kantor', 'mess_karyawan']);
            $table->text('alamat');
            $table->integer('luas_tanah'); // m2
            $table->integer('luas_bangunan'); // m2
            $table->date('tanggal_perolehan');
            $table->decimal('nilai_perolehan', 15, 2);
            $table->enum('status_kepemilikan', ['milik_sendiri', 'sewa']);
            $table->enum('kondisi_bangunan', ['baik', 'perlu_perbaikan', 'rusak_berat']);
            $table->string('pic');
            $table->text('keterangan')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset_tetaps');
    }
};
