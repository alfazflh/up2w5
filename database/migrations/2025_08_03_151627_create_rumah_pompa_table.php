<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRumahPompaTable extends Migration
{
    public function up()
    {
        Schema::create('rumah_pompa', function (Blueprint $table) {
            $table->id();
            $table->string('id_rumah');
            $table->string('pipa')->nullable();
            $table->string('valve')->nullable();
            $table->string('oli')->nullable();
            $table->string('bbm')->nullable();
            $table->string('air')->nullable();
            $table->string('tegangan')->nullable();
            $table->string('filter_oli')->nullable();
            $table->string('filter_bbm')->nullable();
            $table->string('filter_udara')->nullable();
            $table->string('kekencangan')->nullable();
            $table->string('terminal')->nullable();
            $table->string('panel')->nullable();
            $table->string('pemanasan')->nullable();
            $table->string('indikator')->nullable();
            $table->string('matikan')->nullable();
            $table->string('kondisi')->nullable();
            $table->string('ruangan')->nullable();
            $table->string('elektrik')->nullable();
            $table->string('jocky')->nullable();
            $table->string('selector')->nullable();
            $table->string('fungsi')->nullable();
            $table->string('kesimpulan')->nullable();
            $table->date('tanggal_pemeriksaan')->nullable();
            $table->string('petugas')->nullable();
            $table->string('pengawas')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rumah_pompa');
    }
}
