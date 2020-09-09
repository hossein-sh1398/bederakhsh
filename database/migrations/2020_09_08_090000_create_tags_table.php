<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            //$table->softDeletes();//make column deleted_at
            //$table->index(['title', 'id'], 'ddd');
            //$table->spatialIndex(['title', 'id'], 'ddd');
            $table->string('slug');
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
       // $table->dropIndex('ddd')
        //or 
        //$table->dropIndex('id');
        Schema::dropIfExists('tags');
    }
}
