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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('nama', 255);
            $table->string('no_telp', 20)->unique();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->enum('agama', ['islam', 'kristen', 'hindu', 'buddha', 'konghucu']);
            $table->enum('status', ['tetap', 'magang', 'honorer'])->default('magang');
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->string('foto')->default('default_img.png');
            $table->text('alamat');
            $table->boolean('deleted')->default(0);
            $table->timestamps();
            $table->string('signature');
            $table->unsignedBigInteger('id_user')->unique()->nullable();
            $table->foreign('id_user')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
