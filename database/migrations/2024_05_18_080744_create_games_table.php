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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('season_id');
            $table->unsignedBigInteger('fixture_id');
            $table->unsignedBigInteger('home_player')->nullable();
            $table->unsignedBigInteger('away_player')->nullable();
            $table->integer('home_score')->nullable();
            $table->integer('away_score')->nullable();
            $table->integer('home_8')->nullable();
            $table->integer('away_8')->nullable();
            $table->integer('home_first')->nullable();
            $table->integer('away_first')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
