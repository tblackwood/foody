<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request){
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

    public function show($id)
    {
        $contact = Contact::find($id);
        return view('admin.contact.show',compact('contact'));
    }

    public function destroy($id)
    {
        Contact::find($id)->delete();
        return redirect()->back()->with(['successMsg'=> 'Email  Successfully delleted','alert_type' => 'alert-success']);
    }
}
