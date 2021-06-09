@extends('layouts.app')

@section('content')
{{-- ADD CATEGORY MODAL --}}
<div class="modal fade" id="subject-expertise">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Field of Expertise</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{route('category.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label for="subject-name" class="input-group-text">Subject</label>
                            </div>
                            <select name="subject_id" id="subject-name" class="custom-select" onchange="">
                                <option value="" selected disabled>Choose one</option>

                                @foreach ($data['subjects'] as $subject)
                                <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                @endforeach
                            </select>
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="others">Desribe unincluded field here</label>
                        <input type="text" name="others" id="others" class="form-control" placeholder="Describe your field here if its not included above">
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- DELETE FIELD MODAL --}}
@forelse ($data['categories'] as $category)
    <div class="modal fade" id="category-destroy-modal-{{$category->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                </div>

                <div class="modal-body">
                    @if ($category->subject_id == null)
                        <p>Are you sure you want to delete <em>{{$category->id}}</em> in your field?</p>
                    @else
                        <p>Are you sure you want to delete in <em>{{$category->subject_name}}</em> your field</p>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('category-destroy-form-{{$category->id}}').submit()">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="event.preventDefault()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@empty

@endforelse

{{-- DELETE CONNECTION MODAL --}}
@foreach ($data['sent'] as $sents)
    <div class="modal fade" id="sent-destroy-modal-{{$sents->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                </div>

                <div class="modal-body">
                    Are you sure you want delete your request to {{$sents->name}}?
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('connection-destroy-form-{{$sents->id}}').submit()">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="event.preventDefault()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- MAIN CONTENT --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-alert></x-alert>
            <div class="card mb-3">
                <div class="card-header">
                    <h3>User Dashboard</h3>
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

            {{-- USER INFO --}}
            <div class="card mb-3">
                <div class="card-header">
                    User info
                </div>
                <div class="card-body">
                    <ul>
                        <li>Name: {{$data['user']->name}}</li>
                        <li>Position: {{$data['user']->position}}</li>
                        <li>Email: {{$data['user']->email}}</li>
                        <li>Personal Website/Social Media: {{$data['user']->website}}</li>
                    </ul>
                    <h4>About:</h4>
                    <p>{{$data['user']->about}}</p>

                    {{-- FIELDS OF EXPERTISE --}}
                    <h4>Fields of Expertise:</h4>
                    <ul class="list-unstyled">
                        @forelse ($data['categories'] as $category)
                            <li>
                                @if ($category->subject_id == null)
                                    {{$category->others}}
                                @else
                                    {{$category->subject_name}}
                                @endif
                                - 
                                <a href="#" data-target="#category-destroy-modal-{{$category->id}}" data-toggle="modal">Delete</a> 
                            </li>
                            
                            <form action="{{route('category.destroy', $category->id)}}" method="post" id="category-destroy-form-{{$category->id}}" class="d-none">
                                @csrf
                                @method('delete')
                            </form>
                        
                        @empty 
                        <li>You have not added any fields</li>
                        @endforelse
                    </ul>
                  
                    {{-- OTHERS --}}
                    <h4>Others</h4>
                    <ul>
                        <li>
                            <a href="{{route('profile.edit', auth()->user()->id)}}">Edit profile</a>
                        </li>

                        <li>
                            <a href="#" data-target="#subject-expertise" data-toggle="modal">Add field of expertise</a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- SENT REQUESTS --}}
            <div class="card mb-3">
                <div class="card-header">
                    Sent requests
                </div>
                <div class="card-body">
                    <ul>
                        <li>
                            @forelse ($data['sent'] as $sent)
                            {{$sent->name}} - {{$sent->email}}

                            - <a href="#" data-target="#sent-destroy-modal-{{$sent->id}}" data-toggle="modal">Delete request</a>

                            <form action="{{route('connection.destroy', $sent->id)}}" method="post" id="connection-destroy-form-{{$sent->id}}">
                                @csrf
                                @method('delete')
                            </form>
                            @empty
                                You have not sent anything
                            @endforelse
                        </li>     
                    </ul>
                </div>
            </div>

            {{-- RECEIVED REQUESTS --}}
            <div class="card mb-3">
                <div class="card-header">
                    Received requests
                </div>
                <div class="card-body">
                    <ul>  
                        @forelse ($data['received'] as $received)
                        <li class="mb-2">
                            {{$received->name}} - {{$received->email}}

                            @if ($received->accept === null)
                                <span class="btn btn-success btn-sm mr-2" onclick="event.preventDefault();document.getElementById('accept-{{$received->id}}').submit();">
                                    confirm
                                </span>

                                <span class="btn btn-secondary btn-sm" onclick="event.preventDefault(); document.getElementById('decline-{{$received->id}}').submit();">Decline</span>

                            @elseif($received->accept == true)
                                <span class="btn btn-success btn-sm disabled mr-2">
                                    confirmed
                                </span>

                                <span class="btn btn-secondary btn-sm" onclick="event.preventDefault(); document.getElementById('decline-{{$received->id}}').submit();">Decline</span>
                            
                            @elseif($received->accept == false)
                                <span class="btn btn-success btn-sm mr-2" onclick="event.preventDefault();document.getElementById('accept-{{$received->id}}').submit();">
                                confirm
                                </span>

                                <span class="btn btn-secondary btn-sm disabled mr-2">
                                    declined
                                </span>
                            @endif

                            <form action="{{route('connection.acceptrequest', $received->id)}}" method="post" id="accept-{{$received->id}}" class="d-none">
                                @csrf
                                @method('put')
                            </form>

                            <form action="{{route('connection.declinerequest', $received->id)}}" method="post" id="decline-{{$received->id}}" class="d-none">
                                @csrf
                                @method('put')
                            </form>
                        </li>
                        @empty
                            <li>You have no connection requests</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
