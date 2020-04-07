<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request){
        return view('contact');
    }

    public function sendMessage(Request $request){

        $this->validate($request,[
            'name'=>'required|min:3|max:255',
            'phone'=>'required|min:10|max:13',
            'email'=>'required|email',
            'message' => 'required',
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->save();

        return redirect()->back();
    }
}
