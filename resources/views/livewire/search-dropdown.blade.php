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

    @forelse ($searchResults->data as $results)
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
        {{Request::url()}}
    {{-- PAGINATION --}}
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @if ($searchResults->prev_page_url !== null)
            <li class="page-item">
                <a class="page-link" href="{{$searchResults->prev_page_url}}">Previous</a>
            </li>
            @else 
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-disabled="true">Previous</a>
            </li>
            @endif
           
          @for ($i = 1; $i <= $searchResults->last_page; $i++)
            <li class="page-item">
                <a class="page-link" href="http://127.0.0.1:8000/search/users?page={{$i}}">{{$i}}</a>
            </li>
          @endfor

            @if ($searchResults->next_page_url !== null)
            <li class="page-item">
                <a class="page-link" href="{{$searchResults->next_page_url}}">Next</a>
            </li>
            @else 
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-disabled="true">Next</a>
            </li>
            @endif
        </ul>
    </nav>
</div>
