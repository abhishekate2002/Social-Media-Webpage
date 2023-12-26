<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\Blog;
use App\Models\Image;


class BlogController extends Controller
{
    //

     /**
     * Enforce middleware.
     */
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
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
            'about' => 'required|max:100|min:10',
            'profilePicture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'coverPicture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Add profile picture to user
        $profilePicture = new Image();
        $imageName = uniqid() . '.' .
            $request->profilePicture->getClientOriginalExtension();
        $request->profilePicture->move(public_path('images'), $imageName);
        $profilePicture->path = $imageName;

        // Add cover picture to blog
        $coverPicture = new Image();
        $imageName = uniqid() . '.' .
            $request->coverPicture->getClientOriginalExtension();
        $request->coverPicture->move(public_path('images'), $imageName);
        $coverPicture->path = $imageName;
        
        // Setup the blog
        $blog = new Blog();
        $blog->user_id = auth()->user()->id;
        $blog->about = $request->about;
        $blog->save();

        // Add relationships for the images
        auth()->user()->image()->save($profilePicture);
        $blog->image()->save($coverPicture);

        return redirect()->route('blog', auth()->user()->username);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $username
     * 
     */
    public function show($username)
    {
        
        $user = User::where('username', $username)->firstOrFail();
        $blog = $user->blog;

        if ($blog == null)
        {
            if ($user->id == auth()->user()->id)
            {
                return redirect()->route('blogs.create');
            } else
            {
                abort(404);
            }
        }
        
        if ($user->followers->contains(auth()->user()))
        {
            $isFollowing = true;
        } else
        {
            $isFollowing = false;
        }

        $posts = $blog->posts()->paginate(5);
        return view('blogs.view')->with(
            ['blog'=>$blog, 'posts'=>$posts, 'isFollowing'=>$isFollowing]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
