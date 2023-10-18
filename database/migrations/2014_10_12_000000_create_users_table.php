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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 25)->unique();
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->boolean('deleted')->default(0);
            $table->boolean('is_online')->default(0);
            $table->date('last_online')->nullable()->default(null);
            $table->string('current_role')->nullable()->default(null);
            $table->string('role')->default('tamu');
            $table->string('remember_token')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
