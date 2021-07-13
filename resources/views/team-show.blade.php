@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-header h-25 --goldenrod-bg"></div>

                    {{-- ASIDE SECTION --}}
                    <div class="card-body --dark-lava-bg p-0 text-center">
                        <div class="list-group list-group-flush" style="border-radius: 15px">
                            <a href="{{route('home')}}" class="list-group-item list-group-action --links-list">Home</a>
                            <a href="{{route('search.searchresults')}}" class="list-group-item list-group-action --links-list">Search</a>
                            <a href="{{URL::previous()}}" class="list-group-item list-group-action --links-list">Back</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MAIN SECTION --}}
            <div class="col-md-9">
                <div class="card --dark-lava-bg rounded" style="border-radius: 15px !important;">
                    <div class="card-body">
                        <div class="p-3">
                            {{-- TEAM NAME  --}}
                            <div class="text-center">
                                <h2 class="card-title mb-0 --text-color-goldenrod">{{$group['details']->team_name}}</h2>
                                <span class="--text-color-papaya-whip">{{$group['details']->created_at}}</span>
                            </div>

                            <hr class="--separator">

                            {{-- TEAM VISION --}}
                            <h5 class="--text-color-goldenrod">Vision</h5>
                            <p class="--text-color-papaya-whip">{{$group['details']->team_vision}}</p>

                            <hr class="--separator">

                            {{-- TEAM OBJECTIVES --}}
                            <h5 class="--text-color-goldenrod">Objectives</h5>
                            <p class="--text-color-papaya-whip">{{$group['details']->team_objectives}}</p>

                            <hr class="--separator">

                            {{-- TEAM MEMBERS --}}
                            <div>
                                <h5 class="--text-color-goldenrod">Members</h5>
                                <div class="list-group list-group-flush --dark-lava-bg">

                                    @foreach ($group['members'] as $member)
                                    @if ($member->id !== Auth::user()->id)
                                        
                                    
                                    <a href="{{route('users.show', $member->id)}}" class="list-group-item list-group-item-action --links-list">
                                        <div class="media" style="background-color: transparent">
                                            {{-- IMG --}}
                                            <div class="--img --search-img" style="background-image: url('{{asset('storage/avatars/'. $member->avatar)}}')"></div>

                                            {{-- USER INFO --}}
                                            <div class="media-body pl-4 --text-color-papaya-whip">
                                                <dl>
                                                    <dt>{{$member->name}}</dt>
                                                    <dd>{{$member->email}}</dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </a>
                                    @else 
                                    <a href="{{route('home')}}" class="list-group-item list-group-item-action --links-list">
                                        <div class="media" style="background-color: transparent">
                                            <img src="{{asset('/storage/avatars/'.$member->avatar)}}" alt="" class="rounded-circle" style="width:50px; height:50px; object-fit:contain;">

                                            <div class="media-body pl-4 --text-color-papaya-whip">
                                                <dl>
                                                    <dt>{{$member->name}}</dt>
                                                    <dd>{{$member->email}}</dd>
                                                </dl>
                                            </div>
                                        </div>
                                    </a>

                                    @endif
                                    @endforeach
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection