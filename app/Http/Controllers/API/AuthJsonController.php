<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;


class AuthJsonController extends Controller
{
     /**
     * Handles Register Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|min:3|max:40',
            'email' => 'required|min:10|unique:users',
            'password' => 'required|min:6|max:15',
           // 'c_password' => 'required|same:password', 
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        
        $token = $user->createToken('LaraPassport')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    { 
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('LaraPassport')->accessToken; 
            return response()->json([
                'status' => 'success',
                'data' => $success
            ]); 
        } else { 
            return response()->json([
                'status' => 'error',
                'data' => 'Unauthorized Access'
            ]); 
        } 
    }

     /**
     * Handles Logout  Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
         Auth::user()->AauthAcessToken()->delete();
         return response()->json([
             'Logout successfully'
         ]);
    }

     /**
     * Display the detail of Authenticated User
     *
     * @return \Illuminate\Http\Response
     */
    public function authDetail()
    {
        $user = Auth::user(); 
        return response()->json(['success' => $user]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        $user->save();
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unregister(Request $request)
    {
        $user = Auth::user();
        $user->delete();
        return Response()->json([
            'Your account was deleted Successfully'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

 
}
