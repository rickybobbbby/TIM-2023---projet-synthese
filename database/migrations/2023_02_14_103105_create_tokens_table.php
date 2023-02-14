<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Game::class)
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(\App\Models\User::class)
                ->nullable()
                ->index()
                ->constrained()
                ->nullOnDelete();

            $table->string('name');
            $table->string('image')->nullable();

            $table->integer('latitude')->default(0);
            $table->integer('longitude')->default(0);

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
        Schema::dropIfExists('tokens');
    }
};
