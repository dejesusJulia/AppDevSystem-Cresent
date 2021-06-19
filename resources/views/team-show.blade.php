@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">{{$group['details']->team_name}}</h4>
                        <span>{{$group['details']->created_at}}</span>
                    </div>
    
                    <div class="card-body">
                        <h5>Vision</h5>
                        <p>{{$group['details']->team_vision}}</p>
    
                        <h5>Objectives</h5>
                        <p>{{$group['details']->team_objectives}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach ($group['members'] as $member)
            <div class="col-md-3">
                <a href="{{route('users.show', $member->id)}}">
                    <div class="card mb-3">
                        <div class="card-body">
                            <img src="{{asset('/storage/avatars/'.$member->avatar)}}" alt="avatar" width="50px" height="50px">
                            <dl>
                                <dt>{{$member->name}}</dt>
                                <dd>{{$member->email}}</dd>
                            </dl>
                        </div>
                    </div>
                </a> 
            </div>
            @endforeach
        </div>
    </div>
@endsection