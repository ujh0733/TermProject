<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->integer('board_num', 20);
            $table->foreign('board_num')->references('board_num')->on('boards')->onDelete('cascade')->onUpdate('cascade');
            $table->string('comment_userId', 30);
            $table->foreign('comment_userId')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('comment_userName', 30);
            $table->text('comment_txt');
            $table->timestamp('comment_date')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
