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
        Schema::create('profiles', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->text('photo')->nullable();
            $table->text('banner')->nullable();
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
        Schema::dropIfExists('profiles');
    }
};
