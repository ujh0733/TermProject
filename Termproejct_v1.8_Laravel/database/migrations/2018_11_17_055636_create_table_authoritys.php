<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAuthoritys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authoritys', function (Blueprint $table) {
            $table->string('user_auth')->unique();
            $table->string('rights');
        });

        DB::table('authoritys')->insert([
            'user_auth' => 'TOP',
            'rights' => 'admin'
        ]);
        DB::table('authoritys')->insert([
            'user_auth' => 'A',
            'rights' => 'manager'
        ]);
        DB::table('authoritys')->insert([
            'user_auth' => 'B',
            'rights' => 'user'
        ]);
        DB::table('authoritys')->insert([
            'user_auth' => 'C',
            'rights' => 'guest'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authoritys');
    }
}
