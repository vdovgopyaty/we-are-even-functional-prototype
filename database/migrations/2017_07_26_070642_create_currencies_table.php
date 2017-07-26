<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->char('id', 3);
            $table->string('code', 10);
            $table->string('symbol', 10);
            $table->string('symbol_native', 10);
            $table->string('name', 30);
            $table->string('name_plural', 30);
            $table->tinyInteger('decimal_digits');
            $table->tinyInteger('rounding');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
