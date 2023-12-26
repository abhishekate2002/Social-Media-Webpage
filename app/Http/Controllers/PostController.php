<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'delete']]);
        // Alternativly
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($blog_id)
    {
        return view();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->blog == null)
        {
            abort(404);
        }

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
        $request->validate([
            'title' => 'required|max:20',
            'body' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        
        $post->blog_id = auth()->user()->blog->id;
        $post->save();
      
        if ($request->hasFile('images'))
        {
            foreach ($request->file('images') as $imageFile)
            {
                $image = new Image();
                $imageName = uniqid() . '.' .
                $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('images'), $imageName);
                $image->path = $imageName;
                $post->images()->save($image);
            }
        }

        return redirect()->route('blog', ['username'=>Auth::user()->username]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.view')->with('post', $post);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if ($post->blog->user != Auth::user())
        {
            return Redirect('home');
        }

        return view('posts.edit')->with(['post'=>Post::findOrFail($id)]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:20',
            'body' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        foreach ($post->images as $image)
        {
            // Delete requested images
            if (isset($request[$image->id]))
            {
                $image->delete();
            }
        }

        if ($request->hasFile('images'))
        {
            foreach ($request->file('images') as $imageFile)
            {
                $image = new Image();
                $imageName = uniqid() . '.' .
                $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('images'), $imageName);
                $image->path = $imageName;
                $post->images()->save($image);
            }
        }

        return redirect()->route('blog', ['username'=>Auth::user()->username]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }
    
}
