<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableViewingclasss extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viewingclasss', function (Blueprint $table) {
            $table->integer('viewingClass',10)->unique();
            $table->string('Class',20);
        });

        DB::table('viewingclasss')->insert([
            'viewingClass' => '19',
            'Class' => '청소년 관람 불가'
        ]);
        DB::table('viewingclasss')->insert([
            'viewingClass' => '15',
            'Class' => '15세이상 관람가능'
        ]);
        DB::table('viewingclasss')->insert([
            'viewingClass' => '12',
            'Class' => '12세이상 관람가능'
        ]);
        DB::table('viewingclasss')->insert([
            'viewingClass' => '7',
            'Class' => '7세이상 관람가능'
        ]);
        DB::table('viewingclasss')->insert([
            'viewingClass' => '0',
            'Class' => '전체이용가'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('viewingclasss');
    }
}
