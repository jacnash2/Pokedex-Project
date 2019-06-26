<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePokedexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pokedexes', function (Blueprint $table) {
            $table->Integer('id');
            $table->string('name');
            $table->string('types');
            $table->decimal('height');
            $table->decimal('weight');
            $table->string('abilities');
            $table->string('egg_groups');
            $table->string('stats');
            $table->string('genus');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pokedexes');
    }
}
