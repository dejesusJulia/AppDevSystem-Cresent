@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <x-alert></x-alert>
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Edit Profile</h4>
              <p class="card-category">Complete your profile</p>
            </div>
            <div class="card-body">
              <form method="post" action="{{route('admin.updateprofile')}}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="form-group">
                  <label class="bmd-label-floating">Username</label>
                  <input type="text" class="form-control" name="name" value="{{$admin->name}}">
                </div>

                <div class="form-group">
                  <label class="bmd-label-floating">Email address</label>
                  <input type="email" class="form-control" name="email" value="{{$admin->email}}">
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group form-file-upload form-file-simple">
                      <input type="text" class="form-control inputFileVisible" placeholder="Avatar" value="{{$admin->avatar ?? ''}}">
                      <input type="file" class="inputFileHidden" id="avatarUpload" name="avatar">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Website</label>
                      <input type="text" class="form-control" name="website" value="{{$admin->website ?? ''}}">
                    </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                <div class="clearfix"></div>
              </form>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
@endsection