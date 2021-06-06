@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-alert></x-alert>
            <div class="card mb-3">
                <div class="card-header">
                    <span class="card-title">Profile</span>
                    <a href="{{route('home')}}" class="btn btn-outline-secondary float-right">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" id="name" class="form-control" value="{{$data['authUser']->name}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" id="email" class="form-control" value="{{$data['authUser']->email}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-6">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="avatar" id="avatar" class="custom-file-input">
                                        <label class="custom-file-label" for="avatar">{{$data['authUser']->avatar ?? 'Upload avatar'}}</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="portfolio" id="portfolio" class="custom-file-input">
                                        <label for="portfolio" class="custom-file-label">{{$data['authUser']->portfolio ?? 'Upload resume'}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="website" class="col-sm-2 col-form-label">Website/Link</label>
                            <div class="col-sm-10">
                                <input type="text" name="website" id="website" class="form-control" value="{{$data['authUser']->website}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="about">About</label>
                            <div>
                                <textarea name="about" id="about" cols="30" rows="5" class="form-control">{{$data['authUser']->about}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <label for="position-id" class="input-group-text">Position</label>
                                </div>
                                <select name="position_id" id="position-id" class="custom-select">
                                    @foreach ($data['positions'] as $position)
                                    <option value="{{$position->id}}" {{$position->id == $data['authUser']->position_id ? 'selected' : ''}}>{{$position->position}}</option>
                                    @endforeach 
                                </select>
                            </div>   
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <ul>
                        <li>
                            <a href="{{route('profile.view', Auth::user()->portfolio)}}" target="blank">View</a>
                        </li>

                        <li>
                            <a href="{{route('profile.download', auth()->user()->portfolio)}}">Download pdf</a>
                        </li>
                    </ul>

                    
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-3">
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
