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
        Schema::create('akademiks', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran');
            $table->enum('semester', ['ganjil', 'genap']);
            $table->boolean('selected')->default(1);
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
        Schema::dropIfExists('akademiks');
    }
};
