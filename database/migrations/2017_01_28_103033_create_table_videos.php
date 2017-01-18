<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title', 255);
            $table->string('seo_title', 255)->nullable();
            $table->string('slug', 200)->unique();
            $table->text('desc')->nullable();
            $table->text('keywords')->nullable();

            $table->string('link')->nullable();
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->integer('views')->unsigned()->default(0);
            $table->boolean('status')->default(true);

            $table->timestamps();
        });

        Schema::create('tag_video', function(Blueprint $table)
        {
            $table->integer('video_id')->unsigned()->index();
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
            $table->integer('tag_id')->unsigned()->index();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
        Schema::dropIfExists('tag_video');
    }
}
