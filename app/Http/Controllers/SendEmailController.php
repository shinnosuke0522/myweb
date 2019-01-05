<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
//use Symfony\Component\HttpFoundation\Request;

class SendEmailController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function writeEmail()
    {
        return view('email.email');
    }
    public function sendEmail(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:100',
            'body' => 'required|min:10|max:1000'
        ]);

        $data = array(
            'name' => Auth::user()->name,
            'title' => $request->title,
            'body' => $request->body,
        );

        Mail::to('scream6847@gmail.com')->send(new SendMail($data));

        return back()->with('success', 'Thank you for contacting us!');
    }
}
