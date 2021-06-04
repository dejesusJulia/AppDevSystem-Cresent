@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    Admin Dashboard
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    View, Modify, or Delete
                </div>

                <div class="card-body">
                    <ul>
                        <li>
                            <a href="{{route('position.index')}}">Positions</a>
                        </li>

                        <li>
                            <a href="{{route('users.index')}}">Users</a>
                        </li>

                        <li>
                            <a href="{{route('subject.index')}}">Subjects</a>
                        </li>
                    </ul>     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
