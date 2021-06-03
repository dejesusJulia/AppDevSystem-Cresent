@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-alert></x-alert>
            <div class="card">
                <div class="card-header">
                    <h3>Complete your profile</h3>
                </div>


                <div class="card-body">
                    <form action="{{route('complete.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="Avatar">Avatar</label>
                            <input type="file" name="avatar" id="avatar">
                        </div>

                        <div>
                            <label for="portfolio">Portfolio</label>
                            <input type="file" name="portfolio" id="portfolio">
                        </div>

                        <div>
                            <label for="website">Personal website</label>
                            <input type="text" name="website" id="website" placeholder="Put your personal website or link to your social media">
                        </div>

                        <div>
                            <label for="about">About</label>
                            <textarea name="about" id="about" cols="30" rows="5"></textarea>
                        </div>

                        <div>
                            <label for="position">Your desired position/role</label>
                            <select name="position_id" id="position">
                                <option value="" selected disabled>Choose one</option>
                                @foreach ($positions as $position)
                                    <option value="{{$position->id}}">{{$position->position}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <button type="submit">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
