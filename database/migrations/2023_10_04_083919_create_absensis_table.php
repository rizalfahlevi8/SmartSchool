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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->enum('status_absen', ['masuk', 'sakit', 'izin', 'telat', 'tidak masuk'])->default('tidak masuk');
            $table->string('keterangan')->nullable();
            $table->string('kelas');
            $table->unsignedBigInteger('id_siswa')->nullable(true);
            $table->unsignedBigInteger('id_akademik')->nullable(true);
            $table->foreign('id_siswa')->references('id')->on('siswas');
            $table->foreign('id_akademik')->references('id')->on('akademiks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensis');
    }
};
