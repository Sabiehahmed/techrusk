<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_title');
            $table->string('meta_keywords');
            $table->string('meta_description');
            $table->text('footer_text');
            $table->string('logo_1');
            $table->string('logo_2');
            $table->string('favicon');
            $table->string('no_image');

            $table->string('banner_image');

            $table->string('about_name');
            $table->string('about_description');
            $table->string('about_image');


            $table->string('facebook_link');
            $table->string('instagram_link');
            $table->string('twitter_link');
            $table->string('youtube_link');

            $table->string('facebook_app_id');
            $table->string('facebook_app_secret');
            $table->string('facebook_page_url');
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
        Schema::dropIfExists('settings');
    }
}
