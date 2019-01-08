<?php

namespace App\Http\Controllers;

use App\favorite;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getActivate', 'index', 'show']]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user_id = Auth::user()->id;
        $favorites = favorite::where('user_id', $user_id)->get();
        
        $posts = [];
        foreach($favorites as $fav){
            array_push($posts, Post::find($fav->post_id));
        }
        return view('favorite')->with('posts', $posts);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $postId){
        $favorite = new favorite;
        $favorite->user_id = Auth::user()->id;
        $favorite->post_id = $postId;
        $favorite->save();

        $post = Post::findOrFail($postId);
        return redirect()->action('PostsController@show', $post->id);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($postId){
        $user_id = Auth::id();
        $favorite = favorite::where('user_id', $user_id)->where('post_id', $postId)->delete();
        return back();
    }
}
