<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_jadwals', function (Blueprint $table) {
            $table->id();
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->text('keterangan')->nullable(true);
            $table->unsignedBigInteger('id_ruang')->nullable();
            $table->unsignedBigInteger('id_guru');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_jadwal');
            $table->foreign('id_ruang')->references('id')->on('ruangs')->nullOnDelete();
            $table->foreign('id_guru')->references('id')->on('gurus');
            $table->foreign('id_mapel')->references('id')->on('mapels');
            $table->foreign('id_jadwal')->references('id')->on('jadwals')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_jadwals');
    }
};
