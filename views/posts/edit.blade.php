@extends('layouts.app')
@section('title', 'Edit Post')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Post</div>
                <div class="card-body">
                    <form method="POST" action="/posts/{{$post->id}}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf 
                        <div class="row mb-5">
                            <label for="title" class="col-md-3 col-form-label text-md-end">Title</label>

                            <div class="col-md-7">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$post->title}}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label for="body" class="col-md-3 col-form-label text-md-end">Body</label>

                            <div class="col-md-7">
                                <textarea id="body" type="text" class="form-control @error('body') is-invalid @enderror" name="body" required autocomplete="body">{{$post->body}}</textarea>
                            </div>
                        </div>

                        

                        <div class="row mb-5">
                            <label class="col-md-3 col-form-label text-md-end">Add image(s)</label>
                            <div class="col-md-7">
                                <input id="images" type="file" name="images[]" class="form-control" multiple>
                            </div>
                        </div>

                        @if (isset($post->images))
                            <div class="row mb-5 justify-content-center">
                                <label class="col-md-3">Remove Images:</label>

                                <div class="col-md-7 form-group">
                                @foreach ($post->images as $image)
                                <input id="{{$image->id}}" name="{{$image->id}}" tabindex="1" class="form-check-input col-1 align-middle" type="checkbox" />
                                <img class="img-thumbnail col-2 mx-2 align-middle" src="/images/{{$image->path}}" alt=""/>    
                                    
                                @endforeach
                                </div>
                            </div>
                            @endif

                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
