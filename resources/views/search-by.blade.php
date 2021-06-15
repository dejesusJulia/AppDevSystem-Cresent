@extends('layouts.app')

@section('content')

{{-- MAIN CONTENT --}}
<div class="container">
    <div class="offset-2 row">
        {{-- POSITION --}}
        <div class="col-md-1">
            <a href="{{route('search.searchresults')}}">Search All</a>
        </div>
        <div class="col-md-2">
            <div class="dropdown mb-2">
                <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Position
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    @foreach ($data['positions'] as $position)
                        <a href="{{route('position.search', $position->id)}}" class="dropdown-item">
                            {{$position->position}}
                        </a>    
                    @endforeach
                </div>
            </div> 
        </div>

        {{-- SUBJECT --}}
        <div class="col-md-2">
            <div class="dropdown mb-2">
                <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Subjects/Fields
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    @foreach ($data['subjects'] as $sub)
                        <a href="{{route('subject.search', $sub->id)}}" class="dropdown-item">
                            {{$sub->subject_name}}
                        </a>  
                    @endforeach
                    <a href="{{route('home.nosubject')}}" class="dropdown-item">No subjects</a>
                </div>
            </div>
        </div>

        {{-- POSITION AND SUBJECT --}}
        <div class="col-md-5">
            <form action="{{route('search.both')}}" method="get">
                @csrf
                <div class="input-group">
                    <select name="position_id" id="position-id-select" class="custom-select">
                        <option selected disabled>Position</option>
                        @foreach ($data['positions'] as $post)
                            <option value="{{$post->id}}">{{$post->position}}</option>
                        @endforeach
                    </select>

                    <select name="subject_id" id="subject-id-select" class="custom-select">
                        <option selected disabled>Subject</option>
                        @foreach ($data['subjects'] as $s)
                            <option value="{{$s->id}}">{{$s->subject_name}}</option>
                        @endforeach 
                    </select>

                    <div class="input-group-append">
                        <input type="submit" value="Go" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Route::currentRouteName() == 'subject.search')
                @livewire('search-subject', ['subjectId' => $data['subjectID']])
            @elseif(Route::currentRouteName() == 'position.search')
                @livewire('search-position', ['positionId' => $data['positionID']])
            @elseif(Route::currentRouteName() == 'search.both')
                @livewire('search-ps', ['positionId' => $data['positionId'], 'subjectId' => $data['subjectId']])
            @elseif(Route::currentRouteName() == 'home.nosubject')
                @livewire('search-null')
            @endif
        </div>
    </div>
</div>

@endsection
