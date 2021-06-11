@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-8 offset-2">
        <x-alert></x-alert>
        <a href="{{route('home')}}" class="btn btn-secondary mb-3">Back</a>
        <div class="card">
            <div class="card-header">
                Create a team
            </div>
            <div class="card-body">
                <form action="{{route('team.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="team-name">Team Name</label>
                        <input type="text" name="team_name" id="team-name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="team-vision">Vision</label>
                        <textarea name="team_vision" id="team-vision" cols="30" rows="5" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="team_objectives">Objectives</label>
                        <textarea name="team_objectives" id="team-objectives" cols="30" rows="5" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Create team" class="btn btn-primary btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
