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
            $table->string('Opsi_Tujuan');
            $table->string('Keterangan');
            $table->timestamps();
            $table->string('Opsi_lanjutan')->references('username')->on('users');
            $table->unsignedBigInteger('user_id')->nullable(); // Tambahkan kolom user_id
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();

            $table->enum('status', ['menunggu', 'pesan_telah_diterima', 'pesan_telah_selesai'])->default('menunggu');

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
