@extends('layouts.app')
@section('title', 'Blog Setup')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Blog Setup</div>
                <div class="card-body">
                    <form method="POST" action="\blogs" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-5 align-items-center">
                            <label for="about" class="col-md-3 col-form-label text-md-end">About</label>

                            <div class="col-md-7">
                                <input id="about" type="text" class="form-control @error('about') is-invalid @enderror" name="about" value="{{ old('about') }}" required autocomplete="about" autofocus>

                                @error('about')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="row mb-5 align-items-center">
                            <label for="profilePicture" class="col-md-3 col-form-label text-md-end">Profile Picture</label>

                            <div class="col-md-7">
                                <input id="profilePicture" type="file" name="profilePicture" class="form-control @error('profilePicture') is-invalid @enderror">
                            
                        
                            @error('profilePicture')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-5 align-items-center ">
                            <label class="col-md-3 col-form-label text-md-end">Cover Picture</label>

                            <div class="col-md-7">
                                <input id="coverPicture" type="file" name="coverPicture"  class="form-control @error('coverPicture') is-invalid @enderror">
                
                            @error('coverPicture')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-primary">Complete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
