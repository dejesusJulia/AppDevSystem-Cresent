<div class="mb-3">
    <div class="form-group">
        <div class="input-group">
            <input type="search" name="search" id="search" class="form-control" wire:model="search" placeholder="Search">
            <div class="input-group-append">
                <label for="search" class="input-group-text">Search</label>
            </div>
        </div>
    </div>



    @forelse (json_decode($searchResults) as $results)
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-2">
                        <img src="{{asset('/storage/avatars/'. $results->avatar)}}" alt="avatar" class="rounded-circle" width="50px" height="50px">
                    </div>
                    <div class="col-sm-10">
                        <dl>
                            <dt>{{$results->name}}</dt>
                            <dd>{{$results->email}}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>            
    @empty 
        <div class="card mb-3">
            <div class="card-body">
                <p>No results</p>
            </div>
        </div>
    @endforelse
   
    
    
</div>
