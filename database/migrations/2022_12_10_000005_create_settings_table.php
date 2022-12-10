<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('outgoing_server');
            $table->string('outgoing_port');
            $table->string('incoming_server');
            $table->string('incoming_port');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
