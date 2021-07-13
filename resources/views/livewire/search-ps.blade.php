<div class="mb-3">
    {{-- SEARCH BAR --}}
    <div class="form-group">
        <input type="search" name="nfps" id="nfps" class="form-control --search-bar" placeholder="Search" wire:model="nfps">
    </div>

    {{-- SEARCH RESULTS --}}
    @forelse ($nfpsResults->data as $result) 
    {{-- DISPLAY ALL RESULTS EXCEPT FOR CURRENT USER --}}
    @if ($result->user_id !== Auth::user()->id)
        <a href="{{route('users.show', $result->user_id)}}" class="--search-card-links">
            <div class="card mb-3 --search-card" >
                <div class="card-body">
                    <div class="media">
                        {{-- IMG --}}
                        <div class="--img --search-img" style="background-image: url('{{asset('/storage/avatars/'. $result->avatar)}}')"></div>
                        
                        {{-- USER INFO --}}
                        <div class="media-body pl-3">
                            <h5 class="mt-0">{{$result->name}}</h5>
                            <ul class="list-unstyled">
                                <li>{{$result->email}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </a>

    {{-- IF THERE ARE NO OTHER RESULTS EXCEPT FOR CURRENT USER --}}
    @elseif($result->user_id == Auth::user()->id && $nfpsResults->total == 1)
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
            No results
        </div>
    </div>
    @endforelse

    {{-- PAGINATION --}}
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @if ($nfpsResults->prev_page_url !== null)
            <li class="page-item">
                <a class="page-link --bg-translucent-white" href="{{$nfpsResults->prev_page_url}}">Previous</a>
            </li>
            @else 
            <li class="page-item disabled">
                <a class="page-link --bg-translucent-white" href="#" aria-disabled="true">Previous</a>
            </li>
            @endif
           
          @for ($i = 1; $i <= $nfpsResults->last_page; $i++)
            <li class="page-item">
                <a class="page-link --bg-translucent-white" href="{{Request::url().'?page=' . $i}}">{{$i}}</a>
            </li>
          @endfor

            @if ($nfpsResults->next_page_url !== null)
            <li class="page-item">
                <a class="page-link --bg-translucent-white" href="{{$nfpsResults->next_page_url}}">Next</a>
            </li>
            @else 
            <li class="page-item disabled">
                <a class="page-link --bg-translucent-white" href="#" aria-disabled="true">Next</a>
            </li>
            @endif
        </ul>
    </nav>
</div>
