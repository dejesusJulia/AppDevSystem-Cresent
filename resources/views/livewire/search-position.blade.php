<div class="mb-3">
    <div class="form-group">
        <div class="input-group">
            <input type="search" name="nfp" id="nfp" class="form-control" placeholder="Search" wire:model="nfp">
            <div class="input-group-append">
                <label for="nfp" class="input-group-text">Search</label>
            </div>
        </div>
    </div>

    @forelse ($nfpResults->data as $result) 
    <a href="{{route('users.show', $result->user_id)}}" class="--card-links">
        <div class="card mb-3 --bg-translucent p-4">
            <div class="card-body --card-body-bg">
                <div class="media">
                    <img src="{{asset('/storage/avatars/'. $result->avatar)}}" alt="avatar" class="align-self-start mr-3" width="50px" height="50px" style="object-fit: contain">
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

    {{-- PAGINATION --}}
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @if ($nfpResults->prev_page_url !== null)
            <li class="page-item">
                <a class="page-link --bg-translucent-white" href="{{$nfpResults->prev_page_url}}">Previous</a>
            </li>
            @else 
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-disabled="true">Previous</a>
            </li>
            @endif
           
          @for ($i = 1; $i <= $nfpResults->last_page; $i++)
            <li class="page-item">
                <a class="page-link --bg-translucent-white" href="{{Request::url().'?page=' . $i}}">{{$i}}</a>
            </li>
          @endfor

            @if ($nfpResults->next_page_url !== null)
            <li class="page-item">
                <a class="page-link --bg-translucent-white" href="{{$nfpResults->next_page_url}}">Next</a>
            </li>
            @else 
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-disabled="true">Next</a>
            </li>
            @endif
        </ul>
    </nav>
</div>
