@extends('layouts.admin')

@section('content')
    {{-- DELETE MODAL --}}
     @foreach ($users as $u)
      @if ($u->id !== Auth::user()->id)
      <div class="modal fade" id="user-destroy-{{$u->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">User delete</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete {{$u->name}} ({{$u->email}})?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="event.preventDefault()">Cancel</button>
              <button type="button" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('destroy-user-{{$u->id}}').submit();">Delete</button>
            </div>
          </div>
        </div>
      </div>
      @endif 
      @endforeach 

      {{-- MAIN CONTENT --}}
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <x-alert></x-alert>
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Users</h4>
                  <p class="card-category">List of all registered users</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table text-center" id="user-list">
                      <thead class=" text-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        @foreach ($users as $user)
                        @if ($user->id !== Auth::user()->id)
                        <tr>
                          <td scope="row">
                            {{$user->id}}
                          </td>
                          <td>
                            {{$user->name}}
                          </td>
                          <td>
                            {{$user->email}}
                          </td>
                          <td>
                            <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm" data-toggle="modal" data-target="#user-destroy-{{$user->id}}">
                              <i class="material-icons">close</i>
                            </button>

                            <form action="{{route('users.destroy', $user->id)}}" method="post" style="display: none;" id="destroy-user-{{$user->id}}">
                              @csrf
                              @method('delete')
                            </form>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div> 
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
