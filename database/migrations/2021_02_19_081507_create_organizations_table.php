<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->string('name_ru');
            $table->string('name_en')->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_en')->nullable();
            $table->string('leader_ru')->nullable();
            $table->string('leader_en')->nullable();
            $table->string('address_ru');
            $table->string('address_en')->nullable();
            $table->double('latitude');
            $table->double('longitude');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('site')->nullable();
            $table->string('schedule_ru')->nullable();
            $table->string('schedule_en')->nullable();
            $table->boolean('active');
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
        Schema::dropIfExists('organizations');
    }
}
