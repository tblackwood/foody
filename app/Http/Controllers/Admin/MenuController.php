<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Menu;
use App\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all()->load('category');

        return view('admin.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = MenuCategory::all();
        return view('admin.menu.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'category' => 'required',
            'image' => 'mimes:jpeg,jpg,png',
        ]);


        $menu = new Menu();
        $menu->name = $request->name;
        $menu->menu_category_id = $request->category;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $image = $request->image;
        if(isset($image)){
            $imageName = Str::slug($request->name) .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('uploads/menu-items'))
            {
                mkdir('uploads/menu-items', 0777 , true);
            }
            $image->move('uploads/menu-items',$imageName);
            $menu->image = $imageName;
        }
        try {
            $menu->save();
            return redirect()->route('menu-items.index')->with(['successMsg'=>'Menu Successfully added','alert_type'=>'alert-success']);
        }catch (\Exception $e){
            return back()->with(['successMsg'=>$e->getMessage(),'alert_type'=>'alert-danger']);
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
        $menu = Menu::find($id);
        $categories = MenuCategory::all();
        return view('admin.menu.edit', compact(['menu','categories']));
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
        $request->validate([
            'name'=>'required',
            'category' => 'required',
            'image' => 'mimes:jpeg,jpg,png',
        ]);


        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->menu_category_id = $request->category;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $image = $request->image;
        if(isset($image)){
            $imageName = Str::slug($request->name) .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('uploads/menu-items'))
            {
                mkdir('uploads/menu-items', 0777 , true);
            }
            $image->move('uploads/menu-items',$imageName);
            $menu->image = $imageName;
        }

        try {
            $menu->save();
            return redirect()->route('menu-items.index')->with(['successMsg'=>'Menu Successfully updated','alert_type'=>'alert-success']);
        }catch (\Exception $e){
            return back()->with(['successMsg'=>$e->getMessage(),'alert_type'=>'alert-danger']);
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
        $menu = Menu::find($id);
        if (file_exists($menu->image))
        {
            unlink($menu->image);
        }
        $menu->delete();

        return redirect()->route('menu-items.index')->with(['successMsg'=> 'Menu items Successfully dellited','alert_type' => 'alert-success']);
    }
}
