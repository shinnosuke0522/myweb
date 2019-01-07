<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('dashboard')->with('posts', $user->posts);
    }

    public function pdf()
    {
        //Get User Details & Posts
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $posts = $user->posts;

        //Template PDF by Marc
        $output ='
        <h2>WEB3 User Account Information</h2>
        <img style="height: auto; width: 30%; float: right" src="./avatars/'.$user->avatar.'">
        <table width="70%" style="border-collapse: collapse; border: 0px;">
        <tr>
        <td style="padding:0px; font-weight: bold;">Name</td>
        </tr>
        <tr>
        <td style="padding-bottom: 10px;">'.$user->name.'</td>
        </tr>
        <tr>
        <td style="padding:0px; font-weight: bold;">Email</td>
        </tr>
        <tr>
        <td style="padding-bottom: 10px;">'.$user->email.'</td>
        </tr>
        <tr>
        <td style="padding:0px; font-weight: bold;">Bio</td>
        </tr>
        <tr>
        <td style="padding-bottom: 10px;">'.$user->bio.'</td>
        </tr>
        </table>';

        if(count($posts) > 0)
        {
            $output .= '<h3>Your Posts</h3>';
            foreach($posts as $post){
                $output .= '<div style="width:100%; clear: both;">
                            <img style="height: auto; width: 29%; float: left" src="./storage/cover_images/'.$post->cover_image.'">
                            <div style="width: 70%; float: right; clear: left; display: block;">
                            <table width="100%" style="border-collapse: collapse; border: 0px;">
                            <tr>
                            <td style="padding:0px; font-weight: bold;">'.$post->title.'</td>
                            </tr>
                            <tr>
                            <td style="padding:0px;">'.$post->body.'</td>
                            </tr>
                            <tr>                          
                            <td style="padding:0px; color: #9e9e9e">Last updated at '.$post->updated_at.'</td>
                            </tr>
                            </table>
                            </div>
                            </div>';
            }
        }
        else{
            $output .= '<h3>No post has been submitted.</h3>';
        }


        //Create and Populate PDF
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($output);
        return $pdf->stream();
    }
}
