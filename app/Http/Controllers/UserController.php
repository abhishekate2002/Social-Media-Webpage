<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showFollowings() {
        $following = auth()->user()->following()->paginate(10);
        return view('following')->with(['following'=>$following]);
    }

    public function followUser($id)
    {
        auth()->user()->following()->save(User::findOrFail($id));
        return redirect()->back();
    }

    public function unfollowUser($id)
    {
        auth()->user()->following()->detach(User::findOrFail($id));
        return redirect()->back();
    }

    public function search(Request $reqest)
    {
        $user = User::where('username','LIKE','%'.$reqest['search-input'].'%')->paginate("10");
        if(count($user) > 0)
        {
            return view('search')->withDetails($user)->withQuery($reqest['search-input']);
        }

        else return view ('search')->withMessage('No results found')->withQuery($reqest['search-input']);
        }
    //
}
