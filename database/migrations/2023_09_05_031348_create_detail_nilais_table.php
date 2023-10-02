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
        Schema::create('detail_nilais', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai_akademik');
            $table->timestamps();
            $table->unsignedBigInteger('id_nilai');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_guru');
            $table->foreign('id_nilai')->references('id')->on('nilais');
            $table->foreign('id_mapel')->references('id')->on('mapels');
            $table->foreign('id_guru')->references('id')->on('gurus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_nilais');
    }
};
