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
        Schema::create('game_invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Game::class)->constrained()->cascadeOnDelete();
            $table->string('email')->index();
            $table->timestamps();

            $table->unique(['game_id', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_invitations');
    }
};
