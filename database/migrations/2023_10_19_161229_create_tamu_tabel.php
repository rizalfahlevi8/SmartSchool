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
        Schema::create('tamu_tabel', function (Blueprint $table) {
            $table->id();
            $table->string('nama',20);
            $table->string('alamat');
            $table->enum('Opsi_Tujuan',['Kepala Sekolah','Wakil Kepala Sekolah','Guru','Siswa']);
            $table->string('Keterangan');
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
        Schema::dropIfExists('tamu_tabel');
    }
};
