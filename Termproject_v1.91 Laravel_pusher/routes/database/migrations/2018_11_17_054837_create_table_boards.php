<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBoards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *///
    public function up()
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->integer('board_num', 20);
            $table->string('board_title',40);
            $table->text('board_context');
            $table->string('board_writer',30);
            $table->foreign('board_writer')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('board_opener',40);
            $table->date('board_term_open');
            $table->date('board_term_close');
            $table->date('board_posted')->default(now());
            $table->integer('board_viewed')->unsigned()->default(0);
            $table->string('board_place', 20);
            $table->integer('board_performanceTime');
            $table->integer('board_viewingClass');
            $table->integer('board_price');
            $table->string('board_genre',10);
            $table->string('board_picture',50);
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boards');
    }
}
