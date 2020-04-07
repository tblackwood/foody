<?php

namespace App\Http\Controllers;

use App\MenuCategory;
use App\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $sliders = Slider::all();
        $menuCats = MenuCategory::limit(6)->get();
        return view('index', compact(['sliders','menuCats']));
    }
}
