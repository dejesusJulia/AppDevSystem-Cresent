@extends('layouts.app')

@section('content')

{{-- MAIN CONTENT --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @forelse ($data['users'] as $user)   
                <div class="card mb-3">
                    <div class="card-body row">
                        <div class="col-sm-2">
                            <img src="{{asset('/storage/avatars/'.$user->avatar)}}" alt="avatar" class="rounded-circle" width="30px" height="30px">
                        </div>

                        <div class="col-sm-10">
                            <h5>{{$user->name}}</h5>
                            <small>{{$user->email}}</small>
                            @if (isset($user->position))
                                <p>{{$user->position}} </p>
                            @endif

                            @if (isset($user->subject_name))
                               <p>{{$user->subject_name}} </p>
                            @endif
                            

                            @if (isset($user->others))
                                <p>{{$user->others}}</p>
                            @endif
                        </div>
                    </div>
                </div>

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
