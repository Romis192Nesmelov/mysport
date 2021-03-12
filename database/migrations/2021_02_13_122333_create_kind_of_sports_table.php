<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKindOfSportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kind_of_sports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('icon');
            $table->string('name_ru');
            $table->string('name_en')->nullable();
            $table->text('description_ru');
            $table->text('description_en')->nullable();
            $table->text('recommendation_ru');
            $table->text('recommendation_en')->nullable();
            $table->text('needed_ru');
            $table->text('needed_en')->nullable();
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
        Schema::dropIfExists('kind_of_sports');
    }
}
