@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    Users

                    <a href="{{route('dash')}}" class="btn btn-secondary">Back</a>
                </div>

                <div class="card-body">
                    <ul>
                        @foreach ($users as $user)
                        <li>
                            {{$user->name}} - {{$user->email}} - <a href="#" data-toggle="modal" data-target="#user-destroy-{{$user->id}}">delete</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
