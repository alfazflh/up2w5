<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('apars', function (Blueprint $table) {
            $table->id();
            $table->string('id_apar');
            $table->string('lokasi');
            $table->string('isi_apar');
            $table->string('kapasitas');
            $table->date('masa_berlaku');
            $table->string('pressure_gauge')->nullable();
            $table->string('segel')->nullable();
            $table->string('selang')->nullable();
            $table->string('klem_selang')->nullable();
            $table->string('handle')->nullable();
            $table->string('kondisi_fisik')->nullable();
            $table->string('kesimpulan')->nullable();
            $table->date('tanggal_pemeriksaan')->nullable();
            $table->string('petugas')->nullable();
            $table->string('pengawas')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apars');
    }
};
