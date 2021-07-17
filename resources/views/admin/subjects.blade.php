@extends('layouts.admin')

@section('content')
<!-- EDIT MODAL -->
      @foreach($subjects as $subject)
      <div class="modal fade" id="edit-{{$subject->id}}" tabindex="-1" role="dialog" aria-labelledby="edit-{{$subject->id}}-Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="edit-{{$subject->id}}-Label">Edit subject</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{route('subject.update', $subject->id)}}" method="post" class="form">
                @csrf
                @method('patch')

                <div class="form-group">
                  <label for="subject-name">Subject name<span class="text-danger">*</span></label>
                  <input type="text" name="subject_name" id="subject-name" class="form-control" value="{{$subject->subject_name}}">
                  @error('subject_name')
                    <small class="text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="subject-description">Description<span class="text-danger">*</span></label>
                  <textarea name="subject_description" id="subject-description" cols="10" rows="5" class="form-control">{{$subject->subject_description}}</textarea>
                  @error('subject_description')
                    <small class="text-danger">{{$message}}</small>
                  @enderror
                </div>
                <input type="submit" value="Update" class="btn btn-primary btn-block">
              </form>              
            </div>
          </div>
        </div>
      </div>
      @endforeach

      <!-- DELETE MODAL -->
      @foreach($subjects as $subject)
      <div class="modal fade" id="destroy-{{$subject->id}}" tabindex="-1" role="dialog" aria-labelledby="destroy-{{$subject->id}}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="destroy-{{$subject->id}}Label">Delete subject</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want delete {{$subject->subject_name}}?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="event.preventDefault()">Cancel</button>
              <button type="button" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('subject-destroy-{{$subject->id}}').submit();">Delete</button>
            </div>
          </div>
        </div>
      </div>
      @endforeach

      <!-- MAIN CONTENT -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
                <x-alert></x-alert>
              <div class="card">
                <div class="card-header card-header-success">
                  <h4 class="card-title ">Subjects</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table text-center" id="subject-list">
                      <thead class=" text-primary">
                        <th>ID</th> 
                        <th>Name</th>  
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        @foreach ($subjects as $subject)
                        <tr>
                          <td>
                            {{$subject->id}}
                          </td>
                          <td>
                            {{$subject->subject_name}}
                          </td>
                          <td>
                            {{$subject->created_at ?? '---'}}
                          </td>
                          <td>
                            {{$subject->updated_at ?? '---'}}
                          </td>
                          <td class="td-action">
                            <button type="button" rel="tooltip" title="Edit subject" class="btn btn-primary btn-link btn-sm" data-toggle="modal" data-target="#edit-{{$subject->id}}">
                              <i class="material-icons">edit</i>
                            </button>

                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm" data-toggle="modal" data-target="#destroy-{{$subject->id}}">
                              <i class="material-icons">close</i>
                            </button>

                            <form action="{{route('subject.destroy', $subject->id)}}" method="post" style="display: none;" id="subject-destroy-{{$subject->id}}">
                              @csrf
                              @method('delete')
                            </form>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            {{-- ASIDE SECTION --}}
            <div class="col-md-4">
              {{-- ADD NEW SUBJECT --}}
              <div class="card">
                <div class="card-header card-header-primary">
                  <div class="d-flex justify-content-between">
                    <i class="material-icons">add_circle</i>
                    <h4 class="card-title ">New Subject</h4>
                  </div>
                </div>

                <div class="card-body">
                  <form action="{{route('subject.store')}}" method="post" class="form">
                    @csrf
                    <div class="form-group">
                      <label for="subject-name">Subject<span class="text-danger">*</span></label>
                      <input type="text" name="subject_name" id="subject-name" class="form-control">
                      @error('subject_name')
                        <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="subject_description">Description<span class="text-danger">*</span></label>
                      <textarea name="subject_description" id="subject_description" cols="10" rows="5" class="form-control"></textarea>
                      @error('subject_description')
                        <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>

                    <input type="submit" value="Create subject" class="btn btn-primary btn-block">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
