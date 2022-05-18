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
        Schema::create('formed_quintet_teams', function (Blueprint $table) {
            $table->id();

            $table->foreignId('quintet_id')->constrained('quintets')->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignId('player1_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('player2_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('player3_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('player4_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('player5_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();


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
        Schema::dropIfExists('formed_quintet_teams');
    }
};
