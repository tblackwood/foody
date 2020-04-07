<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\ReservationConfirmed;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ReservationController extends Controller
{
    public function index(Request $request){
        $reservations = Reservation::orderByDesc('created_at')->get();

        return view('admin.reservation.index', compact('reservations'));
    }

    public function status(Request $request, $id){
        $reservation = Reservation::find($id);
        $reservation->status = true;
        $reservation->save();

        Notification::route('mail', $reservation->email)
            ->notify( new ReservationConfirmed($reservation));

        return redirect()->back()->with(['successMsg'=>'Successfully confirmed','alert_type'=>'alert-success']);
    }

    public function destroy(Request $request, $id){
        Reservation::find($id)->delete();

        return redirect()->back()->with(['successMsg'=>'Successfully deleted','alert_type'=>'alert-success']);
    }
}
