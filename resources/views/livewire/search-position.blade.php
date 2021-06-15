<div class="mb-3">
    <div class="form-group">
        <div class="input-group">
            <input type="search" name="nfp" id="nfp" class="form-control" placeholder="Search" wire:model="nfp">
            <div class="input-group-append">
                <label for="nfp" class="input-group-text">Search</label>
            </div>
        </div>
    </div>

    @forelse ($nfpResults as $result) 
    <a href="{{route('users.show', $result->user_id)}}" class="text-decoration-none">
        <div class="card mb-3">
            <div class="card-body">
                <div class="media">
                    <img src="{{asset('/storage/avatars/'. $result->avatar)}}" alt="avatar" class="align-self-start mr-3" width="50px" height="50px">
                    <div class="media-body">
                        <h5 class="mt-0">{{$result->name}}</h5>
                        <ul class="list-unstyled">
                            <li>{{$result->email}}</li>
                            <li>{{$result->subject_name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </a>
    @empty 
    <div class="card mb-3">
        <div class="card-body">
            No results
        </div>
    </div>
    @endforelse

</div>