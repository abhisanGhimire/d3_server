<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStackedBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stacked_bars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Date');
            $table->string('Total');
            $table->string('Positive');
            $table->string('Recovered');
            $table->string('Death');
            $table->string('ActiveCases');
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
        Schema::dropIfExists('stacked_bars');
    }
}
