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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();

            $table->integer("min");
            $table->integer("pts");
            $table->integer("reb");
            $table->integer("ast");
            $table->integer("rob");
            $table->integer("tap");

            $table->foreignId('player_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('game_id')->constrained('games')->cascadeOnUpdate()->cascadeOnDelete();

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
        Schema::dropIfExists('statistics');
    }
};
