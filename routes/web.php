<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Auth::routes();


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/', 'BlogController@index');
Route::get('/post/{slug}', 'BlogController@showPost');
Route::patch('/comment/{slug}', 'BlogController@postComment');
Route::get('/category/{slug}', 'BlogController@showCategory');
Route::get('/tag/{tag}', 'BlogController@showTag');
Route::get('/page/{page}', 'BlogController@showPage');
Route::get('/search/{query}', 'BlogController@searchQuery');
Route::get('/about', function () {
    return view('frontend.page.aboutme');
});
Route::get('/contact', function () {
    return view('frontend.page.contact');
});
Route::post('/contact', 'BlogController@sendMessage');


/*
|--------------------------------------------------------------------------
| Admin Redirect
|--------------------------------------------------------------------------
|
*/
Route::get('admin', function () {
    return redirect('/admin/dashboard');
});


/*
|--------------------------------------------------------------------------
| Administrator Routes
|--------------------------------------------------------------------------
|
*/
Route::group([
    'namespace' => 'Admin',
    'middleware' => 'admin',
], function () {


    //Dashboard and settings routes
    Route::get('admin/dashboard', 'AdminController@index');
    Route::patch('admin/approveComment/{id}', 'AdminController@approveComment');
    Route::delete('admin/deleteComment/{id}', 'AdminController@deleteComment');

    //Menu
    Route::get('admin/menu', 'AdminController@menu');

    //Editor
    Route::get('admin/editor', 'AdminController@editor');

    //Post Resource
    Route::resource('admin/post', 'PostController', ['except' => 'show']);
    Route::get('admin/post/search', 'PostController@searchPost');
    Route::post('admin/post/filter', 'PostController@filterPost');


    //Tag Resource
    Route::delete('admin/tag/deleteAll', 'TagController@deleteAll');
    Route::resource('admin/tag', 'TagController', ['except' => 'show']);

    //Category Resource
    Route::delete('admin/category/deleteAll', 'CategoryController@deleteAll');
    Route::resource('admin/category', 'CategoryController', ['except' => 'show']);


    //Widgets
    Route::resource('admin/widget', 'WidgetController', ['except' => 'show']);

    //User Resource
    Route::resource('admin/user', 'UserController', ['except' => 'show']);

    

    //Menu Routes
    Route::get('admin/menu', 'MenuController@index');
    Route::post('admin/menu', 'MenuController@reorder');
    Route::post('admin/menu/new', 'MenuController@store');
    Route::post('admin/menu/category', 'MenuController@addFromCategory');
    Route::post('admin/menu/delete', 'MenuController@destroy');
    Route::get('admin/menu/edit/{id}', 'MenuController@edit');
    Route::post('admin/menu/edit/{id}', 'MenuController@update');

    //Upload Routes
    Route::get('admin/upload', 'UploadController@index');
    Route::post('admin/upload/file', 'UploadController@uploadFile');
    Route::post('admin/upload/file_url', 'UploadController@uploadFile_url');
    Route::post('admin/upload/file_path', 'UploadController@uploadFile_path');
    Route::delete('admin/upload/file', 'UploadController@deleteFile');
    Route::post('admin/upload/folder', 'UploadController@createFolder');
    Route::delete('admin/upload/folder', 'UploadController@deleteFolder');

    //Banner Routes
    Route::resource('admin/banner_settings', 'BannerController', ['except' => 'show']);

    //Settings Resource
    Route::resource('admin/settings', 'SettingsController', ['except' => ['store', 'create', 'show', 'edit', 'destroy']]);
    Route::get('admin/logo_settings', 'SettingsController@logo_settings');
    Route::patch('admin/logo_settings/{id}', 'SettingsController@update_logo_settings');
    Route::get('admin/about_settings', 'SettingsController@about_settings');
    Route::patch('admin/about_settings/{id}', 'SettingsController@update_about_settings');
    Route::get('admin/social_settings', 'SettingsController@social_settings');
    Route::patch('admin/social_settings/{id}', 'SettingsController@update_social_settings');
    Route::get('admin/social_widgets_settings', 'SettingsController@social_widgets_settings');
    Route::patch('admin/social_widgets_settings/{id}', 'SettingsController@update_social_widgets_settings');


});


