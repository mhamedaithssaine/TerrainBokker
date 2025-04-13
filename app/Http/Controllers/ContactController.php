<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
   public function index()
    {
        return view('contact');
    }


    public function submit(ContactRequest $request)
    {
      
        $data =[
            'name'=> $request->name,
            'email'=>$request->email,
            'message'=>$request->message,
        ];

         Mail::to('mhamedaithssaine1@gmail.com')->send(new ContactMail($data));

        return redirect()->route('contact')->with('success', 'Message envoyé avec succès !');
    }
}
