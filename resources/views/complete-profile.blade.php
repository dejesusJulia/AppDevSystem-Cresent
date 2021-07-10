@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-alert></x-alert>
            <div class="card mb-3">
                <div class="card-header --card-header-bg">
                    <h3>Complete your profile</h3>
                </div>
                <div class="card-body --card-body-bg --text-color-goldenrod p-4">
                    <form action="{{route('complete.update')}}" method="post" enctype="multipart/form-data" class="form">
                        @csrf
                        <div class="form-group row">
                            <div class="col-6 mb-1">
                                <input type="file" name="avatar" id="avatar" hidden onchange="event.preventDefault(); document.getElementById('avatar-label').innerText = document.getElementById('avatar').files[0].name">

                                <label for="avatar" id="avatar-label" class="--file-label-btn-goldenrod btn btn-block">Upload your image</label>

                                @error('avatar')
                                    <small style="color: rgb(255, 121, 121)">{{$message}}</small>
                                @enderror 
                            </div>
                            
                            <div class="col-6 mb-1">
                                <input type="file" name="portfolio" id="portfolio" hidden onchange="event.preventDefault(); document.getElementById('portfolio-label').innerText = document.getElementById('portfolio').files[0].name">
                                
                                <label for="portfolio" id="portfolio-label"
                                class="--file-label-btn-goldenrod btn btn-block">Upload resume</label>
                                @error('portfolio')
                                    <div>
                                        <small style="color: rgb(255, 121, 121)">{{$message}}</small>
                                    </div>
                                @enderror
                            </div>                      
                        </div>

                        <div class="form-group row">
                            <label for="website" class="col-sm-3">Website/Social Media</label>
                            <div class="col-sm-9">
                                <input type="text" name="website" id="website" class="form-control --input-text-box" placeholder="Put your personal website or link to your social media">
                                @error('website')
                                    <small style="color: rgb(255, 121, 121)">{{$message}}</small>
                                @enderror 
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="about" class="col-sm-3">About</label>
                            <div class="col-sm-9">
                                <textarea name="about" id="about" class="form-control --input-text-box" cols="20" rows="5"></textarea>
                                @error('about')
                                    <small style="color: rgb(255, 121, 121)">{{$message}}</small>
                                @enderror 
                            </div>  
                        </div>

                        <div class="form-group row">
                            <label for="position" class="col-sm-3">Position/Role</label>
                            <div class="col-sm-9">
                                <select name="position_id" id="position" class="--input-text-box form-control">
                                    <option value="" selected disabled>Choose one</option>
                                    @foreach ($positions as $position)
                                        <option value="{{$position->id}}">{{$position->position}}</option>
                                    @endforeach
                                </select>   
                                @error('position_id')
                                    <small style="color: rgb(255, 121, 121)">{{$message}}</small>
                                @enderror 
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn --a-btn-custom btn-block mb-1">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-md-4">
            <div class="card mb-3 --bg-translucent --text-color-dark">
                <div class="card-header">
                    Positions and their functions
                </div>
                <div class="card-body">
                    <dl>
                        @foreach ($positions as $position)
                        <dt>{{$position->position}}</dt>
                        <dd>{{$position->post_description}}</dd>
                        @endforeach
                        
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
