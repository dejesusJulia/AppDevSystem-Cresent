<div>
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session()->get('message')}}</strong>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="close"></button>
        </div>

    @elseif(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{session()->get('error')}}</strong>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
        
    @elseif($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
    @endif
</div>