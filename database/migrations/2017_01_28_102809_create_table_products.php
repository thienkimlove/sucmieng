<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title', 255);
            $table->string('seo_title', 255)->nullable();
            $table->string('slug', 200)->unique();
            $table->text('desc')->nullable();
            $table->text('keywords')->nullable();

            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->integer('views')->unsigned()->default(0);
            $table->boolean('status')->default(true);

            $table->timestamps();
        });

        Schema::create('product_tag', function(Blueprint $table)
        {
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_tag');
    }
}
