<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->string('title', 255);
            $table->bigIncrements('id');
            $table->integer('author_id');
            $table->integer('task_id');
            $table->string('view')->default('table'); // row
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->string('bg_image', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boards');
    }
}
