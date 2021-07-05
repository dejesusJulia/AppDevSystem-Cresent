<div>
    @if (session()->has('message'))
        <div class="alert --success-bg alert-dismissible fade show" role="alert">
            <strong>{{session()->get('message')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    @elseif(session()->has('error'))
        <div class="alert --danger-bg alert-dismissible fade show" role="alert">
            <strong>{{session()->get('error')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
    @elseif($errors->any())
        <div class="alert --danger-bg alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>