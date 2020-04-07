<?php

namespace App\Http\Controllers;

use App\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(){
        return view('reservation');
    }


    public function reserv(Request $request){

        $request->validate([
            'name'=>'required|min:3|max:255',
            'phone'=>'required|min:10|max:13',
            'email'=>'required|email',
            'date'=>'required',
            'time'=>'required',
        ]);

        $reserv = new Reservation();
        $reserv->name = $request->name;
        $reserv->phone = $request->phone;
        $reserv->email = $request->email;
        $reserv->date_and_time = $request->date .' '. $request->time;
        $reserv->people = $request->people;

        $reserv->save();

        return redirect()->back();
    }
}
