<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
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
            $table->string('slug')->unique();
            $table->string('title')->default('');
            $table->string('subtitle')->default('');
            $table->longText('content_raw');
            $table->longText('content_html');
            $table->timestamp('published_at');
            $table->boolean('is_draft')->default(0);
            $table->integer('user_id')->unsigned()->index();
            $table->string('page_image')->default('');
            $table->string('promo_image')->default('');
            $table->string('meta_description')->default('');
            $table->string('meta_keywords')->default('');
            $table->string('layout')->default('blog.layouts.post');
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
        Schema::dropIfExists('posts');
    }
}
