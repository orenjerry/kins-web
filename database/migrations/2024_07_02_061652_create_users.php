<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->unique();
            $table->integer('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->timestamp('online_at')->nullable();
            $table->timestamps();
        });

        Schema::create('access_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('token');
            $table->timestamp('expired_at');
            $table->timestamps();
        });

        Schema::create('profile', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('about')->nullable();
            $table->string('pronouns')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role');
        Schema::dropIfExists('users');
        Schema::dropIfExists('access_tokens');
        Schema::dropIfExists('profile');
    }
};
