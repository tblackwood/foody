<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MenuCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MenuCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = MenuCategory::all();
        return view('admin.menu-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu-category.create');
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
           'name' => 'required',
        ]);

        $category = New MenuCategory();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $image = $request->file('image');
        if(isset($image)){
            $imageName = Str::slug($request->name) .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('uploads/menu-category'))
            {
                mkdir('uploads/menu-category', 0777 , true);
            }
            $image->move('uploads/menu-category',$imageName);
            $category->image = $imageName;
        }
        try {
            $category->save();
            return redirect()->route('menu-category.index')->with(['successMsg'=>'Menu category Successfully edited','alert_type'=>'alert-success']);
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
        $category = MenuCategory::find($id);

        return view('admin.menu-category.edit', compact('category'));
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
            'name' => 'required',
        ]);

        $category = MenuCategory::find($id);
        $category->name = $request->name;

        $category->slug = Str::slug($request->name);
        $image = $request->file('image');
        if(isset($image)){
            $imageName = Str::slug($request->name) .'-'. uniqid() .'.'. $image->getClientOriginalExtension();
            if (!file_exists('uploads/menu-category'))
            {
                mkdir('uploads/menu-category', 0777 , true);
            }
            $image->move('uploads/menu-category',$imageName);
            $category->image = $imageName;
        }

        try {
            $category->save();
            return redirect()->route('menu-category.index')->with(['successMsg'=>'Menu category Successfully edited','alert_type'=>'alert-success']);
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
        $category = MenuCategory::find($id);
        if (file_exists($category->image))
        {
            unlink($category->image);
        }
        $category->delete();

        return redirect()->route('menu-category.index')->with(['successMsg'=> 'Menu category Successfully delited','alert_type' => 'alert-success']);
    }
}
