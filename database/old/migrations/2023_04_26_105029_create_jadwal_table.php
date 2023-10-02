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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kelas_id')->nullable()->unsigned();
            $table->bigInteger('mapel_id')->nullable()->unsigned();
            $table->bigInteger('guru_id')->nullable()->unsigned();
            $table->string('keterangan', 50)->nullable();
            $table->string('hari', 10);
            $table->time('jamawal');
            $table->time('jamaakhir');
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->foreign('mapel_id')->references('id')->on('mapel');
            $table->foreign('guru_id')->references('id')->on('guru');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
};
