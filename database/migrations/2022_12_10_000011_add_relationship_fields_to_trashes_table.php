<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTrashesTable extends Migration
{
    public function up()
    {
        Schema::table('trashes', function (Blueprint $table) {
            $table->unsignedBigInteger('draft_id')->nullable();
            $table->foreign('draft_id', 'draft_fk_7736602')->references('id')->on('drafts');
        });
    }
}
