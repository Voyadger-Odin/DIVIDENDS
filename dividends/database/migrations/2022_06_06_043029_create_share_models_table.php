<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share_models', function (Blueprint $table) {
            $table->id();
            $table->string('figi');
            $table->string('name');
            $table->string('ticker');
            $table->float('price');
            $table->integer('lot');
            $table->string('currency');
            $table->boolean('pay_dividends');
            $table->enum('direction', ['none', 'up', 'down']);
            $table->string('sector');
            $table->string('img');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('share_models');
    }
}
