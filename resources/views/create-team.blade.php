@extends('layouts.app')

@section('content')
<div class="container">
    <x-alert></x-alert>
    <div class="col-10 offset-1">
        <div class="card">
            <div class="card-header --card-header-bg --text-color-dark">
                <h3 class="mb-0" style="font-weight: 400">Create a new team</h3>
            </div>
            <div class="card-body --card-body-bg --text-color-goldenrod">
                <form action="{{route('team.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="team-name">Team Name</label>
                        <input type="text" name="team_name" id="team-name" class="form-control --input-text-box">
                        @error('team_name')
                            <small style="color: rgb(255, 121, 121)">{{$message}}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="team-vision">Vision</label>
                        <textarea name="team_vision" id="team-vision" cols="30" rows="5" class="form-control --input-text-box"></textarea>
                        @error('team_vision')
                            <small style="color: rgb(255, 121, 121)">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="team_objectives">Objectives</label>
                        <textarea name="team_objectives" id="team-objectives" cols="30" rows="5" class="form-control --input-text-box"></textarea>
                        @error('team_objectives')
                            <small style="color: rgb(255, 121, 121)">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 order-md-2">
                                <input type="submit" value="Create team" class="btn --btn-goldenrod-papaya btn-block mb-3" style="font-weight: 600">
                            </div>
                            <div class="col-md-6 order-md-1">
                                <a href="{{route('home')}}" class="btn --btn-goldenrod-papaya btn-block mb-3" style="font-weight: 600">Back</a>
                            </div>
                        </div>  
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
