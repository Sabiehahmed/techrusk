<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->defineAs(App\User::class, "admin", function (Faker\Generator $faker) {
    return [
        'name' => 'Sabieh Ahmed',
        'email' => 'sabieh.ahmed@gmail.com',
        'password' => bcrypt('shazzyhunk2202'),
        'remember_token' => str_random(10),
        'role_type' => 1
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt($faker->password(6)),
        'remember_token' => str_random(10),
        'role_type' => 0,
        'gender' => $faker->randomElement(['Male','Female'])
    ];
});


$factory->define(App\Setting::class, function (Faker\Generator $faker) {
    return [
        'site_title' => config('blog.title'),
        'meta_keywords' => config('blog.meta_keywords'),
        'meta_description' => config('blog.meta_description'),
        'footer_text' => config('blog.footer_text'),
        'logo_1' => config('blog.logo_1'),
        'logo_2' => config('blog.logo_2'),
        'favicon' => config('blog.favicon'),
        'no_image' => config('blog.no_image'),
        'banner_image' => config('blog.banner_image'),
        'about_name' => config('blog.about_name'),
        'about_description' => config('blog.about_description'),
        'about_image' => config('blog.about_image'),
        'facebook_link' => config('blog.facebook_link'),
        'instagram_link' => config('blog.instagram_link'),
        'twitter_link' => config('blog.twitter_link'),
        'youtube_link' => config('blog.youtube_link'),
        'facebook_app_id' => config('blog.facebook_app_id'),
        'facebook_app_secret' => config('blog.facebook_app_secret'),
        'facebook_page_url' => config('blog.facebook_page_url'),
    ];
});
