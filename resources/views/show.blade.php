@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-2">
                    <img src="{{asset('/storage/avatars/' . $user->avatar)}}" alt="avatar" class="rounded-circle" width="100px" height="100px">
                </div>
                <div class="col-10">
                    <h3>{{$user->name}}</h3>
                    <ul class="list-unstyled">
                        <li>{{$user->position}}</li>
                        <li>{{$user->email}}</li>
                        <li><a href="{{$user->website}}" class="text-decoration-none">{{$user->website}}</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card-body">
            <h4>About</h4>
            <p>{{$user->about}}</p>
        </div>

        <div class="card-footer">
            <a href="{{route('profile.view', $user->portfolio)}}" class="btn btn-info" target="blank">View resume</a>
            <a href="{{route('profile.download', $user->portfolio)}}" class="btn btn-success">Download</a>
            <a href="#" onclick="">Connect</a>

            <form action="" method="post" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection
