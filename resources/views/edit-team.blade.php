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
                    <div class="row w-100">
                        <div class="col-md-6">
                            <button class="btn btn-block --modal-btn-danger" onclick="event.preventDefault();document.getElementById('remove-member-form-{{$m->id}}').submit();">Remove</button>
                        </div>

                        <div class="col-md-6">
                            <button class="btn btn-block btn-secondary" onclick="event.preventDefault()" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    
                    
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
                <div class="card mb-3" style="border-radius: 15px">
                    <div class="card-header --goldenrod-bg --text-color-dark" style="border-radius: 15px 15px 0 0">
                        <h3 class="card-title mb-0">Edit team details</h3>
                    </div>

                    <div class="card-body --dark-lava-bg --text-color-goldenrod" style="border-radius: 0 0 15px 15px">
                        <form action="{{route('team.update', Auth::user()->team_id)}}" method="post">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label for="team-name">Team Name</label>
                                <input type="text" name="team_name" id="team-name" class="form-control --input-text-box" value="{{$data['teamInfo']->team_name}}">
                                @error('team_name')
                                    <small class="--text-color-danger">{{$message}}</small>
                                @enderror
                            </div>
        
                            <div class="form-group">
                                <label for="team-vision">Vision</label>
                                <textarea name="team_vision" id="team-vision" cols="30" rows="5" class="form-control --input-text-box">{{$data['teamInfo']->team_vision}}</textarea>
                                @error('team_vision')
                                    <small class="--text-color-danger">{{$message}}</small>
                                @enderror
                            </div>
        
                            <div class="form-group">
                                <label for="team_objectives">Objectives</label>
                                <textarea name="team_objectives" id="team-objectives" cols="30" rows="5" class="form-control --input-text-box">{{$data['teamInfo']->team_objectives}}</textarea>
                                @error('team_objectives')
                                    <small class="--text-color-danger">{{$message}}</small>
                                @enderror
                            </div>
        
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 order-md-2">
                                        <input type="submit" value="Update team" class="btn --btn-goldenrod-papaya btn-block mb-3" style="font-weight: 600">
                                    </div>
                                    <div class="col-md-6 order-md-1">
                                        <a href="{{route('home')}}" class="btn --btn-goldenrod-papaya btn-block mb-3" style="font-weight: 600">Back</a>
                                    </div>
                                </div>  
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- ASIDE SECTION --}}
            <div class="col-md-5">
                <div class="accordion" id="team-accordion">
                    {{-- MEMBERS --}}
                    <div class="card p-0 --dark-lava-bg">
                        <div class="card-header p-0 --goldenrod-bg --text-color-dark" id="members-header">
                            <button class="btn btn-block m-0" data-toggle="collapse" data-target="#member-collapse">Members</button>
                        </div>

                        <div id="member-collapse" class="collapse show" data-parent="#team-accordion">
                            <div class="card-body --dark-lava-bg --text-color-papaya-whip">
                                <div class="table-responsive">
                                    <table class="table table-borderless" id="members-tbl">
                                        <tbody>
                                            @forelse ($data['members'] as $member)
                                            <tr>
                                                <td>{{$member->name}}</td>
                                                <td>{{$member->email}}</td>
                                                
                                                @if (Auth::user()->position_id == 1 && $member->id !== Auth::user()->id)
                                                <td>
                                                    <span class="--tbl-danger-link" data-toggle="modal" data-target="#remove-member-modal-{{$member->id}}" style="cursor: pointer">
                                                        <i class="fas fa-times"></i>
                                                    </span>

                                                    <form action="{{route('team.removemember', $member->id)}}" method="post" id="remove-member-form-{{$member->id}}" class="d-none">
                                                        @csrf
                                                        @method('put')
                                                    </form>
                                                </td>
                                                @else
                                                <td>-</td>
                                                @endif
                                            </tr>
                                            @empty
                                                <tr>
                                                    no members
                                                </tr>
                                            @endforelse
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SENT REQUESTS --}}
                    <div class="card p-0 --dark-lava-bg">
                        <div class="card-header p-0 --goldenrod-bg --text-color-dark">
                            <button class="btn btn-block m-0" data-toggle="collapse" data-target="#sent-req-collapse">Sent Requests</button>
                        </div>

                        <div class="collapse" id="sent-req-collapse" data-parent="#team-accordion">
                            <div class="card-body --dark-lava-bg --text-color-papaya-whip">
                                <div class="table-responsive">
                                    <table class="table table-borderless" id="add-sent-tbl">
                                        <tbody>
                                            @forelse ($data['sent'] as $sent)
                                                <tr>
                                                    <td>{{$sent->name}}</td>
                                                    <td>{{$sent->email}}</td>
                                                    <td>
                                                        <span class="--tbl-success-link" onclick="event.preventDefault();document.getElementById('add-sent-form-{{$sent->receiver_id}}').submit()">
                                                            <i class="fas fa-plus"></i>
                                                        </span>

                                                        <form action="{{route('team.addmember', $sent->receiver_id)}}" method="post" id="add-sent-form-{{$sent->receiver_id}}" class="d-none">
                                                            @csrf
                                                            @method('put')
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty 
                                                <tr>
                                                    You have not sent new requests
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RECEIVED REQUESTS --}}
                    <div class="card p-0 --dark-lava-bg">
                        <div class="card-header p-0 --goldenrod-bg --text-color-dark">
                            <button class="btn btn-block m-0" data-toggle="collapse" data-target="#received-req-collapse">Received Requests</button>
                        </div>

                        <div class="collapse" id="received-req-collapse" data-parent="#team-accordion">
                            <div class="card-body --dark-lava-bg --text-color-papaya-whip">
                                <div class="table-responsive">
                                    <table class="table table-borderless" id="add-received-tbl">
                                        <tbody>
                                            @forelse ($data['received'] as $received)
                                                <tr>
                                                    <td>{{$received->name}}</td>
                                                    <td>{{$received->email}}</td>
                                                    <td>
                                                        <span class="--tbl-success-link" onclick="event.preventDefault();document.getElementById('add-received-form-{{$received->sender_id}}').submit()">
                                                            <i class="fas fa-plus"></i>
                                                        </span>
                                                        
                                                        <form action="{{route('team.addmember', $received->sender_id)}}" method="post" id="add-received-form-{{$received->sender_id}}" class="d-none">
                                                            @csrf
                                                            @method('put')
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty 
                                                <tr>You have not received any connection requests</tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection