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
                            <select name="subject_id" id="subject-name" class="custom-select" onchange="showSubjectDescription()">
                                <option selected disabled>Choose one</option>

                                @foreach ($data['subjects'] as $subject)
                                <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                                @endforeach
                            </select>

                            @foreach ($data['subjects'] as $subj)
                            <div class="text-muted mb-2 --subject-descriptions"  id="subject-desc-{{$subj->id}}" style="display: none" data-number="{{$subj->id}}">
                                {{$subj->subject_description}}
                            </div>
                            @endforeach

                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="others">Describe field here</label>
                        <input type="text" name="others" id="others" class="form-control" placeholder="Describe your field here if its not included above">
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-block --btn-custom">
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
                    @if ($category->subject_id == null || isset($category->others))
                        <p>Are you sure you want to delete <em>{{$category->others}}</em> in your field?</p>
                    @else
                        <p>Are you sure you want to delete in <em>{{$category->subject_name}}</em> your field</p>
                    @endif
                </div>

                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block --modal-btn-danger" onclick="event.preventDefault(); document.getElementById('category-destroy-form-{{$category->id}}').submit()">Delete</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" onclick="event.preventDefault()">Cancel</button>
                        </div>
                    </div>
                    
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
                    <div class="row w-100">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-block --modal-btn-danger" onclick="event.preventDefault(); document.getElementById('connection-destroy-form-{{$sents->id}}').submit()">Delete</button>
                        </div>

                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" onclick="event.preventDefault()">Cancel</button>
                        </div>
                    </div>                    
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
                Are you sure you want to delete your team <em>{{$data['user']->team_name}}</em>? 
            </div>

            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-block --modal-btn-danger" onclick="event.preventDefault(); document.getElementById('delete-team-form-{{Auth::user()->team_id}}').submit()">Delete</button>

                        <form action="{{route('team.destroy',Auth::user()->team_id)}}" method="post" class="d-none" id="delete-team-form-{{Auth::user()->team_id}}">
                            @csrf
                            @method('delete')
                        </form>
                    </div>

                    <div class="col-md-6">
                        <button class="btn btn-block btn-secondary" onclick="event.preventDefault()" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
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
                <div class="card-header --goldenrod-bg --text-color-light text-center" style="border-radius:15px 15px 0 0;">User Information</div>

                <div class="card-body --custom-card-body --dark-lava-bg --text-color-papaya-whip">
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

                        @if(isset($data['user']->team_name))
                        <div class="col-12 d-flex justify-content-between --details">
                            <div class="--icons">
                                <i class="fas fa-users"></i>
                            </div>

                            <div class="--info">{{$data['user']->team_name}}</div>
                        </div>
                        @else 
                        <div class="col-12 d-flex justify-content-between --details">
                            <div class="--icons">
                                <i class="fas fa-users"></i>
                            </div>

                            <div class="--info">---</div>
                        </div>
                        @endif
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
                                        <a href="#" data-target="#category-destroy-modal-{{$category->id}}" data-toggle="modal" class="--delete">Delete</a>

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
                <div class="card-header --goldenrod-bg text-center --text-color-light" style="border-radius:15px 15px 0 0;">
                    <h3 class="mb-0">User Dashboard</h3>
                </div>

                <div class="card-body --dark-lava-bg --text-color-light --custom-card-body">
                    <div class="d-flex justify-content-around --dashboard">
                        <h5>Welcome to Cresent!</h5>
                        <a href="{{route('search.searchresults')}}" class="--search-link">Search Users</a>
                    </div>

                    
                </div>
            </div>

            {{-- SENT REQUESTS --}}
            <div class="card mb-3" style="background-color: transparent; border: 0px; border-radius:15px;">
                <div class="card-header --goldenrod-bg text-center --text-color-light" style="border-radius:15px 15px 0 0;">
                    Sent requests
                </div>
                <div class="card-body --dark-lava-bg --text-color-light --custom-card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless text-center" id="sent-reqs-tbl">
                            <thead>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </thead>

                            <tbody>
                                @forelse ($data['sent']->data as $sent)
                                <tr>
                                    <td>{{$sent->name}}</td>
                                    <td>{{$sent->email}}</td>

                                    @if ($sent->accept === 1)
                                    <td>Accepted</td>
                                    <td>-</td>
                                    @elseif($sent->accept === 0)
                                    <td>Declined</td>
                                    <td>-</td>
                                    @elseif($sent->accept === null)
                                    <td>Not viewed Yet</td>
                                    <td scope="row">
                                        <a href="#" data-target="#sent-destroy-modal-{{$sent->id}}" data-toggle="modal" class="--tbl-danger-link">
                                            <i class="fas fa-times"></i>
                                            
                                        </a>
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
                        <div class="mt-3 w-100 h-100 d-flex justify-content-center">
                            <nav>
                                <ul class="pagination pagination-sm">
                                    @if ($data['sent']->prev_page_url !== null)
                                        <li class="page-item">
                                            <a href="{{$data['sent']->prev_page_url}}" class="page-link --tbl-pagination-links">&laquo;</a>
                                        </li>
                                    @else 
                                    <li class="page-item ">
                                        <a href="#" class="page-link --tbl-pagination-disable">&laquo;</a>
                                    </li>
                                    @endif

                                    @for ($i = 1; $i <= $data['sent']->last_page; $i++)
                                        <li class="page-item">
                                            <a href="{{$data['sent']->path . '?get-sent='.$i}}" class="page-link --tbl-pagination-links @if($data['sent']->path.'?get-sent='.$data['sent']->current_page == $data['sent']->path . '?get-sent='.$i) --tbl-pagination-active @endif">{{$i}}</a>
                                        </li>
                                    @endfor

                                    @if ($data['sent']->next_page_url !== null)
                                        <li class="page-item">
                                            <a href="{{$data['sent']->next_page_url}}" class="page-link --tbl-pagination-links">&raquo;</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a href="#" class="page-link --tbl-pagination-disable">&raquo;</a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>

            {{-- RECEIVED REQUESTS --}}
            <div class="card mb-3" style="background-color: transparent; border: 0px; border-radius:15px;">
                <div class="card-header --goldenrod-bg text-center --text-color-light" style="border-radius:15px 15px 0 0;">
                    Received requests
                </div>
                <div class="card-body card-body --dark-lava-bg --text-color-light --custom-card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless text-center" id="received-reqs-tbl">
                            <thead>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Actions</th>
                            </thead>
    
                            <tbody>
                                @forelse ($data['received']->data as $received)
                                <tr>
                                    <td>{{$received->name}}</td>
                                    <td>{{$received->email}}</td>
                                    @if ($received->accept === null)
                                    <td scope="row">
                                        <span class="--tbl-success-link mr-2" style="cursor: pointer;" onclick="event.preventDefault();document.getElementById('accept-{{$received->id}}').submit();">
                                            <i class="fas fa-check"></i>
                                        </span>
    
                                        <span class="--tbl-danger-link" style="cursor: pointer;" onclick="event.preventDefault(); document.getElementById('decline-{{$received->id}}').submit();">
                                            <i class="fas fa-times"></i>
                                        </span>
                                    </td>
                                    @elseif($received->accept == true)
                                    <td>
                                        <span class="--disable disabled mr-2">
                                            <i class="fas fa-check-circle"></i>
                                        </span>
                                        @if ($received->team_id !== Auth::user()->team_id || ($received->team_id == null && Auth::user()->team_id==null))
                                            <span class="--tbl-danger-link" style="cursor: pointer;" onclick="event.preventDefault(); document.getElementById('decline-{{$received->id}}').submit();">
                                                <i class="fas fa-times"></i>
                                            </span>
                                        @endif
                                    </td>
                                    @elseif($received->accept == false)
                                    <td>
                                        <span class="--tbl-success-link mr-2" style="cursor: pointer;" onclick="event.preventDefault();document.getElementById('accept-{{$received->id}}').submit();">
                                            <i class="fas fa-check"></i>
                                        </span>
            
                                        <span class="--disable disabled mr-2">
                                            <i class="fas fa-times-circle"></i>
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
                
                    @if ($data['received']->data !== null)
                        <div class="mt-3 w-100 h-100 d-flex justify-content-center">
                            <nav>
                                <ul class="pagination pagination-sm">
                                    @if ($data['received']->prev_page_url !== null)
                                        <li class="page-item">
                                            <a href="{{$data['received']->prev_page_url}}" class="page-link --tbl-pagination-links">&laquo;</a>
                                        </li>
                                    @else 
                                    <li class="page-item">
                                        <a href="#" class="page-link --tbl-pagination-disable">&laquo;</a>
                                    </li>
                                    @endif

                                    @for ($j = 1; $j <= $data['received']->last_page; $j++)
                                        <li class="page-item">
                                            <a href="{{$data['received']->path . '?get-received='.$j}}" class="page-link --tbl-pagination-links @if($data['received']->path.'?get-received='.$data['received']->current_page == $data['received']->path . '?get-received='.$j) --tbl-pagination-active @endif">{{$j}}</a>
                                        </li>
                                    @endfor

                                    @if ($data['received']->next_page_url !== null)
                                        <li class="page-item">
                                            <a href="{{$data['received']->next_page_url}}" class="page-link --tbl-pagination-links">&raquo;</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a href="#" class="page-link --tbl-pagination-disable">&raquo;</a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>

            {{-- TEAM MANAGEMENT --}}
            <div class="card mb-3" style="background-color: transparent; border: 0px; border-radius:15px;">
                <div class="card-header --goldenrod-bg text-center --text-color-light" style="border-radius:15px 15px 0 0;">
                    Team Management
                </div>

                <div class="card-body card-body --dark-lava-bg --text-color-light --custom-card-body">
                    <div class="row">
                        @if (Auth::user()->position_id == 1 && Auth::user()->team_id == null)
                        <div class="col-md-12">
                            <a href="{{route('team.create')}}" class="btn btn-block --a-btn-custom">Create team</a>
                        </div>
                        @endif

                        @if(isset($data['user']->team_id) || isset(Auth::user()->team_id))
                        <div class="col-md-6">
                            <a href="{{route('team.edit', Auth::user()->team_id)}}" class="btn btn-block --a-btn-custom-sm" id="custom-update-btn">Update team info</a>
                        </div>

                        <div class="col-md-6">
                            <a href="#" data-toggle="modal" data-target="#team-delete-modal" class="btn btn-block --a-btn-custom-sm" id="custom-delete-btn">Delete team</a>
                        </div>
                        @endif

                    </div>
                    <hr class="mt-3 --separator">
                    <div class="list-group list-group-flush" style="border-radius: 15px">
                        @foreach ($data['teams'] as $team)
                        <a href="{{route('team.show', $team->id)}}" class="list-group-item list-group-item-action --links-list">
                            {{$team->team_name}}
                            <div>
                                <small>
                                    {{$team->created_at}}
                                </small>
                            </div>
                        </a>
                        @endforeach

                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
