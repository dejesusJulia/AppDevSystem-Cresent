@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <x-alert></x-alert>
          {{-- CARD CONTAINER --}}
          <div class="card">
            <div class="card-header card-header-primary">
              <div class="row">
                <div class="col-md-3 order-md-2">
                  <div class="text-right">
                    {{-- AVATAR --}}
                    <img src="{{asset('storage/avatars/'.$admin->avatar)}}" alt="avatar" class="img rounded-circle" style="width: 50px; height:50px;">
                    
                  </div>
                </div>
                <div class="col-md-9 order-md-1">
                  <h4 class="card-title">Edit Profile</h4>
                  <p class="card-category">Complete your profile</p>
                </div>
              </div>    
            </div>
            
            {{-- PROFILE FORM --}}
            <div class="card-body">
              <form method="post" action="{{route('admin.updateprofile')}}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="form-group">
                  <label class="bmd-label-floating">Username<span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="name" value="{{$admin->name}}">
                  @error('name')
                      <small class="text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="form-group">
                  <label class="bmd-label-floating">Email address<span class="text-danger">*</span></label>
                  <input type="email" class="form-control" name="email" value="{{$admin->email}}">
                  @error('email')
                      <small class="text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group form-file-upload form-file-simple">
                      <input type="text" class="form-control inputFileVisible" placeholder="Avatar">
                      <input type="file" class="inputFileHidden" id="avatarUpload" name="avatar">
                    </div>
                    @error('avatar')
                      <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Website<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" name="website" value="{{$admin->website ?? ''}}">
                      @error('website')
                        <small class="text-danger">{{$message}}</small>
                      @enderror
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