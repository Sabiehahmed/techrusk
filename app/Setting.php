<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * Fields that are mass assignable
     * @var array
     */
    protected $fillable = ['site_title', 'meta_keywords', 'meta_description', 'logo_1', 'logo_2', 'favicon', 'no_image', 'footer_text', 'banner_image', 'about_name', 'about_description', 'about_image', 'facebook_link', 'instagram_link', 'twitter_link', 'youtube_link', 'facebook_app_id', 'facebook_app_secret', 'facebook_page_url'];


}
