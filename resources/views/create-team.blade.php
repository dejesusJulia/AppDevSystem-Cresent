@extends('layouts.app')

@section('content')
<div class="container">
    <x-alert></x-alert>
    <div class="col-10 offset-1">
        <div class="card">
            <div class="card-header --goldenrod-bg --text-color-dark">
                <h3 class="mb-0" style="font-weight: 400">Create a new team</h3>
            </div>
            <div class="card-body --dark-lava-bg --text-color-goldenrod">
                <form action="{{route('team.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="team-name">Team Name<span class="text-danger">*</span></label>
                        <input type="text" name="team_name" id="team-name" class="form-control --input-text-box">
                        @error('team_name')
                            <small class="--text-color-danger">{{$message}}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="team-vision">Vision<span class="text-danger">*</span></label>
                        <textarea name="team_vision" id="team-vision" cols="30" rows="5" class="form-control --input-text-box"></textarea>
                        @error('team_vision')
                            <small class="--text-color-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="team_objectives">Objectives<span class="text-danger">*</span></label>
                        <textarea name="team_objectives" id="team-objectives" cols="30" rows="5" class="form-control --input-text-box"></textarea>
                        @error('team_objectives')
                            <small class="--text-color-danger">{{$message}}</small>
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
