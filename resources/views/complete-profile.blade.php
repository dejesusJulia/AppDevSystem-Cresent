@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-alert></x-alert>
            <div class="card mb-3">
                <div class="card-header">
                    <h3>Complete your profile</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('complete.update')}}" method="post" enctype="multipart/form-data" class="form">
                        @csrf
                        <div class="form-group row">
                            <div class="col-6">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="avatar" id="avatar" class="custom-file-input">
                                        <label class="custom-file-label" for="avatar">Choose photo</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="portfolio" id="portfolio" class="custom-file-input">
                                        <label for="portfolio" class="custom-file-label">Upload resume</label>
                                    </div>
                                </div>
                            </div>                      
                        </div>

                        <div class="form-group row">
                            <label for="website" class="col-sm-3">Website/Social Media</label>
                            <input type="text" name="website" id="website" class="col-sm-8 form-control" placeholder="Put your personal website or link to your social media">
                        </div>

                        <div class="form-group">
                            <label for="about">About</label>
                            <textarea name="about" id="about" class="form-control" cols="30" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label for="position" class="input-group-text">Your desired position/role</label>
                                </div>
                                <select name="position_id" id="position" class="custom-select">
                                    <option value="" selected disabled>Choose one</option>
                                    @foreach ($positions as $position)
                                        <option value="{{$position->id}}">{{$position->position}}</option>
                                    @endforeach
                                </select>
                            </div>    
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-md-4">
            <div class="card mb-3">
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
