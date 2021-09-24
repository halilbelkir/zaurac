<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Slider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider', function (Blueprint $table) {
            $table->id();
            $table->string('text_1')->nullable();
            $table->string('text_2')->nullable();
            $table->string('text_3')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_route')->nullable();
            $table->integer('order')->default('99');
            $table->smallInteger('text_type')->default('1')->comment('1-left 2-right 3-center');
            $table->string('image')->nullable();
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
        //
    }
}
