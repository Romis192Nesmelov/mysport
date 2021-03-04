<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->integer('start_time');
            $table->integer('end_time');
            $table->string('name_ru');
            $table->string('name_en')->nullable();
            $table->text('description_ru');
            $table->text('description_en')->nullable();
            $table->double('latitude');
            $table->double('longitude');
            $table->string('address_ru');
            $table->string('address_en')->nullable();
            $table->smallInteger('age_group'); 
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
        Schema::dropIfExists('events');
    }
}
