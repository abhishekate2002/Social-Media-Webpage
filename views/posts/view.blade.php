@extends('layouts.app')
@section('title', $post->title)
@section('content')
<div class="container col-md-8 col-sm-5">
    <div class="card d-flex">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="align-items-center row">    
                <img class="rounded-circle col-5 col-md-3 mb-3 mb-md-0 profile-picture" src="{{ asset('images/' . $post->blog->user->image->path) }}" alt=""/>
                <h3 class="mb-0 col align-middle text-center text-md-start">
                    <a class="col text-reset text-decoration-none" href="{{route('blog', $post->blog->user->username)}}">{{$post->blog->user->username}}</a>
                </h3>
            </div>
            <div class="row align-middle">
                <div class="col text-center">
                    <p class="mb-1">Posted on:</p>
                    <p class="mb-1">{{$post->created_at}}</p>
                </div>
            </div>
        </div>
        <div class="card-body align-items-center justify-content-center">
            <h1>{{$post->title}}</h1>
            <h5 class="mb-5">{{$post->body}}</h5>

            @if (count($post->images) > 0)
            <div class="container d-flex mx-auto row col-10 mb-3">   
                <carousel
                    :per-page="1"
                    :navigation-enabled=true
                    :center-mode=true
                    zIndex= "100 !important"
                    navigation-next-label="<h2><i class='bi bi-caret-right-fill align-middle'></i><h2>"
                    navigation-prev-label="<h2><i class='bi bi-caret-left-fill align-middle'></i><h2>">
                @foreach ($post->images as $image)
                <slide class="container d-flex mx-auto">
                    <img class="img-fluid mx-auto" style="max-height:500px" src="{{ asset('images/' . $image->path) }}" alt="" />
                </slide>
                @endforeach
                </carousel>
            </div>
            @endif
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header row-1">   
            <h3 class="float-start">Comments</h3>
            <h3 id="commentCount" class="float-end">{{count($post->comments)}}</h3>
        </div>
        @if (Auth::check())
        <post-comment :post-i-d={{$post->id}} :user-i-d={{Auth::user()->id}}></post-comment>
        @endif
        <get-comments :post-i-d={{$post->id}} :user-i-d={{Auth::check() ? Auth::user()->id : 0}}></get-comments>
    </div>
@endsection
