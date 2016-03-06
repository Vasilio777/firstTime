<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lections', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('idcourse')->unsigned();
            $table->foreign('idcourse')->references('id')->on('courses');
            $table->string('ltitle');
            $table->text('ldesc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lections');
    }
}
