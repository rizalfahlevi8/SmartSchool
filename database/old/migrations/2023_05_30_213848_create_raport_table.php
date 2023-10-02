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
        Schema::create('raport', function (Blueprint $table) {
            $table->id();
            $table->integer('sakit')->default(0)->nullable();
            $table->integer('ijin')->default(0)->nullable();
            $table->integer('tanpa_ket')->default(0)->nullable();
            $table->integer('nilai_pth')->default(0)->nullable();
            $table->integer('nilai_ktr')->default(0)->nullable();
            $table->string('nilai_huruf_pth', 5)->nullable();
            $table->string('nilai_huruf_ktr', 5)->nullable();
            $table->integer('semester')->default(0)->nullable();
            $table->string('status', 10)->nullable();
            $table->bigInteger('siswa_id')->nullable()->unsigned();
            $table->bigInteger('mapel_id')->nullable()->unsigned();
            $table->bigInteger('guru_id')->nullable()->unsigned();
            
            $table->foreign('siswa_id')->references('id')->on('siswa');
            $table->foreign('mapel_id')->references('id')->on('mapel');
            $table->foreign('guru_id')->references('id')->on('guru');
            
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
        Schema::dropIfExists('raport');
    }
};
