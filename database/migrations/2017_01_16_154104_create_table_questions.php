<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('question');
            $table->string('seo_title');
            $table->text('desc');
            $table->text('keywords');
            $table->string('slug', 200)->unique();
            $table->text('answer');
            $table->string('ask_person');
            $table->string('answer_person');
            $table->string('ask_address')->nullable();
            $table->string('ask_phone')->nullable();
            $table->string('ask_email')->nullable();
            $table->string('image');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('questions');
    }
}
