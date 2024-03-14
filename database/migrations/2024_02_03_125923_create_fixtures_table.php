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
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('season_id');
            $table->unsignedBigInteger('competition_id');
            $table->date('date');
            $table->unsignedBigInteger('home_team')->nullable();
            $table->unsignedBigInteger('away_team')->nullable();
            $table->unsignedBigInteger('home_player_1')->nullable();
            $table->unsignedBigInteger('home_player_2')->nullable();
            $table->unsignedBigInteger('away_player_1')->nullable();
            $table->unsignedBigInteger('away_player_2')->nullable();
            $table->integer('home_score')->nullable();
            $table->integer('away_score')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixtures');
    }
};
