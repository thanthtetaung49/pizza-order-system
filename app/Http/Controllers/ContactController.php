<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // location to user contactUs
    public function contactUs(){
        return view('user.contact.contact');
    }

    // user contact
    public function contact(Request $request) {
        $this->contactValidationCheck($request);
        $contact = $this->insertContactData($request);
        Contact::create($contact);
        return redirect()->route("user#contactUs")->with([
            "success" => "Your message send to our team."
        ]);
    }

    // contact validation check
    private function contactValidationCheck($request){
       Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
            "message" => "required",
       ])->validate();
    }

    // insert contact data
    private function insertContactData($request) {
        return [
            "name" => $request->name,
            "email" => $request->email,
            "message" => $request->message
        ];
    }
}
