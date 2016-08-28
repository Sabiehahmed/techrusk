<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners  = Banner::latest('created_at')->get();
        return view('admin.banner.index')->with(['banners'=>$banners,'pageTitle'=>'Banner Settings']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/admin/banner_settings');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banner = new Banner;
        $banner->alt = $request['alt'];
        $banner->image = $request['image'];
        if($banner->save())
        {
            return redirect('/admin/banner_settings')->withSuccess('Banner Created Success');
        }
        else
        {
            return redirect('/admin/banner_settings')->withError('Error Created Banner');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        $banners  = Banner::latest('created_at')->get();
        return view('admin.banner.edit')->with(['banner_'=>$banner,'banners'=>$banners]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $banner =  Banner::findOrFail($id);
        $banner->alt = $request['alt'];
        $banner->image = $request['image'];
        if($banner->save())
        {
            return redirect('/admin/banner_settings')->withSuccess('Banner Has Been Updated');
        }
        else
        {
            return redirect('/admin/banner_settings')->withError('Error Updating Banner');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner =  Banner::findOrFail($id);
        $banner->delete();
        return redirect('/admin/banner_settings')->withSuccess('Banner has been deleted');
    }
}
