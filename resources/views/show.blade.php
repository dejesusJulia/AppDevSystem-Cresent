@extends('layouts.app')

@section('content')
    <div class="container ">  
        <x-alert></x-alert>
        <div class="row">
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-header h-25 --goldenrod-bg"></div>

                    <div class="card-body --dark-lava-bg p-0 text-center">
                        <div class="list-group list-group-flush" style="border-radius: 15px">
                            <a href="{{route('home')}}" class="list-group-item list-group-action --links-list">Home</a>
                            <a href="{{route('search.searchresults')}}" class="list-group-item list-group-action --links-list">Search</a>
                            <a href="{{URL::previous()}}" class="list-group-item list-group-action --links-list">Back</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card --dark-lava-bg rounded" style="border-radius: 15px !important;">
                    <div class="card-body">
                        <div class="">
                            <div class="media p-2">
                                <img src="{{asset('/storage/avatars/' . $data['user']->avatar)}}" alt="avatar" class="rounded-circle m-2" width="80px" height="80px" style="object-fit: contain">
                
                                <div class="media-body pl-4 pr-3">
                                    <h3 class="mt-0 --text-color-light" style="font-weight: 800">{{$data['user']->name}}</h3>
                                    <ul class="list-unstyled --text-color-light">
                                        <li class="mb-1 --list-item-important">{{$data['user']->position}}</li>
                                        <li class="mb-1 --list-item-important">{{$data['user']->email}}</li>
                                        <li class="mb-1 --list-item-important"><a href="{{$data['user']->website}}" class="--a-links-dark">{{$data['user']->website}}</a></li>
                                        @isset($data['user']->team_id)
                                            <li>{{$data['user']->team_name}}</li>
                                        @endisset
                                    </ul>

                                    <hr class="--separator">

                                    <h4 class="--text-color-goldenrod" style="font-weight: 800 !important;">About</h4>
                                    <p class="--text-color-light">{{$data['user']->about}}</p>

                                    <div class="mt-5 d-flex flex-wrap justify-content-end">
                                        <a href="{{route('profile.view', $data['user']->portfolio)}}" class="--a-btn-custom mr-1 mb-1" target="blank">View resume</a>
                                        
                                        <a href="{{route('profile.download', $data['user']->portfolio)}}" class="--a-btn-custom mr-1 mb-1">Download Resume</a>
                                        
                                        @if (Auth::user()->position_id == 1 || Auth::user()->team_id === null)
                                            @if (($data['user']->team_id == null || ($data['user']->team_id !== null && $data['user']->position == 'CEO/COO')) && (!($data['received']->contains('sender_id', $data['user']->id)) && !($data['sent']->contains('receiver_id', $data['user']->id))))
                                                <a href="#" onclick="event.preventDefault();document.getElementById('connect-form').submit();" class="--a-btn-custom mb-1 mr-1">Connect</a>
        
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
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>

@endsection

