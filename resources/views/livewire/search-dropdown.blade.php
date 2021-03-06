<div class="mb-3">
    <h3 class="--heading-size-16">All Users</h3>
    {{-- SEARCH BAR --}}
    <div class="form-group">
        <input type="search" name="search" id="search" class="form-control --search-bar" wire:model="search" placeholder="Search">
    </div>

    {{-- SEARCH RESULTS --}}
    @forelse ($searchResults->data as $results)
        {{-- DISPLAY ALL RESULTS EXCEPT FOR CURRENT USER --}}
        @if ($results->user_id !== Auth::user()->id)
            <a href="{{route('users.show', $results->user_id)}}" class="--search-card-links">
                <div class="card mb-3 --search-card" >
                    <div class="card-body ">
                        <div class="media">
                            {{-- IMG --}}
                            <div class="--img --search-img" style="background-image: url('{{asset('/storage/avatars/'. $results->avatar)}}')"></div>

                            {{-- USER INFO --}}
                            <div class="media-body pl-3">
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
        {{-- IF THERE ARE NO OTHER RESULTS EXCEPT FOR CURRENT USER --}}
        @elseif($results->user_id == Auth::user()->id && $searchResults->total == 1)     
            <div class="card mb-3 --search-card">
                <div class="card-body ">
                    No other results
                </div>
            </div>   
        @endif

    {{-- IF THERE ARE NO SEARCH RESULTS --}}
    @empty 
        <div class="card mb-3 --search-card">
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
