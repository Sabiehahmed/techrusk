<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Menu;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Menu::orderBy('order')->get();
        $categories = Category::all();

        $menu = new Menu;
        $menu = $menu->getHTML($items);

        return view('admin.menu.index')->with(['items' => $items, 'menu' => $menu, 'categories' => $categories]);
    }


    public function reorder(Request $request)
    {

        $source = e($request->get('source'));


        $destination = e($request->get('destination', 0));
        $item = Menu::findOrFail($source);
        $item->parent_id = $destination;
        $item->save();
        $ordering = json_decode($request->get('order'));
        $rootOrdering = json_decode($request->get('rootOrder'));
        if ($ordering) {
            foreach ($ordering as $order => $item_id) {
                if ($itemToOrder = Menu::findOrFail($item_id)) {
                    $itemToOrder->order = $order;
                    $itemToOrder->save();
                }
            }
        } else {
            foreach ($rootOrdering as $order => $item_id) {
                if ($itemToOrder = Menu::findOrFail($item_id)) {
                    $itemToOrder->order = $order;
                    $itemToOrder->save();
                }
            }
        }

        return response('ok');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create a new menu item and save it
        $item = new Menu;
        $item->title = e($request->get('title', 'untitled'));
        $item->label = e($request->get('label', ''));
        $item->url = e($request->get('url', ''));
        $item->order = Menu::max('order') + 1;
        $item->save();
        return redirect('admin/menu')->withSuccess('Menu Item Has been saved!');;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function addFromCategory(Request $request)
    {
        $this->validate($request, [
            'categories' => 'required'
        ]);

        $categories = $request['categories'];

        foreach ($categories as $k => $id) {
            $category = Category::findOrFail($id);
            $item = new Menu;
            $item->title = e($category->title);
            $item->label = e($category->title);
            $item->url = url('/category') . '/' . e($category->slug);
            $item->order = Menu::max('order') + 1;
            $item->save();

        }


        return redirect('admin/menu')->withSuccess('Menu Item Has been saved!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Menu::findOrFail($id);
        $items = Menu::orderBy('order')->get();
        $categories = Category::all();

        $menu = new Menu;
        $menu = $menu->getHTML($items);

        return view('admin.menu.edit')->with(['emenu' => $item, 'items' => $items, 'menu' => $menu, 'categories' => $categories]);
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
        $item = Menu::findOrFail($id);
        $item->title = e($request->get('title', 'untitled'));
        $item->label = e($request->get('label', ''));
        $item->url = e($request->get('url', ''));
        $item->save();
        return redirect("admin/menu/edit/{$id}")->withSuccess('Menu Item Has been Updated!');;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->get('delete_id');
        // Find all items with the parent_id of this one and reset the parent_id to zero
        $items = Menu::where('parent_id', $id)->get()->each(function ($item) {
            $item->parent_id = 0;
            $item->save();
        });
        // Find and delete the item that the user requested to be deleted
        $item = Menu::findOrFail($id);
        $item->delete();
        return redirect('admin/menu')->withSuccess('Menu Item Has been deleted!');
    }
}
