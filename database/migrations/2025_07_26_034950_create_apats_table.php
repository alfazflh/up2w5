<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApatsTable extends Migration
{
    public function up(): void
    {
        Schema::create('apats', function (Blueprint $table) {
            $table->id();
            $table->string('id_apat');
            $table->string('lokasi');
            $table->string('kondisi_fisik')->nullable();
            $table->string('drum')->nullable();
            $table->string('aduk_pasir')->nullable();
            $table->string('sekop')->nullable();
            $table->string('karung_goni')->nullable();
            $table->string('ember')->nullable();
            $table->string('kesimpulan')->nullable();
            $table->date('tanggal_pemeriksaan')->nullable();
            $table->string('petugas')->nullable();
            $table->string('pengawas')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('apats');
    }
}
