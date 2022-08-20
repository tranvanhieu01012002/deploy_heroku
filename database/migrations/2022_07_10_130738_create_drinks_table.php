<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drinks', function (Blueprint $table) {
            $table->increments("id");
            $table->timestamps();
            $table->string("name");
            $table->string("producer");
            $table->mediumText('description');	
            $table->date('domF');
            $table->date('expiry');
            $table->integer('quantity');
            $table->float('price');
            $table->integer('type')->unsigned();
            $table->foreign('type')->references('id')->on("drink_types")->onDelete('cascade')->onUpdate('cascade');;
            $table->string('image',500);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drinks');
    }
}
