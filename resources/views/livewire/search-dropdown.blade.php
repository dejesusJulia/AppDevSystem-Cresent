<div class="mb-3">
    <h2>All Users</h2>
    <div class="form-group">
        <input type="search" name="search" id="search" class="form-control --search-bar" wire:model="search" placeholder="Search">
    </div>
    @forelse ($searchResults->data as $results)
        <a href="{{route('users.show', $results->user_id)}}" class="--card-links-dark">
            <div class="card mb-3 --card-bg-light" >
                <div class="card-body ">
                    <div class="media">
                        <img src="{{asset('/storage/avatars/'. $results->avatar)}}" class="align-self-start mr-3 rounded-circle" alt="avatar" width="50px" height="50px" style="object-fit: contain">
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
    {{-- PAGINATION --}}
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @if ($searchResults->prev_page_url !== null)
            <li class="page-item ">
                <a class="page-link --bg-translucent-white" href="{{$searchResults->prev_page_url}}">Previous</a>
            </li>
            @else 
            <li class="page-item disabled ">
                <a class="page-link --bg-translucent-white" href="#" aria-disabled="true">Previous</a>
            </li>
            @endif
           
          @for ($i = 1; $i <= $searchResults->last_page; $i++)
            <li class="page-item">
                <a class="page-link --bg-translucent-white" href="http://127.0.0.1:8000/search/users?page={{$i}}">{{$i}}</a>
            </li>
          @endfor

            @if ($searchResults->next_page_url !== null)
            <li class="page-item">
                <a class="page-link --bg-translucent-white" href="{{$searchResults->next_page_url}}">Next</a>
            </li>
            @else 
            <li class="page-item disabled">
                <a class="page-link --bg-translucent-white" href="#" aria-disabled="true">Next</a>
            </li>
            @endif
        </ul>
    </nav>
</div>
