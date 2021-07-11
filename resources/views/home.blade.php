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
@foreach ($data['sent']->data as $sents)
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

{{-- DELETE TEAM MODAL --}}
@isset(Auth::user()->team_id)
<div class="modal fade" id="team-delete-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete team</h5>
                <button class="close" type="button" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this team? 
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('delete-team-form-{{Auth::user()->team_id}}').submit()">Delete</button>

                <form action="{{route('team.destroy',Auth::user()->team_id)}}" method="post" class="d-none" id="delete-team-form-{{Auth::user()->team_id}}">
                    @csrf
                    @method('delete')
                </form>

                <button class="btn btn-sm btn-secondary" onclick="event.preventDefault()" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endisset
{{-- MAIN CONTENT --}}
<div class="container">
    <div class="row">
        {{-- USER INFORMATION/aside --}}
        <div class="col-md-4">
            <div class="card mb-3" style="background-color: transparent; border: 0px; border-radius:15px;">
                <div class="card-header --card-header-bg --text-color-light text-center" style="border-radius:15px 15px 0 0;">User Information</div>

                <div class="card-body --custom-card-body --card-body-bg --text-color-papaya-whip">
                    <div class="d-flex flex-column align-items-center text-center --users">

                        <img src="{{asset('storage/avatars/'. Auth::user()->avatar)}}" alt="user" class="rounded-circle" style="width: 100px; height:100px; object-fit:contain;">
                        <div class="mt-3">
                            <h4>{{$data['user']->name}}</h4>
                            <p class="--positions">{{$data['user']->position}}</p>
                            <div class="row">
                                <div class="col-md-5">
                                    <a href="{{route('profile.edit', auth()->user()->id)}}" class="--edit-profile btn btn-block">Edit profile</a>
                                </div>

                                <div class="col-md-7">
                                    <a href="#" data-target="#subject-expertise" data-toggle="modal" class="--add-expertise btn btn-block">Add field of expertise</a>

                                    
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>

                    <hr class="--separator">

                    <div class="row p-2">
                        <div class="col-12 mb-3 d-flex --details justify-content-between">
                            <div class="--icons">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="--info">{{$data['user']->website}}</div>
                        </div>

                        <div class="col-12 mb-3 d-flex justify-content-between --details">
                            <div class="--icons">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="--info">{{$data['user']->email}}</div>
                        </div>

                        @isset($data['user']->team_name)
                        <div class="col-12 mb-3 d-flex justify-content-between --details">
                            <div class="--icons">
                                <i class="fas fa-users"></i>
                            </div>

                            <div class="--info">{{$data['user']->team_name}}</div>
                        </div>
                        @endisset
                    </div>

                    <hr class="--separator">

                    <div class="p-2">
                        <div class="d-flex flex-column --about">
                            <h1>About</h1>
                            <p>{{$data['user']->about}}</p>
                        </div>
                    </div>

                    <hr class="--separator">

                    <div class="p-2">
                        <div class="d-flex flex-column">
                            <div class="--expertise">
                                <h1>Field/s of expertise</h1>
                            </div>

                            <div class="--fields d-flex flex-column">
                                @forelse ($data['categories'] as $category)
                                <div class="d-flex justify-content-between">
                                    @if ($category->subject_id == null || $category->others !== null)
                                    <p>{{$category->others}}</p>
                                    @else
                                    <p>{{$category->subject_name}}</p>
                                    <a href="#" data-target="#category-destroy-modal-{{$category->id}}" data-toggle="modal" class="--delete">Delete</a>

                                    <form action="{{route('category.destroy', $category->id)}}" method="post" id="category-destroy-form-{{$category->id}}" class="d-none">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    @endif   
                                </div>

                                @empty 
                                <div class="d-flex justify-content-center">
                                    <p>You have not added a field yet</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MAIN COLUMN --}}
        <div class="col-md-8">
            <x-alert></x-alert>
            {{-- DASH --}}
            <div class="card mb-3" style="background-color: transparent; border: 0px; border-radius:15px;">
                <div class="card-header --card-header-bg text-center --text-color-light" style="border-radius:15px 15px 0 0;">
                    <h3 class="mb-0">User Dashboard</h3>
                </div>

                <div class="card-body --card-body-bg --text-color-light --custom-card-body">
                    <div class="d-flex justify-content-around --dashboard">
                        <h5>Welcome to Cresent!</h5>
                        <a href="{{route('search.searchresults')}}" class="--search-link">Search Users</a>
                    </div>

                    
                </div>
            </div>

            {{-- SENT REQUESTS --}}
            <div class="card mb-3" style="background-color: transparent; border: 0px; border-radius:15px;">
                <div class="card-header --card-header-bg text-center --text-color-light" style="border-radius:15px 15px 0 0;">
                    Sent requests
                </div>
                <div class="card-body --card-body-bg --text-color-light --custom-card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="sent-reqs-tbl">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </thead>

                            <tbody>
                                @forelse ($data['sent']->data as $sent)
                                <tr>
                                    <td>{{$sent->name}}</td>
                                    <td>{{$sent->email}}</td>

                                    @if ($sent->accept == true)
                                    <td>Accepted</td>
                                    @elseif($sent->accept == false)
                                    <td>Declined</td>
                                    @elseif($sent->accept === null)
                                    <td>Not viewed Yet</td>
                                    <td>
                                        <a href="#" data-target="#sent-destroy-modal-{{$sent->id}}" data-toggle="modal">Delete request</a>
                                        <form action="{{route('connection.destroy', $sent->id)}}" method="post" id="connection-destroy-form-{{$sent->id}}">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if ($data['sent']->data !== null)
                    {{$data['sent']->current_page}}
                        {{-- <nav>
                            <ul class="pagination">
                                @if ($data['sent']->prev_page_url !== null)
                                    <li class="page-item">
                                        <a href="{{$data['sent']->prev_page_url}}" class="page-link">Prev</a>
                                    </li>
                                @else 
                                <li class="page-item disabled">
                                    <a href="#" class="page-link">Prev</a>
                                </li>
                                @endif

                                @for ($i = 1; $i < $data['sent']->last_page; $i++)
                                    <li class="page-item">
                                        <a href="{{$i}}" class="page-link">a</a>
                                    </li>
                                @endfor

                                @if ($data['sent']->next_page_url !== null)
                                    <li class="page-item">
                                        <a href="{{$data['sent']->next_page_url}}" class="page-link">Next</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <a href="#" class="page-link"></a>
                                    </li>
                                @endif
                            </ul>
                        </nav> --}}
                    @endif
                </div>
            </div>

            {{-- RECEIVED REQUESTS --}}
            <div class="card mb-3" style="background-color: transparent; border: 0px; border-radius:15px;">
                <div class="card-header --card-header-bg text-center --text-color-light" style="border-radius:15px 15px 0 0;">
                    Received requests
                </div>
                <div class="card-body card-body --card-body-bg --text-color-light --custom-card-body">
                    <table class="--received-request-tbl" id="received-reqs-tbl">
                        <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </thead>

                        <tbody>
                            @forelse ($data['received']->data as $received)
                            <tr>
                                <td>{{$received->name}}</td>
                                <td>{{$received->email}}</td>
                                @if ($received->accept === null)
                                <td>
                                    <span class="--confirm mr-2" onclick="event.preventDefault();document.getElementById('accept-{{$received->id}}').submit();">
                                        confirm
                                    </span>

                                    <span class="--decline" onclick="event.preventDefault(); document.getElementById('decline-{{$received->id}}').submit();">Decline</span>
                                </td>
                                @elseif($received->accept == true)
                                <td>
                                    <span class="--confirmed disabled mr-2">
                                        Confirmed
                                    </span>
                                    @if ($received->team_id !== Auth::user()->team_id)
                                        <span class="--decline" onclick="event.preventDefault(); document.getElementById('decline-{{$received->id}}').submit();">Decline</span>
                                    @endif
                                </td>
                                @elseif($received->accept == false)
                                <td>
                                    <span class="--confirm mr-2" onclick="event.preventDefault();document.getElementById('accept-{{$received->id}}').submit();">
                                        confirm
                                    </span>
        
                                    <span class="--declined disabled mr-2">
                                        declined
                                    </span>
                                </td>
                                @endif
                                <form action="{{route('connection.acceptrequest', $received->id)}}" method="post" id="accept-{{$received->id}}" class="d-none">
                                    @csrf
                                    @method('put')
                                </form>
    
                                <form action="{{route('connection.declinerequest', $received->id)}}" method="post" id="decline-{{$received->id}}" class="d-none">
                                    @csrf
                                    @method('put')
                                </form>
                            </tr>
                            @empty
                            <tr>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- TEAM MANAGEMENT --}}
            <div class="card mb-3" style="background-color: transparent; border: 0px; border-radius:15px;">
                <div class="card-header --card-header-bg text-center --text-color-light" style="border-radius:15px 15px 0 0;">
                    Team Management
                </div>

                <div class="card-body card-body --card-body-bg --text-color-light --custom-card-body">
                    <table id="sample" class="table">
                        <thead>
                            <th>ss</th>
                            <th>ss</th>
                            <th>ss</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ssss</td>
                                <td>ssss</td>
                                <td>ssss</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- OTHERS --}}
            <div class="card mb-3">
                <div class="card-header">Others</div>
                <div class="card-body">
                    <ul class="list-unstyled">

                        @if (Auth::user()->position_id == 1 && Auth::user()->team_id == null)
                            <li>
                                <a href="{{route('team.create')}}">Create a team</a>
                            </li>  
                        @endif

                        @isset($data['user']->team_id)
                        <li>
                            <a href="{{route('team.edit', Auth::user()->team_id)}}">Update team</a>
                        </li>
                        @endisset

                        @isset(Auth::user()->team_id)
                        <li>
                            <a href="#" data-toggle="modal" data-target="#team-delete-modal" class="text-danger">Delete current team</a>
                        </li>
                        @endisset
                    </ul>    
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Teams</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        @foreach ($data['teams'] as $team)
                        <li>
                            <a href="{{route('team.show', $team->id)}}">{{$team->team_name}}</a>
                            <small>Created at: {{$team->created_at}}</small>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Positions</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        @foreach ($data['positions'] as $position) 
                        <li>
                            <dl>
                                <dt>{{$position->position}}</dt>
                                <dd>{{$position->post_description}}</dd>
                            </dl>
                        </li>
                        @endforeach
                    </ul>
    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
