<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDividendsModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dividends_models', function (Blueprint $table) {
            $table->id();
            $table->string('figi');
            $table->float('dividend_net');
            $table->date('payment_date');
            $table->date('last_buy_date');
            $table->float('yield_value');
            $table->string('regularity');
            $table->string('dividend_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dividends_models');
    }
}
