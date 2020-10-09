<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToStatusReportsTable extends Migration
{
    public function up()
    {
        Schema::table('status_reports', function (Blueprint $table) {
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    public function down()
    {
        Schema::table('status_reports', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
        });
    }
}
