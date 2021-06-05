@extends('layouts.app')

@section('content')

{{-- DELETE MODAL --}}
@foreach ($users as $user)
    <div class="modal fade" id="user-destroy-{{$user->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <img src="{{asset('/storage/avatars/'. $user->avatar)}}" alt="avatar" class="rounded-circle" width="40px" height="40px">
                        </div>
                        <div class="col-sm-10">
                            <h4>{{$user->name}}</h4>
                            <ul>
                                <li>{{$user->email}}</li>
                                <li>{{$user->website}}</li>
                                <li>{{$user->position}}</li>
                            </ul>
                        </div>
                    </div>                
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" onclick="event.preventDefault();document.getElementById('user-destroy-{{$user->id}}').submit();">Delete</button>
                    <button class="btn btn-secondary" data-dismiss="modal" onclick="event.preventDefault()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{route('dash')}}" class="btn btn-secondary">Back</a>
            <div class="card mb-3">
                <div class="card-header">
                    <span class="card-title">Users with complete profile</span>
                </div>

                <div class="card-body">
                    <ul>
                        @foreach ($users as $user)
                        <li>
                            {{$user->name}} - {{$user->email}} - <a href="#" data-toggle="modal" data-target="#user-destroy-{{$user->id}}">delete</a>

                            <form action="{{route('users.destroy', $user->id)}}" method="post" style="display: none">
                                @csrf
                                @method('delete')
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
