@extends('layouts.app')

@section('content')
@foreach ($data['members'] as $m)
    <div class="modal fade" id="remove-member-modal-{{$m->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Remove</h5>
                    <button class="close" type="button" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to remove {{$m->name}} from your team?
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger" onclick="event.preventDefault();document.getElementById('remove-member-form-{{$m->id}}').submit();">Remove</button>
                    <button class="btn btn-secondary" onclick="event.preventDefault()" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

    {{-- MAIN CONTENT --}}
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <x-alert></x-alert>
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Edit team details</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{route('team.update', Auth::user()->team_id)}}" method="post">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label for="team-name">Team Name</label>
                                <input type="text" name="team_name" id="team-name" class="form-control" value="{{$data['teamInfo']->team_name}}">
                            </div>
        
                            <div class="form-group">
                                <label for="team-vision">Vision</label>
                                <textarea name="team_vision" id="team-vision" cols="30" rows="5" class="form-control">{{$data['teamInfo']->team_vision}}</textarea>
                            </div>
        
                            <div class="form-group">
                                <label for="team_objectives">Objectives</label>
                                <textarea name="team_objectives" id="team-objectives" cols="30" rows="5" class="form-control">{{$data['teamInfo']->team_objectives}}</textarea>
                            </div>
        
                            <div class="form-group">
                                <input type="submit" value="Update team" class="btn btn-primary btn-block">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Members</h5>
                    </div>

                    <div class="card-body">
                        <h5>Current Members</h5>
                        <ul class="list-unstyled">
                            @forelse ($data['members'] as $member)
                                <li>
                                    {{$member->name}} - {{$member->email}}
                                    @if ($member->id !== Auth::user()->id)
                                        <span class="btn btn-sm btn-danger" data-toggle="modal" data-target="#remove-member-modal-{{$member->id}}">&times;</span>

                                        <form action="{{route('team.removemember', $member->id)}}" method="post" id="remove-member-form-{{$member->id}}" class="d-none">
                                            @csrf
                                            @method('put')
                                        </form>
                                    @else
                                        - You
                                    @endif
                                    
                                </li>
                            @empty
                                <li>You have no members yet</li>
                            @endforelse
                            
                        </ul>

                        <h5>Add members from sent requests</h5>
                        <ul class="list-unstyled">
                            @forelse ($data['sent'] as $sent)
                                <li>
                                    {{$sent->name}} - {{$sent->email}} - 
                                    <span class="btn btn-success btn-sm" onclick="event.preventDefault();document.getElementById('add-sent-form-{{$sent->receiver_id}}').submit()">&plus;</span>
                                </li>

                                <form action="{{route('team.addmembersent', $sent->receiver_id)}}" method="post" id="add-sent-form-{{$sent->receiver_id}}" class="d-none">
                                    @csrf
                                    @method('put')
                                </form>
                            @empty 
                                <li>You have not sent any requests</li>
                            @endforelse
                        </ul>

                        <h5>Add members from received request</h5>
                        <ul class="list-unstyled">
                            @forelse ($data['received'] as $received)
                                <li>
                                    {{$received->name}} - {{$received->email}} - 
                                    <span class="btn btn-success btn-sm" onclick="event.preventDefault();document.getElementById('add-received-form-{{$received->sender_id}}').submit()">&plus;</span>
                                </li>

                                <form action="{{route('team.addmemberreceived', $received->sender_id)}}" method="post" id="add-received-form-{{$received->sender_id}}" class="d-none">
                                    @csrf
                                    @method('put')
                                </form>
                            @empty 
                                <li>You have not received any connection requests</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection