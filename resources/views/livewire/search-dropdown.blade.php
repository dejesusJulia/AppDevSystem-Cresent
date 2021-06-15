<div class="mb-3">
    <div class="form-group">
        <div class="input-group">
            <input type="search" name="search" id="search" class="form-control" wire:model="search" placeholder="Search">
            <div class="input-group-append">
                <label for="search" class="input-group-text">Search</label>
            </div>
        </div>
    </div>
    <h5>All users</h5>

    @forelse ($searchResults as $results)
        <a href="{{route('users.show', $results->user_id)}}" class="text-decoration-none">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="media">
                        <img src="{{asset('/storage/avatars/'. $results->avatar)}}" class="align-self-start mr-3" alt="avatar" width="50px" height="50px">
                        <div class="media-body">
                          <h5 class="mt-0">{{$results->name}}</h5>
                          <ul class="list-unstyled">
                            <li>{{$results->email}}</li>
                            <li>{{$results->position}}</li>
                          </ul>
                        </div>
                    </div>
                </div>
            </div> 
        </a>             
    @empty 
        <div class="card mb-3">
            <div class="card-body">
                <p>No results</p>
            </div>
        </div>
    @endforelse
</div>
