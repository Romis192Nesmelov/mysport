<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKindOfSportIdToEnventSportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_sports', function (Blueprint $table) {
            $table->bigInteger('kind_of_sport_id', false, true);
            $table->foreign('kind_of_sport_id')->references('id')->on('kind_of_sports')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_sports', function (Blueprint $table) {
            $table->dropForeign('event_sports_kind_of_sport_id_foreign');
            $table->dropColumn('kind_of_sport_id');
        });
    }
}
