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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Game::class, 'game_id')
                ->constrained()
                ->cascadeOnDelete();

            // Filename without path
            $table->string('filename');

            // Width and height of the image
            $table->unsignedInteger('width');
            $table->unsignedInteger('height');

            // Positions on the grid
            $table->unsignedInteger('longitude')->nullable();
            $table->unsignedInteger('latitude')->nullable();
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
        Schema::dropIfExists('assets');
    }
};
