<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Notifications\StatusUpdate;

class CommentController extends Controller
{
    //

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiIndex(Post $post)
    {
        return response()->json($post->comments()->with('user', 'user.image')->paginate(10));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apiStore(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|min:3|max:255',
        ]);
        
        // Create and save the comment
        $comment = new Comment();
        $comment->body = $request->comment;
        $comment->post_id = $request->postID;
        $comment->user_id = $request->userID;
        $comment->save();
        
        // Notify post creator if not the same user
        $creator = Post::findOrFail($request->postID)->blog->user;
        if ($creator->id != $request->userID)
        {
            $creator->notify(new StatusUpdate($request->postID));
        }
               
        return response()->json("Comment added.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function apiUpdate(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required|string|min:3|max:255',
        ]);

        $comment->body = $request->comment;
        $comment->save();
        return response()->json("Comment updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function apiDestroy($id)
    {
        Comment::destroy($id);
        return response()->json("Comment deleted.");
    }
}
