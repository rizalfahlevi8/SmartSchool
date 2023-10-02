<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_nilai', ['uts', 'uas']);
            $table->string('kelas_ke');
            $table->integer('sakit')->default(0);
            $table->integer('izin')->default(0);
            $table->integer('tanpa_keterangan')->default(0);
            $table->timestamps();
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_akademik');
            $table->foreign('id_siswa')->references('id')->on('siswas');
            $table->foreign('id_akademik')->references('id')->on('akademiks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
