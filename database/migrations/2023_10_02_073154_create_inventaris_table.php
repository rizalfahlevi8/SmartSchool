<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisTable extends Migration
{
    public function up()
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ruang');
            $table->unsignedBigInteger('id_barang');  
            $table->string('nama_barang');
            $table->date('tahun_pengadaan');
            $table->string('jenis');
            $table->integer('jumlah_barang');
            $table->integer('jumlah_baik');
            $table->integer('jumlah_rusak');
            $table->timestamps();

            // Setup foreign key constraints
            $table->foreign('id_ruang')->references('id')->on('ruangs')->onDelete('cascade');  
            $table->foreign('id_barang')->references('id')->on('barangs')->onDelete('cascade');  
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventaris');
    }
}

