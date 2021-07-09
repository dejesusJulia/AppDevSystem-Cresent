@extends('layouts.app')

@section('content')

{{-- MAIN CONTENT --}}
<div class="container">
    <div class="row">
        <div class="col-md-4 order-md-2 mb-2">

            <div class="accordion" id="search-by-accordion">
                {{-- POSITIONS --}}
                <div class="card" style="background-color: rgba(241, 241, 241, 0.578);">
                    <div class="card-header p-0" id="position-header">
                        <button class="btn --accordion-btn btn-block m-0" type="button" data-toggle="collapse" data-target="#position-collapse" aria-expanded="true" aria-controls="collapseOne" >Positions</button>
                    </div>

                    <div class="collapse" id="position-collapse" data-parent="#search-by-accordion">
                        <div class="card-body">
                            <div class="list-group list-group-flush" >
                                @foreach ($data['positions'] as $position)
                                <a href="{{route('position.search', $position->id)}}" class="list-group-item --card-links-dark"  style="background-color: transparent;">
                                    {{$position->position}}
                                </a>    
                                @endforeach   
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SUBJECTS --}}
                <div class="card" style="background-color: rgba(241, 241, 241, 0.578);">
                    <div class="card-header p-0" id="subject-header" style="background-color: rgba(241, 241, 241, 0.578);">
                        <button class="btn --accordion-btn btn-block m-0" type="button" data-toggle="collapse" data-target="#subject-collapse" aria-expanded="true" aria-controls="collapseOne">Subjects</button>
                    </div>

                    <div class="collapse" id="subject-collapse" data-parent="#search-by-accordion">
                        <div class="card-body">
                            <div class="list-group list-group-flush" >
                                @foreach ($data['subjects'] as $sub)
                                <a href="{{route('subject.search', $sub->id)}}" class="list-group-item --card-links-dark"  style="background-color: transparent;">
                                    {{$sub->subject_name}}
                                </a>  
                                @endforeach
                                <a href="{{route('home.nosubject')}}" class="list-group-item --card-links-dark"  style="background-color: transparent;">No subjects</a> 
                            </div>
                        </div>
                    </div>
                </div>

                {{-- POSITION AND SUBJECT --}}
                <div class="card" style="background-color: rgba(241, 241, 241, 0.578);">
                    <div class="card-header p-0" id="ps-header">
                        <button class="btn --accordion-btn btn-block m-0" type="button" data-toggle="collapse" data-target="#ps-collapse" aria-expanded="true" aria-controls="collapseOne">Subjects and Positions</button>
                    </div>

                    <div class="collapse" id="ps-collapse" data-parent="#search-by-accordion">
                        <div class="card-body" >
                            <form action="{{route('search.both')}}" method="get">
                                @csrf
                                <div class="form-group">
                                    <select name="position_id" id="position-id-select" class="custom-select">
                                        <option selected disabled>Position</option>
                                        @foreach ($data['positions'] as $post)
                                            <option value="{{$post->id}}">{{$post->position}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select name="subject_id" id="subject-id-select" class="custom-select">
                                        <option selected disabled>Subject</option>
                                        @foreach ($data['subjects'] as $s)
                                            <option value="{{$s->id}}">{{$s->subject_name}}</option>
                                        @endforeach 
                                    </select>
                                </div>
                                <input type="submit" value="Go" class="btn --goldenrod-bg --btn-goldenrod">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MAIN CONTENT --}}
        <div class="col-md-8 order-md-1">
            <h4>
                <a href="{{route('search.searchresults')}}" class="--card-links-dark">Search all</a>
            </h4>
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
