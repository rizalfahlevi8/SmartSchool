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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['masuk', 'libur'])->nullable(true);
            $table->text('catatan')->nullable(true);
            $table->enum('hari', ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']);
            $table->timestamps();
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_akademik');
            $table->foreign('id_akademik')->references('id')->on('akademiks')->cascadeOnDelete();
            $table->foreign('id_kelas')->references('id')->on('kelas')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
