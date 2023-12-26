@extends('layouts.app')
@section('title', $blog->user->username . '\'s blog')
@section('content')
<div class="container justify-content-center">
        <div class="card">
                <img class="card-img" style="height: 30em" src="/images/{{$blog->image->path}}" class="img-fluid" alt="" />
                <div class="card-img-overlay text-end"><h3><i class="text-white bi bi-gear-fill"></i></h3></div>
                <div class="card-img-overlay text-white d-flex flex-column justify-content-end gap-2 text-center">
                        <img style="max-height: 200px" class="rounded-circle col-md-2 col-sm-4" src="/images/{{$blog->user->image->path}}" alt="" />
                        <h2 class="card-title row-1 col-md-2 col-sm-4">{{ $blog->user->username }}</h2>
                </div>
        </div>
        <div class="card">
        <div class="card-body">
                <h5 class="card-subtitle">About</h5>
                <p class="mt-2 mb-2 pt-1 pb-1 border-top border-bottom">{{$blog->about}}</p>

                <p class="float-start col mt-3">Followers: {{count($blog->user->followers)}}</p>
                @if (!isset(Auth::user()->id))
                @elseif (Auth::user()->id == $blog->user->id)
                        <a class="float-end btn btn-primary col-md-2 col-sm-3" href="{{ route('posts.create') }}">New Post</a>
                @elseif ($isFollowing)
                        <a class="float-end btn btn-primary col-md-2 col-sm-3" href="{{ route('unfollow', $blog->user->id) }}">Unfollow</a>
                @else
                        <a class="float-end btn btn-primary col-md-2 col-sm-3" href="{{ route('follow', $blog->user->id) }}">Follow</a>
                @endif
        </div>      
</div>
@foreach ($posts as $post)
        <div class="card mt-5">
                <div class="card-header d-flex">
                        <h3 class="card-title col">{{$post->title}}</h3>

                        <div class="d-flex justify-content-end align-items-center ">
                        <h5 class="mb-0 mx-3">{{$post->created_at}}</h5>

                        @if (isset(Auth::user()->id) && (
                                Auth::user()->id == $blog->user->id || Auth::user()->is_admin == true
                                ))
                                <form action="{{ route('posts.destroy',  $post->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button name="Delete post" class="px-2 mx-2 btn btn-circle btn-lg d-flex justify-content-center align-items-center text-danger bi bi-x-circle-fill"></button>
                                </form>
                        @endif
                        @if (isset(Auth::user()->id) && (Auth::user()->id == $blog->user->id))
                                <a name="View post" class="px-2 btn btn-circle btn-lg d-flex justify-content-center align-items-center text-primary bi bi-pencil-square" href="{{ route('posts.edit',  $post->id)}}"></a>
                               
                        @endif
                        </div>
                </div>
                <div class="card-body row">
                        <h5 class="preview-text col">{{$post->body}}</h5>
                        <a class="float-end btn btn-primary col-md-2 col-sm-2 mx-md-3 mb-auto mt-auto" href="{{ route('posts.show',  $post->id)}}">
                                Continue Reading
                        </a>
                </div>
        </div>
@endforeach
<div class="mt-5">
{{$posts->links()}}
</div>
@endsection

