<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Image;
//use Illuminate\Support\Facades\Request;  

class ProfileController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('profile', ['user'=>$user]);
    }

    public function edit()
    {   
        $user = Auth::user();
        return view('profileEdit', ['user'=>$user]);
    }

    public function update_profile(Request $request)
    {   
        //insert current user
        $user = Auth::user();

        //validation 
        $request->validate([
            'name' => 'required|max:40',
            'email' => 'required',
            'bio' => 'max:255',
            //'avatar' => 'image|mimes:jpeg,jpg,png'
        ]);

        //set Form data into User data except avater image
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename =  time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/avatars/' . $filename ));
            $user->avatar = $filename;
        }

        // save updated User Information to DB
        $user->save();

        //redirect to user information
        return redirect()->to('/profile');
    }
}
