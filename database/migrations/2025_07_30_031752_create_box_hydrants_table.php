<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxHydrantsTable extends Migration
{
    public function up(): void
    {
        Schema::create('box_hydrants', function (Blueprint $table) {
            $table->id();
            $table->string('id_boxhydrant');
            $table->string('lokasi');
            $table->string('nama');
            $table->string('pilar_hydrant')->nullable();
            $table->string('box_hydrant')->nullable();
            $table->string('noozle')->nullable();
            $table->string('selang')->nullable();
            $table->string('uji_fungsi')->nullable();
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
        Schema::dropIfExists('box_hydrants');
    }
}
