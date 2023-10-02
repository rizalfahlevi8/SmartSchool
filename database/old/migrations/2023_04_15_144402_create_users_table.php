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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('NIP', 25)->unique();
            $table->string('nama', 100);
            $table->string('password');
            $table->string('jk', 20);
            $table->string('agama', 20);
            $table->string('notelp', 15)->unique();
            $table->string('tempatlahir', 50);
            $table->date('tgllahir');
            $table->string('foto')->nullable();
            $table->string('alamat');
            $table->string('jabatan', 50);
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
        Schema::dropIfExists('users');
    }
};
