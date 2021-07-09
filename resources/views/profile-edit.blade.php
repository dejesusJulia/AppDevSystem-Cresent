@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-alert></x-alert>
            <div class="card mb-3 rounded">
                <div class="card-header --card-header-bg">
                    <h3 class="card-title mb-0">Profile</h3>
                </div>
                <div class="card-body --card-body-bg --text-color-goldenrod">
                    <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="text-center mb-2">
                            <img src="{{asset('storage/avatars/'.$data['authUser']->avatar)}}" class="rounded-circle border border-warning mb-2" alt="avatar" style="object-fit: contain; width:200px; height: 200px;">

                            <div id="avatar-update mb-1">
                                <input type="file" name="avatar" id="avatar" hidden onchange="event.preventDefault(); document.getElementById('avatar-label').innerText = document.getElementById('avatar').files[0].name">
                                <label id="avatar-label" class="--file-label-btn-goldenrod" for="avatar">Upload your image</label>
                                @error('avatar')
                                    <small style="color: rgb(255, 121, 121)">{{$message}}</small>
                                @enderror  
                            </div>

                            <div id="portfolio-update mb-1">
                                <input type="file" name="portfolio" id="portfolio" hidden onchange="event.preventDefault(); document.getElementById('portfolio-label').innerText = document.getElementById('portfolio').files[0].name">
                                <label for="portfolio" id="portfolio-label" class="--file-label-btn-goldenrod">Upload your resume/cv</label>

                                @error('portfolio')
                                    <div>
                                        <small style="color: rgb(255, 121, 121)">{{$message}}</small>
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" id="name" class="form-control --input-text-box" value="{{$data['authUser']->name}}">
                                @error('name')
                                    <small style="color: rgb(255, 121, 121)">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" id="email" class="form-control --input-text-box" value="{{$data['authUser']->email}}">
                                @error('email')
                                    <small style="color: rgb(255, 121, 121)">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="website" class="col-sm-2 col-form-label">Website / Socmed</label>
                            <div class="col-sm-10">
                                <input type="text" name="website" id="website" class="form-control --input-text-box" value="{{$data['authUser']->website}}">
                                @error('website')
                                    <small style="color: rgb(255, 121, 121)">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="about" class="col-sm-2 col-form-label">About</label>
                            <div class="col-sm-10">
                                <textarea name="about" id="about" cols="30" rows="5" class="form-control --input-text-box">{{$data['authUser']->about}}</textarea>
                            </div>
                            @error('about')
                                <small style="color: rgb(255, 121, 121)">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="position-id" class="col-sm-2">Position</label>
                            <div class="col-sm-10">
                                <select name="position_id" id="position-id" class="custom-select --input-text-box">
                                    @foreach ($data['positions'] as $position)
                                    <option value="{{$position->id}}" {{$position->id == $data['authUser']->position_id ? 'selected' : ''}}>{{$position->position}}</option>
                                    @endforeach 
                                </select>
                            </div>
                            @error('position_id')
                                <small style="color: rgb(255, 121, 121)">{{$message}}</small>
                            @enderror  
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 order-md-2">
                                    <input type="submit" value="Update" class="btn --btn-goldenrod-papaya btn-block mb-3" style="font-weight: 600">
                                </div>
                                <div class="col-md-6 order-md-1">
                                    <a href="{{route('home')}}" class="btn --btn-goldenrod-papaya btn-block mb-3" style="font-weight: 600">Back</a>
                                </div>
                            </div>  
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header --card-header-bg">
                    <h4 class="mb-0 card-title">CV Preview</h4>
                </div>
                <div class="card-body --card-body-bg">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <a href="{{route('profile.view', Auth::user()->portfolio)}}" target="blank" class="btn --a-btn-custom btn-block mb-1">View Resume</a>
                        </div>

                        <div class="col-md-6">
                            <a href="{{route('profile.download', auth()->user()->portfolio)}}" class="btn --a-btn-custom btn-block mb-1">Download resume </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-3 --bg-translucent --text-color-dark">
                <div class="card-header">
                    <span class="card-title">Positions and their functions</span>
                </div>

                <div class="card-body">
                    <dl>
                    @foreach ($data['positions'] as $post)
                        <dt>{{$post->position}}</dt>
                        <dd>{{$post->post_description}}</dd>
                    @endforeach
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
