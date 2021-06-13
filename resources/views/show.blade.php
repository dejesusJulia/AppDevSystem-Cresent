@extends('layouts.app')

@section('content')
<div class="container">
    <x-alert></x-alert>
    <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-2">
                    <img src="{{asset('/storage/avatars/' . $data['user']->avatar)}}" alt="avatar" class="rounded-circle" width="100px" height="100px">
                </div>
                <div class="col-10">
                    <h3>{{$data['user']->name}}</h3>
                    <ul class="list-unstyled">
                        <li>{{$data['user']->position}}</li>
                        <li>{{$data['user']->email}}</li>
                        <li><a href="{{$data['user']->website}}" class="text-decoration-none">{{$data['user']->website}}</a></li>
                        @isset($data['user']->team_id)
                            <li>{{$data['user']->team_name}}</li>
                        @endisset
                    </ul>
                </div>
            </div>
        </div>

        <div class="card-body">
            <h4>About</h4>
            <p>{{$data['user']->about}}</p>
        </div>

        <div class="card-footer">
            <a href="{{route('profile.view', $data['user']->portfolio)}}" class="btn btn-info" target="blank">View resume</a>
            <a href="{{route('profile.download', $data['user']->portfolio)}}" class="btn btn-success">Download</a>

            @if (Auth::user()->position_id == 1 || Auth::user()->team_id === null)
                @if (($data['user']->team_id == null || ($data['user']->team_id !== null && $data['user']->position == 'CEO/COO')) && (!($data['received']->contains('sender_id', $data['user']->id)) && !($data['sent']->contains('receiver_id', $data['user']->id))))
                    <a href="#" onclick="event.preventDefault();document.getElementById('connect-form').submit();">Connect</a>

                    <form action="{{route('connection.store')}}" method="post" id="connect-form" class="d-none">
                        @csrf
                        <input type="hidden" name="sender_id" value="{{Auth::user()->id}}">
        
                        <input type="hidden" name="receiver_id" value="{{$data['user']->id}}">
                    </form>  
                @endif   
            @endif

            
            
        </div>   
    </div>
</div>
@endsection

