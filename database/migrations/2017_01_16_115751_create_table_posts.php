<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('seo_title')->nullable();
            $table->string('slug', 200);
            $table->text('desc')->nullable();
            $table->text('content')->nullable();
            $table->text('keywords')->nullable();
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->string('image')->nullable()->default(null);
            $table->boolean('status')->default(true);
            $table->integer('views')->default(0);
            $table->timestamps();
        });

        Schema::create('post_tag', function(Blueprint $tale)
        {
            $tale->integer('post_id')->unsigned()->index();
            $tale->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $tale->integer('tag_id')->unsigned()->index();
            $tale->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('post_tag');
    }
}
