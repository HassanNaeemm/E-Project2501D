<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
class UserController extends Controller
{
    public function chalo(Request $req){
        $abc = $req->username;
        $error = "Please ill in this field";
        if($abc == "")
        {
            return view('contact',compact('error'));
        }
        else
        {
           return view('contact',compact('abc'));
        }
        // return view('contact',compact('abc'));
    }
    public function insertdata(Request $req)
    {
        $success = "Form has been submitted";
        $name = $req->username;
        $email = $req->email;
        $subject = $req->subject;
        $msg = $req->message;
        $file = $req->file('myfile');
        $filename = $file->getClientOriginalName();

        if($name == "" || $email == "" || $subject == "" || $msg == "")
        {
            echo "All fields are required";
        }
        else
        {
        $destination = public_path('uploads');
        $file->move($destination,$filename);
        $contact = new Contact();
        $contact->contactname = $name;
        $contact->contactemail = $email;
        $contact->subject = $subject;
        $contact->message = $msg;
        $contact->userfile = $filename;
        $contact->save();
        return view('contact',compact('success'));
        }
    }
    
}
