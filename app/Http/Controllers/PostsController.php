<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\favorite;
use App\Comment;
use Image;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getActivate', 'index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts =  Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        if($request->hasFile('cover_image')){
            //Unique FileName
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;

            //Resize File to 500px width
            $image = $request->file('cover_image');
            $img = Image::make($image);
            $img->resize(500, null, function ($constraint) {$constraint->aspectRatio();});
            $imglocation = storage_path('app/public/cover_images/' . $fileNameToStore);
            $img->save($imglocation);

            //Adding Pixelation & Watermark
            $censored = Image::make($img);
            $censored->pixelate(12);
            $water_mark = Image::make('default_images/clickme.png')->resize(125,125);
            $censored->insert($water_mark, 'center');

            $cenlocation = storage_path('app/public/post_censored_watermark/' . $fileNameToStore);
            $censored->save($cenlocation);

        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $favorite = favorite::where('post_id', $id)->where('user_id', Auth::id())->first();
        $comments = Comment::where('post_id', $post->id)->orderBy('created_at', 'DESC')->get();
        return view('posts.show')->with(array('post'=>$post, 'favorite'=>$favorite, 'comments'=>$comments));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if(auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with('error', 'You are not authorized to edit that post');
        }
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        if($request->hasFile('cover_image')){
            //Unique FileName
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;

            //Resize File to 500px width
            $image = $request->file('cover_image');
            $img = Image::make($image);
            $img->resize(500, null, function ($constraint) {$constraint->aspectRatio();});
            $imglocation = storage_path('app/public/cover_images/' . $fileNameToStore);
            $img->save($imglocation);

            //Adding Pixelation & Watermark
            $censored = Image::make($img);
            $censored->pixelate(12);
            $water_mark = Image::make('default_images/clickme.png')->resize(125,125);
            $censored->insert($water_mark, 'center');

            $cenlocation = storage_path('app/public/post_censored_watermark/' . $fileNameToStore);
            $censored->save($cenlocation);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image')){
            if ($post->cover_image != 'noimage.jpg') {
                Storage::delete('public/cover_images/'.$post->cover_image);
                Storage::delete('public/post_censored_watermark/'.$post->cover_image);
            }
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with('error', 'You are not authorized to edit that post');
        }

        if($post->cover_image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);
            Storage::delete('public/post_censored_watermark/'.$post->cover_image);
        }

        $post->delete();

        return redirect('/posts')->with('success', 'Post Removed');
    }
}
