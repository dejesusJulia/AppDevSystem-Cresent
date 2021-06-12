@extends('layouts.app')

@section('content')

{{-- MAIN CONTENT --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{route('home')}}" class="btn btn-outline-secondary mb-3">Back</a>
            @forelse ($data['users'] as $user)
                <a href="{{route('users.show', $user->user_id)}}" class="text-decoration-none">   
                    <div class="card mb-3">
                        <div class="card-body row">
                            <div class="col-sm-2">
                                <img src="{{asset('/storage/avatars/'.$user->avatar)}}" alt="avatar" class="rounded-circle" width="30px" height="30px">
                            </div>

                            <div class="col-sm-10">
                                <h5>{{$user->name}}</h5>
                                <small>{{$user->email}}</small>

                                @isset($user->position)
                                    <p>{{$user->position}} </p>
                                @endisset

                                @isset($user->subject_name)
                                    <p>{{$user->subject_name}} </p>
                                @endisset

                                @isset($user->others)
                                    <p>{{$user->others}}</p>
                                @endisset
                                
                            </div>
                        </div>
                    </div>
                </a>
            @empty 
                <div class="card mb-3">
                    <div class="card-body">
                        <h4>No results</h4>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
