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
            $table->unsignedBigInteger('id_ruang');  // Ganti 'ruang_id' menjadi 'id_ruang'
            $table->unsignedBigInteger('id_daftarbarang');  // Ganti 'daftar_barang_id' menjadi 'id_daftarbarang'
            $table->string('nama_barang');
            $table->date('tahun_pengadaan');
            $table->string('jenis');
            $table->integer('jumlah_barang');
            $table->integer('jumlah_baik');
            $table->integer('jumlah_rusak');
            $table->timestamps();

            // Setup foreign key constraints
            $table->foreign('id_ruang')->references('id')->on('ruang')->onDelete('cascade');  // Ganti 'ruang_id' menjadi 'id_ruang'
            $table->foreign('id_daftarbarang')->references('id')->on('daftarbarang')->onDelete('cascade');  // Ganti 'daftar_barang_id' menjadi 'id_daftarbarang'
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventaris');
    }
}

