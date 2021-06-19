@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    Admin Dashboard
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <a href="{{route('admin.editprofile')}}">Edit profile</a>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    View, Modify, or Delete
                </div>

                <div class="card-body">
                    <ul>
                        <li>
                            <a href="{{route('position.index')}}">Positions</a>
                        </li>

                        <li>
                            <a href="{{route('users.index')}}">Users</a>
                        </li>

                        <li>
                            <a href="{{route('subject.index')}}">Subjects</a>
                        </li>
                    </ul>     
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">Count</div>
                <div class="card-body">
                    <ul>
                        <li>Users: {{$data['userCount']}}</li>
                        <li>Positions: {{$data['positionCount']}}</li>
                        <li>Subjects: {{$data['subjectCount']}}</li>
                        <li>Teams: {{$data['teamCount']}}</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <canvas id="positionsToUserChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <canvas id="subjectsToUserChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <canvas id="regUsersChart" width="400" height="400"></canvas>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Team Name</th>
                                <th scope="col">Team Members</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data['teamMembers'] as $team)
                            <tr>
                                <th scope="row">{{$team->team_id}}</th>
                                <th>{{$team->team_name}}</th>
                                <th>{{$team->count}}</th>
                                <th>
                                    <span class="btn btn-danger btn-sm">
                                        &times;
                                    </span>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection