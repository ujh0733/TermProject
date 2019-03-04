<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTheaters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theaters', function (Blueprint $table) {
            $table->integer('board_num',20);
            $table->foreign('board_num')->references('board_num')->on('boards')->onDelete('cascade')->onUpdate('cascade');
            $table->string('theater_name', 30);
            $table->float('theater_lat', 10, 6);
            $table->float('theater_lng', 10, 6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('theaters');
    }
}
