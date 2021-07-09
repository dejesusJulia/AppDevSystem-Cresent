@extends('layouts.app')

@section('content')
    <div class="container ">  
        <x-alert></x-alert>
        <a href="{{route('home')}}" class="--a-btn-custom-dark">Back</a>
        <div class="card --bg-translucent my-3">
            <div class="card-body rounded">
                <div class="pb-3">
                    <div class="media p-2 --card-body-bg rounded">
                        <img src="{{asset('/storage/avatars/' . $data['user']->avatar)}}" alt="avatar" class="rounded-circle m-2" width="80px" height="80px" style="object-fit: contain">
        
                        <div class="media-body pl-5">
                            <h3 class="mt-0 --text-color-light" style="font-weight: 800">{{$data['user']->name}}</h3>
                            <ul class="list-unstyled --text-color-light">
                                <li class="mb-1 --list-item-important">{{$data['user']->position}}</li>
                                <li class="mb-1 --list-item-important">{{$data['user']->email}}</li>
                                <li class="mb-1 --list-item-important"><a href="{{$data['user']->website}}" class="--a-links-dark">{{$data['user']->website}}</a></li>
                                @isset($data['user']->team_id)
                                    <li>{{$data['user']->team_name}}</li>
                                @endisset
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="pt-3 px-4 pb-2 --card-body-bg rounded">
                    <h4 class="--text-color-goldenrod" style="font-weight: 800 !important;">About</h4>
                    <p class="--text-color-light">{{$data['user']->about}}</p>
                    <div class="d-flex flex-wrap justify-content-end">
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
    

@endsection

