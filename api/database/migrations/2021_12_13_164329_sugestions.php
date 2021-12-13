<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sugestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sugestions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('division');
            $table->integer('user_id');
            $table->integer('route_id');
            $table->string('title');
            $table->text('sugestion');
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
        Schema::dropIfExists('sugestions');
    }
}
