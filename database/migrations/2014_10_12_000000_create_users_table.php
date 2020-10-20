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
            $table->bigIncrements('id');

//            $table->string('fb_id')->nullable();
            $table->string('vk_id')->nullable();

            $table->string('name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('email');
            $table->string('phone');

            $table->string('password');
            $table->string('confirm_token')->nullable();
            $table->smallInteger('type');
            $table->boolean('active');
            $table->boolean('send_mail');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
