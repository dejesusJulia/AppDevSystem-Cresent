@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-3 --bg-translucent p-3 my-3">
                    <div class="card-header --card-body-bg rounded mb-2">
                        <h2 class="card-title mb-0 --text-color-goldenrod">{{$group['details']->team_name}}</h2>
                        <span>{{$group['details']->created_at}}</span>
                    </div>
    
                    <div class="card-body --text-color-light --card-body-bg rounded ">
                        <h5 class="--text-color-goldenrod">Vision</h5>
                            <p>{{$group['details']->team_vision}}</p>
                        <h5 class="--text-color-goldenrod">Objectives</h5>
                            <p>{{$group['details']->team_objectives}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <h3 class="--text-color-dark text-center">Members</h3>
        </div>
        <div class="row justify-content-center">
            @foreach ($group['members'] as $member)
            <div class="col-md-6">
                <a href="{{route('users.show', $member->id)}}" class="--card-links-dark">
                    <div class="card mb-3 --card-bg-light">
                        <div class="card-body">
                            <img src="{{asset('/storage/avatars/'.$member->avatar)}}" alt="avatar" class="rounded-circle" style="width:50px; height:50px; object-fit:contain;">
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