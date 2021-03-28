<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKidIdToEventsRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events_records', function (Blueprint $table) {
            $table->bigInteger('kid_id', false, true)->nullable();
            $table->foreign('kid_id')->references('id')->on('kids')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events_records', function (Blueprint $table) {
            $table->dropForeign('events_records_kid_id_foreign');
            $table->dropColumn('kid_id');
        });
    }
}
