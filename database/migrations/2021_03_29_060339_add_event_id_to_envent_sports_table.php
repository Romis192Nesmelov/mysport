<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEventIdToEnventSportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_sports', function (Blueprint $table) {
            $table->bigInteger('event_id', false, true);
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
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
            $table->dropForeign('event_sports_event_id_foreign');
            $table->dropColumn('event_id');
        });
    }
}
