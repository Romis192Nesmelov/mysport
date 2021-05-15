<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->text('license')->nullable();
            
            $table->text('about_ru')->nullable();
            $table->text('about_en')->nullable();
            
            $table->string('education_ru');
            $table->string('education_en')->nullable();
            
            $table->string('add_education_ru')->nullable();
            $table->string('add_education_en')->nullable();
            
            $table->string('achievements_ru')->nullable();
            $table->string('achievements_en')->nullable();
            
            $table->smallInteger('since');

            $table->string('fb')->nullable();
            $table->string('vk')->nullable();
            $table->string('inst')->nullable();
            
            $table->boolean('best')->nullable();
            $table->boolean('active')->nullable();
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
        Schema::dropIfExists('trainers');
    }
}
