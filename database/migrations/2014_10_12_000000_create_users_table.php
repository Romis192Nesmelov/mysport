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

            $table->string('fb_id')->nullable();
            $table->string('vk_id')->nullable();

            $table->string('email');
            $table->string('avatar')->nullable();
            $table->string('document')->nullable();
            $table->string('nick')->nullable();
            $table->string('phone');

            $table->string('name')->nullable();
            $table->string('director')->nullable();
            $table->string('bank')->nullable();
            $table->string('bank_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('checking_account')->nullable();
            $table->string('correspondent_account')->nullable();

            $table->string('password');
            $table->string('confirm_token')->nullable();
            $table->boolean('active');
            $table->boolean('type');
            $table->boolean('confirmed')->nullable();
            $table->integer('rating')->nullable();
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
