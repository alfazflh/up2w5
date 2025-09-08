<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pemeriksaan_p3k', function (Blueprint $table) {
            $table->id();
            
            $table->string('id_p3k');
            $table->date('tanggal_pemeriksaan')->nullable();
            $table->string('petugas')->nullable();

            $table->string('nama')->nullable();
            $table->string('item')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('keperluan')->nullable();

            $table->string('kasa')->nullable();
            $table->string('kadaluarsa_kasa')->nullable();
            $table->text('catatan_kasa')->nullable();

            $table->string('perban5cm')->nullable();
            $table->string('kadaluarsa_perban5cm')->nullable();
            $table->text('catatan_perban5cm')->nullable();

            $table->string('perban10cm')->nullable();
            $table->string('kadaluarsa_perban10cm')->nullable();
            $table->text('catatan_perban10cm')->nullable();

            $table->string('plester125cm')->nullable();
            $table->string('kadaluarsa_plester125cm')->nullable();
            $table->text('catatan_plester125cm')->nullable();

            $table->string('plester')->nullable();
            $table->string('kadaluarsa_plester')->nullable();
            $table->text('catatan_plester')->nullable();

            $table->string('kapas')->nullable();
            $table->string('kadaluarsa_kapas')->nullable();
            $table->text('catatan_kapas')->nullable();

            $table->string('mittela')->nullable();
            $table->string('kadaluarsa_mittela')->nullable();
            $table->text('catatan_mittela')->nullable();

            $table->string('gunting')->nullable();
            $table->string('kadaluarsa_gunting')->nullable();
            $table->text('catatan_gunting')->nullable();

            $table->string('peniti')->nullable();
            $table->string('kadaluarsa_peniti')->nullable();
            $table->text('catatan_peniti')->nullable();

            $table->string('sarung_tangan')->nullable();
            $table->string('kadaluarsa_sarung_tangan')->nullable();
            $table->text('catatan_sarung_tangan')->nullable();

            $table->string('pasangan')->nullable();

            $table->string('masker')->nullable();
            $table->string('kadaluarsa_masker')->nullable();
            $table->text('catatan_masker')->nullable();

            $table->string('pinset')->nullable();
            $table->string('kadaluarsa_pinset')->nullable();
            $table->text('catatan_pinset')->nullable();

            $table->string('senter')->nullable();
            $table->string('kadaluarsa_senter')->nullable();
            $table->text('catatan_senter')->nullable();

            $table->string('gelas')->nullable();
            $table->string('kadaluarsa_gelas')->nullable();
            $table->text('catatan_gelas')->nullable();

            $table->string('plastik')->nullable();
            $table->string('kadaluarsa_plastik')->nullable();
            $table->text('catatan_plastik')->nullable();

            $table->string('aquades')->nullable();
            $table->string('kadaluarsa_aquades')->nullable();
            $table->text('catatan_aquades')->nullable();

            $table->string('povidon')->nullable();
            $table->string('kadaluarsa_povidon')->nullable();
            $table->text('catatan_povidon')->nullable();

            $table->string('alkohol')->nullable();
            $table->string('kadaluarsa_alkohol')->nullable();
            $table->text('catatan_alkohol')->nullable();

            $table->string('panduanp3k')->nullable();
            $table->string('kadaluarsa_panduanp3k')->nullable();
            $table->text('catatan_panduanp3k')->nullable();

            $table->string('daftarisi')->nullable();
            $table->string('kadaluarsa_daftarisi')->nullable();
            $table->text('catatan_daftarisi')->nullable();
            
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemeriksaan_p3k');
    }
};

?>