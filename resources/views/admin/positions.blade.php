@extends('layouts.app')

@section('content')
{{-- EDIT/UPDATE MODAL --}}
@foreach ($positions as $position)
    <div class="modal fade" id="edit-{{$position->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modify</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('position.update', $position->id)}}" method="post">
                        @csrf
                        @method('patch')
    
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" name="position" id="position" class="form-control" value="{{$position->position}}"> 
                        </div>
    
                        <div class="form-group">
                            <label for="post-description">Description</label>
                            <textarea name="post_description" id="post-description" cols="30" rows="5" class="form-control">{{$position->post_description}}</textarea>
                        </div>
    
                        <div class="form-group">
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- DELETE MODAL --}}
@foreach ($positions as $position)
    <div class="modal fade" id="destroy-{{$position->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>{{$position->position}}</h4>
                    <p>{{$position->post_description}}</p>
                    
                    Are you sure you want to delete this?
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger" onclick="event.preventDefault();document.getElementById('position-destroy-{{$position->id}}').submit();">Delete</button>
                    <button class="btn btn-secondary" data-dismiss="modal" onclick="event.preventDefault()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- MAIN CONTENT --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    Positions
                    <a href="{{route('dash')}}" class="btn btn-secondary">Back</a>
                </div>

                <div class="card-body">
                    <ul>
                        @foreach ($positions as $position)
                        <li>
                            <a href="#" data-toggle="modal" data-target="#edit-{{$position->id}}">
                                {{$position->position}}
                            </a>

                            <a href="#" class="text-danger" data-toggle="modal" data-target="#destroy-{{$position->id}}">Delete</a>

                            <form action="{{route('position.destroy', $position->id)}}" method="post" style="display: none;" id="position-destroy-{{$position->id}}">
                                @csrf
                                @method('delete')
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    Add new Position
                </div>
                <div class="card-body">
                    <form action="{{route('position.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" name="position" id="position" class="form-control">
                        </div>
    
                        <div class="form-group">
                            <label for="post-description">Description</label>
                            <textarea name="post_description" id="post-description" cols="30" rows="5" class="form-control"></textarea>
                        </div>
    
                        <div class="form-group">
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>   
            </div>
        </div>
    </div>
</div>
@endsection
