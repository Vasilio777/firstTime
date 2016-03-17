<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddmatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addmats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idaddlec')->unsigned();
            $table->foreign('idaddlec')->references('id')->on('lections');
            $table->string('addtitle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('addmats');
    }
}
