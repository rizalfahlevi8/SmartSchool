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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->integer('tugas1')->default(0)->nullable();
            $table->integer('tugas2')->default(0)->nullable();
            $table->integer('tugas3')->default(0)->nullable();
            $table->integer('tugas4')->default(0)->nullable();
            $table->integer('tugas5')->default(0)->nullable();
            $table->integer('uts')->default(0)->nullable();
            $table->integer('uas')->default(0)->nullable();
            $table->integer('semester')->default(0)->nullable();

            $table->bigInteger('siswa_id')->nullable()->unsigned();
            $table->bigInteger('kelas_id')->nullable()->unsigned();
            $table->bigInteger('guru_id')->nullable()->unsigned();
            $table->bigInteger('mapel_id')->nullable()->unsigned();

            $table->foreign('siswa_id')->references('id')->on('siswa');
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->foreign('guru_id')->references('id')->on('guru');
            $table->foreign('mapel_id')->references('id')->on('mapel');
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
        Schema::dropIfExists('nilai');
    }
};
