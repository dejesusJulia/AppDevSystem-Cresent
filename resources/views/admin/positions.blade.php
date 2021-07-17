@extends('layouts.admin')

@section('content')
    <!-- EDIT MODAL -->
      @foreach($positions as $position)
      <div class="modal fade" id="edit-{{$position->id}}" tabindex="-1" role="dialog" aria-labelledby="edit-{{$position->id}}-Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="edit-{{$position->id}}-Label">Edit position</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{route('position.update', $position->id)}}" method="post" class="form">
                @csrf
                @method('patch')

                <div class="form-group">
                  <label for="position">Position <span class="text-danger">*</span></label>
                  <input type="text" name="position" id="position" class="form-control" value="{{$position->position}}">
                  @error('position')
                    <small class="text-danger">{{$message}}</small>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="post-description">Description <span class="text-danger">*</span></label>
                  <textarea name="post_description" id="post-description" cols="10" rows="5" class="form-control">{{$position->post_description}}</textarea>
                  @error('post-description')
                    <small class="text-danger">{{$message}}</small>
                  @enderror
                </div>

                <input type="submit" value="Update" class="btn btn-primary btn-block" >
              </form>
            </div>
          </div>
        </div>
      </div>
      @endforeach

      <!-- DELETE MODAL -->
      @foreach($positions as $position)
      <div class="modal fade" id="destroy-{{$position->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete subject</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want delete {{$position->position}}?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('position-destroy-{{$position->id}}').submit();">Delete</button>
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
                <div class="card-header card-header-danger">
                  <h4 class="card-title ">Positions</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table text-center" id="position-list">
                      <thead class=" text-danger">
                        <th>ID</th>   
                        <th>Position</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        @foreach ($positions as $position)
                        <tr>
                          <td>
                            {{$position->id}}
                          </td>
                          <td>
                            {{$position->position}}
                          </td>
                          <td>
                            {{$position->created_at ?? '---'}}
                          </td>
                          <td>
                            {{$position->updated_at ?? '---'}}
                          </td>
                          <td class="td-action">
                            <button type="button" rel="tooltip" title="Edit position" class="btn btn-primary btn-link btn-sm" data-toggle="modal" data-target="#edit-{{$position->id}}">
                              <i class="material-icons">edit</i>
                            </button>

                            @if ($position->id !== 1 && $position->id !== 9) 
                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm" data-toggle="modal" data-target="#destroy-{{$position->id}}">
                                <i class="material-icons">close</i>
                              </button>

                              <form action="{{route('position.destroy', $position->id)}}" method="post" style="display: none;" id="position-destroy-{{$position->id}}">
                                @csrf
                                @method('delete')
                              </form>
                            @endif
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
                    <h4 class="card-title ">New Position /h4>
                  </div>
                </div>

                <div class="card-body">
                  <form action="{{route('position.store')}}" method="post" class="form">
                    @csrf
                    <div class="form-group">
                      <label for="position">Position <span class="text-danger">*</span></label>
                      <input type="text" name="position" id="position" class="form-control">
                      @error('position')
                        <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="post-description">Description <span class="text-danger">*</span></label>
                      <textarea name="post_description" id="post-description" cols="10" rows="5" class="form-control"></textarea>
                      @error('post-description')
                        <small class="text-danger">{{$message}}</small>
                      @enderror
                    </div>

                    <input type="submit" value="Create position" class="btn btn-primary btn-block">
                  </form>
                </div>
              </div>

              {{-- TIPS --}}
              <div class="card">
                <div class="card-header card-header-info">
                  <div class="d-flex justify-content-between">
                    <i class="material-icons">info</i>
                    <h4 class="card-title">Tips</h4>
                  </div>
                </div>

                <div class="card-body">
                  <ul>
                    <li>The first position should always be the head/leader of the team</li>
                    <li>If a deleted position has users using the title, they will be transferred to the <em>others</em></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
