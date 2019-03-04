<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('user_id', 30)->primary();
            $table->string('password');
            $table->string('user_name', 30);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('user_phone');
            $table->date('user_birth');
            $table->string('user_postcode');
            $table->string('user_addr');
            $table->string('user_auth')->default('B');
            $table->string('user_profile')->default('base.jpg');
            $table->string('user_ip')->nullable();
            $table->rememberToken();
            $table->timestamps();
            
            /*$table->string('user_id')->primary();
            $table->string('user_pwd');
            $table->string('user_name');
            $table->string('user_email');
            $table->string('user_phone');
            $table->date('user_birth');
            $table->string('user_postcode');
            $table->string('user_addr');
            $table->string('user_auth')->default('B');
            $table->string('user_profile')->default('base.jpg');
            $table->string('user_ip')->default('0');
            $table->rememberToken();
            $table->timestamps();*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
