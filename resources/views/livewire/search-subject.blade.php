<div class="mb-3">
    <div class="form-group">
        <input type="search" name="nfs" id="nfs" class="form-control --search-bar" placeholder="Search" wire:model="nfs">
    </div>

    @forelse ($nfsResults->data as $result) 
    <a href="{{route('users.show', $result->user_id)}}" class="--card-links-dark">
        <div class="card mb-3 --card-bg-light" >
            <div class="card-body">
                <div class="media">
                    <img src="{{asset('/storage/avatars/'. $result->avatar)}}" alt="avatar" class="align-self-start mr-3 rounded-circle" width="50px" height="50px" style="object-fit: contain">
                    <div class="media-body">
                        <h5 class="mt-0">{{$result->name}}</h5>
                        <ul class="list-unstyled">
                            <li>{{$result->email}}</li>
                            <li>{{$result->position}}</li>
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

    {{-- PAGINATION --}}
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @if ($nfsResults->prev_page_url !== null)
            <li class="page-item">
                <a class="page-link --bg-translucent-white" href="{{$nfsResults->prev_page_url}}">Previous</a>
            </li>
            @else 
            <li class="page-item disabled">
                <a class="page-link --bg-translucent-white" href="#" aria-disabled="true">Previous</a>
            </li>
            @endif
           
          @for ($i = 1; $i <= $nfsResults->last_page; $i++)
            <li class="page-item">
                <a class="page-link --bg-translucent-white" href="{{Request::url().'?page=' . $i}}">{{$i}}</a>
            </li>
          @endfor

            @if ($nfsResults->next_page_url !== null)
            <li class="page-item">
                <a class="page-link --bg-translucent-white" href="{{$nfsResults->next_page_url}}">Next</a>
            </li>
            @else 
            <li class="page-item disabled">
                <a class="page-link --bg-translucent-white" href="#" aria-disabled="true">Next</a>
            </li>
            @endif
        </ul>
    </nav>
</div>
