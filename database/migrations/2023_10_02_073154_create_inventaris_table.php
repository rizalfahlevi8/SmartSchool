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
            $table->unsignedBigInteger('ruang_id');
            $table->unsignedBigInteger('barang_id');  
            $table->string('nama_barang');
            $table->date('tahun_pengadaan');
            $table->string('jenis');
            $table->integer('jumlah_barang');
            $table->integer('jumlah_baik');
            $table->integer('jumlah_rusak');
            $table->timestamps();

            // Setup foreign key constraints
            $table->foreign('ruang_id')->references('id')->on('ruangs')->onDelete('cascade');  
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade');  
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventaris');
    }
}

