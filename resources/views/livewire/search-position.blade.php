<div class="mb-3">
    {{-- SEARCH BAR --}}
    <div class="form-group">
        <input type="search" name="nfp" id="nfp" class="form-control --search-bar" placeholder="Search" wire:model="nfp">
    </div>

    {{-- SEARCH RESULTS --}}
    @forelse ($nfpResults->data as $result) 
    @if ($result->user_id !== Auth::user()->id)
        <a href="{{route('users.show', $result->user_id)}}" class="--search-card-links">
            <div class="card mb-3 --search-card" >
                <div class="card-body">
                    <div class="media">
                        <img src="{{asset('/storage/avatars/'. $result->avatar)}}" alt="avatar" class="align-self-start mr-3 rounded-circle" width="50px" height="50px" style="object-fit: contain">
                        <div class="media-body">
                            <h5 class="mt-0">{{$result->name}}</h5>
                            <ul class="list-unstyled">
                                <li>{{$result->email}}</li>

                                {{-- IF SUBJECT IS IN SELECTION AND NO OTHER DESCRIPTION --}}
                                @if (!in_array(null, $result->subject_name) && in_array(null, $result->others))
                                <li>
                                    @for ($i = 0; $i < count($result->subject_name); $i++)
                                        {{$result->subject_name[$i]}}

                                        @if ($i !== count($result->subject_name)-1)
                                            ,
                                        @endif
                                    @endfor
                                </li>

                                {{-- IF SUBJECT IS NOT IN SELECTION AND SPECIFIED BY USER --}}
                                @elseif(in_array(null, $result->subject_name) && $result->others !== null) 
                                <li>
                                    @for ($j = 0; $j < count($result->others); $j++)
                                    {{$result->others[$j]}}

                                        @if ($j !== count($result->others)-1)
                                            ,
                                        @endif
                                    @endfor
                                </li>

                                {{-- IF SUBJECT IS IN SELECTION AND DESCRIBED --}}
                                @elseif(!in_array(null, $result->subject_name) && !in_array(null, $result->others))
                                <li>
                                    @for ($k = 0; $k < count($result->others); $k++)
                                    {{$result->subject_name[$k]}} ({{$result->others[$k]}})

                                        @if ($k !== count($result->others) - 1)
                                            ,
                                        @endif
                                    @endfor
                                </li>
                                @endif 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endif
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
            @if ($nfpResults->prev_page_url !== null)
            <li class="page-item">
                <a class="page-link --bg-translucent-white" href="{{$nfpResults->prev_page_url}}">Previous</a>
            </li>
            @else 
            <li class="page-item disabled">
                <a class="page-link" href="#" aria-disabled="true">Previous</a>
            </li>
            @endif
           
          @for ($l = 1; $l <= $nfpResults->last_page; $l++)
            <li class="page-item">
                <a class="page-link --bg-translucent-white" href="{{Request::url().'?page=' . $l}}">{{$l}}</a>
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
