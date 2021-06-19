@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{route('dash')}}" class="btn btn-outline-secondary btn-sm mb-3">back</a>
                <x-alert></x-alert>
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="{{route('admin.updateprofile')}}" method="post">
                            @csrf
                            @method('patch')

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" class="form-control" value="{{$admin->name}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" id="email" class="form-control" value="{{$admin->email}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <span class="col-form-label col-sm-2">Avatar</span>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" name="avatar" id="avatar" class="custom-file-input">
                                        <label for="avatar" class="custom-file-label">image.jpeg, image.png, image.jpg</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="website" class="col-sm-2 col-form-label">Website</label>
                                <div class="col-sm-10">
                                    <input type="text" name="website" id="website" class="form-control" value="{{$admin->website ?? ''}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Update Profile" class="btn btn-block btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection