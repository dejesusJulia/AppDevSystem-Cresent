@extends('layouts.app')

@section('content')
{{-- EDIT/UPDATE MODAL --}}
@foreach ($subjects as $subject)
    <div class="modal fade" id="edit-{{$subject->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modify</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('subject.update', $subject->id)}}" method="post">
                        @csrf
                        @method('patch')
    
                        <div class="form-group">
                            <label for="subject-name">Subject</label>
                            <input type="text" name="subject_name" id="subject-name" class="form-control" value="{{$subject->subject_name}}"> 
                        </div>
    
                        <div class="form-group">
                            <label for="subject-description">Description</label>
                            <textarea name="subject_description" id="subject-description" cols="30" rows="5" class="form-control">{{$subject->subject_description}}</textarea>
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
@foreach ($subjects as $subject)
    <div class="modal fade" id="destroy-{{$subject->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>{{$subject->subject_name}}</h4>
                    <p>{{$subject->subject_description}}</p>
                    
                    Are you sure you want to delete this?
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger" onclick="event.preventDefault();document.getElementById('subject-destroy-{{$subject->id}}').submit();">Delete</button>
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
                    Subjects
                    <a href="{{route('dash')}}" class="btn btn-secondary">Back</a>
                </div>

                <div class="card-body">
                    <ul>
                        @foreach ($subjects as $subject)
                        <li>
                            <a href="#" data-toggle="modal" data-target="#edit-{{$subject->id}}">
                                {{$subject->subject_name}}
                            </a>

                            <a href="#" class="text-danger" data-toggle="modal" data-target="#destroy-{{$subject->id}}">Delete</a>

                            <form action="{{route('subject.destroy', $subject->id)}}" method="post" style="display: none;" id="subject-destroy-{{$subject->id}}">
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
                    Add new subject
                </div>
                <div class="card-body">
                    <form action="{{route('subject.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="subject-name">Subject</label>
                            <input type="text" name="subject_name" id="subject-name" class="form-control">
                        </div>
    
                        <div class="form-group">
                            <label for="subject_description">Description</label>
                            <textarea name="subject_description" id="subject_description" cols="30" rows="5" class="form-control"></textarea>
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
