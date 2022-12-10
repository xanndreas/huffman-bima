<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentsTable extends Migration
{
    public function up()
    {
        Schema::create('sents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('sent_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
