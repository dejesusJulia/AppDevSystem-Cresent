@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- PROFILE EDIT --}}
        <div class="col-md-8 order-md-2">
            <x-alert></x-alert>
            <div class="card mb-3" style="background-color: transparent; border: 0px; border-radius:15px;">
                <div class="card-header text-center --text-color-dark --goldenrod-bg" style="border-radius:15px 15px 0 0;">
                    <h4 class="card-title mb-0">Profile</h4>
                </div>
                <div class="card-body --dark-lava-bg --text-color-papaya-whip" style="border-radius: 0 0 15px 15px">
                    <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="text-center mb-2">
                            <div class="d-flex justify-content-center w-100 mb-3">
                                <div id="profile-img" class="--img align-self-center" style="background-image: url('{{asset('storage/avatars/'.$data['authUser']->avatar)}}')"></div>
                            </div>
                            

                            <div id="avatar-update mb-1">
                                <input type="file" name="avatar" id="avatar" hidden onchange="event.preventDefault(); document.getElementById('avatar-label').innerText = document.getElementById('avatar').files[0].name">
                                <label id="avatar-label" class="--file-label-btn-goldenrod" for="avatar">Upload your image</label>
                                @error('avatar')
                                    <small class="--text-color-danger">{{$message}}</small>
                                @enderror  
                            </div>

                            <div id="portfolio-update mb-1">
                                <input type="file" name="portfolio" id="portfolio" hidden onchange="event.preventDefault(); document.getElementById('portfolio-label').innerText = document.getElementById('portfolio').files[0].name">
                                <label for="portfolio" id="portfolio-label" class="--file-label-btn-goldenrod">Upload your resume/cv</label>

                                @error('portfolio')
                                    <div>
                                        <small class="--text-color-danger">{{$message}}</small>
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="name" id="name" class="form-control --input-text-box" value="{{$data['authUser']->name}}">
                                @error('name')
                                    <small class="--text-color-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="email" id="email" class="form-control --input-text-box" value="{{$data['authUser']->email}}">
                                @error('email')
                                    <small class="--text-color-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="website" class="col-sm-2 col-form-label">Website / Socmed<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="website" id="website" class="form-control --input-text-box" value="{{$data['authUser']->website}}">
                                @error('website')
                                    <small class="--text-color-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="about" class="col-sm-2 col-form-label">About<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea name="about" id="about" cols="30" rows="5" class="form-control --input-text-box">{{$data['authUser']->about}}</textarea>
                                
                                @error('about')
                                    <small class="--text-color-danger">{{$message}}</small>
                                @enderror
                            </div> 
                        </div>

                        <div class="form-group row">
                            <label for="position-id" class="col-sm-2">Position<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select name="position_id" id="position-id" class="custom-select --input-text-box">
                                    @foreach ($data['positions'] as $position)
                                    <option value="{{$position->id}}" {{$position->id == $data['authUser']->position_id ? 'selected' : ''}}>{{$position->position}}</option>
                                    @endforeach 
                                </select>
                            </div>
                            @error('position_id')
                                <small class="--text-color-danger">{{$message}}</small>
                            @enderror  
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 order-md-2">
                                    <input type="submit" value="Update" class="btn --btn-custom btn-block mb-3" style="font-weight: 600">
                                </div>
                                <div class="col-md-6 order-md-1">
                                    <a href="{{route('home')}}" class="btn --btn-custom btn-block mb-3" style="font-weight: 600">Back</a>
                                </div>
                            </div>  
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-3" style="background-color: transparent; border: 0px; border-radius:15px;">
                <div class="card-header --goldenrod-bg" style="border-radius:15px 15px 0 0;">
                    <h4 class="mb-0 card-title">CV Preview</h4>
                </div>
                <div class="card-body --dark-lava-bg" style="border-radius: 0 0 15px 15px">
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

        {{-- POSITIONS --}}
        <div class="col-md-4 order-md-1">
            <div class="card mb-3" style="background-color: transparent; border: 0px; border-radius:15px;">
                <div class="card-header --goldenrod-bg" style="border-radius:15px 15px 0 0;">
                    <span class="card-title">Positions and their functions</span>
                </div>

                <div class="card-body --dark-lava-bg --text-color-papaya-whip" style="border-radius: 0 0 15px 15px">
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
