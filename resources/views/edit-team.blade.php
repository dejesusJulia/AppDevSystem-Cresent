@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7">
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
                                <input type="text" name="team_name" id="team-name" class="form-control">
                            </div>
        
                            <div class="form-group">
                                <label for="team-vision">Vision</label>
                                <textarea name="team_vision" id="team-vision" cols="30" rows="5" class="form-control"></textarea>
                            </div>
        
                            <div class="form-group">
                                <label for="team_objectives">Objectives</label>
                                <textarea name="team_objectives" id="team-objectives" cols="30" rows="5" class="form-control"></textarea>
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
                                        <span class="btn btn-sm btn-danger">&times;</span>
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
                                    <span class="btn btn-success btn-sm">&plus;</span>
                                </li>

                                <form action="" method="post" id="add-member-form-{{$sent->receiver_id}}" class="d-none">
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
                                    <span class="btn btn-success btn-sm">&plus;</span>
                                </li>
                                <form action="" method="post" id="add-" class="d-none">
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