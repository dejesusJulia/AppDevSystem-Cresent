@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-2">
                <h3 class="--heading-size-16">Search By</h3>
                <div class="accordion" id="search-by-accordion">
                    {{-- POSITIONS --}}
                    <div class="card p-0 --card-body-bg">
                        <div class="card-header --card-header-bg --text-color-dark p-0" id="position-header">
                            <button class="btn btn-block m-0" type="button" data-toggle="collapse" data-target="#position-collapse" aria-expanded="true" aria-controls="collapseOne"  >Positions</button>
                        </div>

                        <div class="collapse" id="position-collapse" data-parent="#search-by-accordion">
                            <div class="card-body --card-body-bg">
                                <div class="list-group list-group-flush" >
                                    @foreach ($data['positions'] as $position)
                                    <a href="{{route('position.search', $position->id)}}" class="list-group-item list-group-item-action --links-list">
                                        {{$position->position}}
                                    </a>    
                                    @endforeach   
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SUBJECTS --}}
                    <div class="card p-0 --card-body-bg">
                        <div class="card-header p-0 --card-header-bg --text-color-dark" id="subject-header">
                            <button class="btn btn-block m-0" type="button" data-toggle="collapse" data-target="#subject-collapse" aria-expanded="true" aria-controls="collapseOne">Subjects</button>
                        </div>

                        <div class="collapse" id="subject-collapse" data-parent="#search-by-accordion">
                            <div class="card-body --card-body-bg">
                                <div class="list-group list-group-flush" >
                                    @foreach ($data['subjects'] as $sub)
                                    <a href="{{route('subject.search', $sub->id)}}" class="list-group-item list-group-item-action --links-list">
                                        {{$sub->subject_name}}
                                    </a>  
                                    @endforeach
                                    <a href="{{route('home.nosubject')}}" class="list-group-item list-group-item-action --links-list" >No subjects</a> 
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- POSITION AND SUBJECT --}}
                    <div class="card p-0 --card-body-bg">
                        <div class="card-header p-0 --card-header-bg --text-color-dark" id="ps-header">
                            <button class="btn btn-block m-0" type="button" data-toggle="collapse" data-target="#ps-collapse" aria-expanded="true" aria-controls="collapseOne">Subjects and Positions</button>
                        </div>

                        <div class="collapse" id="ps-collapse" data-parent="#search-by-accordion">
                            <div class="card-body --card-body-bg" >
                                <form action="{{route('search.both')}}" method="get">
                                    @csrf
                                    <div class="form-group">
                                        <select name="position_id" id="position-id-select" class="custom-select --input-text-box">
                                            <option selected disabled>Position</option>
                                            @foreach ($data['positions'] as $post)
                                                <option value="{{$post->id}}">{{$post->position}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select name="subject_id" id="subject-id-select" class="custom-select --input-text-box">
                                            <option selected disabled>Subject</option>
                                            @foreach ($data['subjects'] as $s)
                                                <option value="{{$s->id}}">{{$s->subject_name}}</option>
                                            @endforeach 
                                        </select>
                                    </div>
                                    <input type="submit" value="Go" class="btn btn-block --btn-custom">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-8 order-md-1">
                @livewire('search-dropdown')
            </div>
        </div>
    </div>
@endsection