<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::first();

        return view('admin.setting.index')->withSettings($settings);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logo_settings()
    {
        $settings = Setting::first();

        return view('admin.setting.logo_settings')->withSettings($settings);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function banner_settings()
    {
        $settings = Setting::first();

        return view('admin.setting.banner_settings')->withSettings($settings);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function about_settings()
    {
        $settings = Setting::first();

        return view('admin.setting.about_settings')->withSettings($settings);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function social_settings()
    {
        $settings = Setting::first();

        return view('admin.setting.social_settings')->withSettings($settings);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function social_widgets_settings()
    {
        $settings = Setting::first();

        return view('admin.setting.social_widgets_settings')->withSettings($settings);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'site_title' => 'required|max:80',
            'footer_text' => 'required',
        ]);

        $setting = Setting::findOrFail($id);
        $setting->site_title = $request['site_title'];
        $setting->meta_keywords = $request['meta_keywords'];
        $setting->meta_description = $request['meta_description'];
        $setting->footer_text = $request['footer_text'];

        if ($setting->save()) {
            return redirect('/admin/settings')->withSuccess('Settings has been updated!');
        } else {
            return redirect('/admin/settings')->withErrors(['error' => 'Error updating Settings !']);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update_logo_settings(Request $request, $id)
    {
        $this->validate($request, [
            'logo_1' => 'required',
            'favicon' => 'required',
        ]);

        $setting = Setting::findOrFail($id);
        $setting->logo_1 = $request['logo_1'];
        $setting->logo_2 = $request['logo_2'];
        $setting->favicon = $request['favicon'];
        $setting->no_image = $request['no_image'];

        if ($setting->save()) {
            return redirect('/admin/logo_settings')->withSuccess('Settings has been updated!');
        } else {
            return redirect('/admin/logo_settings')->withErrors(['error' => 'Error updating Settings !']);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update_banner_settings(Request $request, $id)
    {
        $this->validate($request, [
            'banner_image' => 'required',
        ]);

        $setting = Setting::findOrFail($id);
        $setting->banner_image = $request['banner_image'];
        if ($setting->save()) {
            return redirect('/admin/banner_settings')->withSuccess('Settings has been updated!');
        } else {
            return redirect('/admin/banner_settings')->withErrors(['error' => 'Error updating Settings !']);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update_about_settings(Request $request, $id)
    {
        $this->validate($request, [
            'about_name' => 'required',
            'about_description' => 'required',
            'about_image' => 'required',

        ]);
        $setting = Setting::findOrFail($id);
        $setting->about_name = $request['about_name'];
        $setting->about_description = $request['about_description'];
        $setting->about_image = $request['about_image'];
        if ($setting->save()) {
            return redirect('/admin/about_settings')->withSuccess('Settings has been updated!');
        } else {
            return redirect('/admin/about_settings')->withErrors(['error' => 'Error updating Settings !']);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update_social_settings(Request $request, $id)
    {

        $setting = Setting::findOrFail($id);
        $setting->facebook_link = $request['facebook_link'];
        $setting->instagram_link = $request['instagram_link'];
        $setting->twitter_link = $request['twitter_link'];
        $setting->youtube_link = $request['youtube_link'];

        if ($setting->save()) {
            return redirect('/admin/social_settings')->withSuccess('Settings has been updated!');
        } else {
            return redirect('/admin/social_settings')->withErrors(['error' => 'Error updating Settings !']);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update_social_widgets_settings(Request $request, $id)
    {

        $setting = Setting::findOrFail($id);
        $setting->facebook_app_id = $request['facebook_app_id'];
        $setting->facebook_app_secret = $request['facebook_app_secret'];
        $setting->facebook_page_url = $request['facebook_page_url'];

        if ($setting->save()) {
            return redirect('/admin/social_widgets_settings')->withSuccess('Settings has been updated!');
        } else {
            return redirect('/admin/social_widgets_settings')->withErrors(['error' => 'Error updating Settings !']);
        }
    }

}
