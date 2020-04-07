<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Menu;
use App\MenuCategory;
use App\Reservation;
use App\Slider;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categoryCount = MenuCategory::count();
        $menuCount = Menu::count();
        $reservations = Reservation::where('status', 'false')->get();
        $emails = Contact::count();
        $sliderCount = Slider::count();

        return view('admin.dashboard', compact(['categoryCount','menuCount','reservations','emails','sliderCount']));
    }
}
