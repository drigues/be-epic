<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();

            // Link each page to its user
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Unique directory name (beepi.cc/{username})
            $table->string('username')
                  ->unique();

            // Optional profile picture and background
            $table->string('profile_pic')->nullable();
            $table->string('background')->nullable();

            // Optional bio text
            $table->text('bio')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }
};
