<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->date('tahun_pengadaan');
            $table->string('jenis');
            $table->string('image')->nullable();
            $table->integer('jumlah_seluruh_barang');
            $table->timestamps();
            $table->unsignedBigInteger('id_ruang')->nullable();
            $table->foreign('id_ruang')->references('id')->on('ruangs');
        });
    }

    public function down()
    {
        Schema::dropIfExists('barangs');
    }
};
