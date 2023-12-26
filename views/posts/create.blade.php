@extends('layouts.app')
@section('title', 'New Post')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Post') }}</div>
                <div class="card-body">
                    <form method="POST" action="\posts" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-5">
                            <label for="title" class="col-md-3 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-7">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <label for="body" class="col-md-3 col-form-label text-md-end">{{ __('Body') }}</label>

                            <div class="col-md-7">
                                <textarea id="body" type="text" class="form-control @error('body') is-invalid @enderror" name="body" value="{{ old('body') }}" required autocomplete="body">
                                </textarea>
                            </div>
                        </div>

                        

                        <div class="row mb-5 align-items-center form-group @error('images') is-invalid @enderror">
                            <label class="col-md-3 col-form-label text-md-end ">Upload image(s)</label>

                            <div class="col-md-7">
                                <input id="images" type="file" name="images[]"  class="form-control" multiple>
                            </div>
                        
                        </div>

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
                                <a class="btn btn-danger" href="{{ route('blog', auth()->user()->username) }}">
                                    {{ __('Discard') }}
</a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Post') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
