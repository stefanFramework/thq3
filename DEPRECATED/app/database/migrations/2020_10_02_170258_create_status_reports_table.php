<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusReportsTable extends Migration
{
    public function up()
    {
        Schema::create('status_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service_id', 128);
            $table->text('payload');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('status_reports');
    }
}
