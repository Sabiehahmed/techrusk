<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\WidgetCreateRequest;
use App\Http\Requests\WidgetUpdateRequest;
use App\Widget;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $widgets = Widget::all();
        return view('admin.widget.index')->with(['categories'=>$categories,'widgets'=>$widgets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/admin/widget');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WidgetCreateRequest $request)
    {




        if( $widget  = Widget::create($request->all()))
        {
            return redirect('/admin/widget')->withSuccess('Widget Has Been Created');
        }
        else
        {
            return redirect('/admin/widget')->withErrors(['error'=>'Widget Can be created']);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $widget     = Widget::findOrFail($id);
        $categories = Category::all();
        $widgets = Widget::all();
        return view('admin.widget.edit')->with(['widget'=>$widget,'categories'=>$categories,'widgets'=>$widgets]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WidgetUpdateRequest $request, $id)
    {
        $widget     = Widget::findOrFail($id);
        $widget->title = e($request['title']);
        $widget->category_id = $request['category_id'];
        $widget->type = e($request['type']);
        $widget->save();
        return redirect('/admin/widget')->withSuccess('Widget has been updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $widget = Widget::findOrFail($id);
        $widget->delete();
        return redirect('/admin/widget')->withSuccess('Widget has been deleted!');
    }
}
