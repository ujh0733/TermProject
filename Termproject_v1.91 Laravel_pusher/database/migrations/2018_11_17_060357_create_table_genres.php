<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGenres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->string('board_genre',10)->unique();
            $table->string('Class',20);
        });

        DB::table('genres')->insert([
            'board_genre' => 'M',
            'Class' => '뮤지컬'
        ]);
        DB::table('genres')->insert([
            'board_genre' => 'C',
            'Class' => '콘서트'
        ]);
        DB::table('genres')->insert([
            'board_genre' => 'P',
            'Class' => '공연'
        ]);
        DB::table('genres')->insert([
            'board_genre' => 'E',
            'Class' => '전시'
        ]);
        DB::table('genres')->insert([
            'board_genre' => 'K',
            'Class' => '아동'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genres');
    }
}
