<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ruang_id');
            $table->string('nama_peminjam');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_pengembalian');
            $table->string('surat')->nullable();
            $table->timestamps();
            $table->integer('status')->default('0'); // 0: belum terkonfirmasi 1: sudah dikonfirmasi
            $table->boolean('status_pengajuan')->nullable();


            $table->foreign('ruang_id')->references('id')->on('ruangs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjamans');
    }
};
