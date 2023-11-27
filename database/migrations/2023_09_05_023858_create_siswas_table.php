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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            // $table->string('no_pendaftaran')->unique();
            $table->string('nis')->unique();
            $table->string('nisn')->unique();
            $table->string('nik', 17)->unique();
            $table->string('nama', 255);
            $table->string('no_telp', 20)->unique();
            $table->string('nama_ayah', 255);
            $table->string('nama_ibu', 255);
            $table->string('nama_wali', 255)->nullable();
            $table->text('alamat');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->enum('agama', ['islam', 'kristen', 'hindu', 'buddha', 'konghucu']);
            $table->integer('semester')->default('1');
            $table->string('foto')->default('default_img.png')->nullable();
            $table->enum('status', ['bukan pindahan', 'pindahan', 'mutasi', 'lulus'])->default('bukan pindahan');
            $table->string('asal_sekolah')->nullable();
            $table->date('tanggal_keluar');
            $table->timestamps();
            $table->unsignedBigInteger('id_user')->unique()->nullable();
            $table->unsignedBigInteger('id_angkatan')->nullable(true);
            $table->unsignedBigInteger('id_kelas')->nullable(true);
            $table->foreign('id_user')->references('id')->on('users')->nullOnDelete();
            $table->foreign('id_kelas')->references('id')->on('kelas')->restrictOnDelete();
            $table->foreign('id_angkatan')->references('id')->on('data_angkatans')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
