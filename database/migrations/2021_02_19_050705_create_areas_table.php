<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->string('name_ru');
            $table->string('name_en');
            $table->text('description_ru')->nullable();
            $table->text('description_en')->nullable();
            $table->string('leader_ru');
            $table->string('leader_en')->nullable();
            $table->string('phone');
            $table->string('email');
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
        Schema::dropIfExists('areas');
    }
}
