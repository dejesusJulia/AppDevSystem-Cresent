<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('storage/img/Logo/Favicon.png')}}"> 

    <title>Cresent</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/other-pages-style.css') }}">
    @livewireStyles

</head>
<body >
    <div id="app" class="bckgd-img">
        <nav class="navbar navbar-expand-md navbar-light --card-body-bg shadow-sm">
            <div class="container">
                <a class="--a-links-light" href="{{ route('home') }}">
                    <h5 class="mb-0">Cresent</h5>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (Auth::user()->avatar)
                                    <img src="{{asset('/storage/avatars/' . Auth::user()->avatar)}}" alt="avatar" class="rounded-circle" width="30px" height ="30px"style="object-fit: contain">
                                    
                                    @endif
                                    
                                    {{ Auth::user()->email }}

                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div >
            {{-- <img src="{{asset('storage/img/Backdrops/Mesh.jpg')}}" alt="" class="--backdrop"> --}}
            {{-- <div class="--overlay"></div> --}}
            
            <main class="py-4">
                @yield('content')
            </main>
            
        </div>
        
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.min.js" integrity="sha512-SG4yH2eYtAR5eK4/VL0bhqOsIb6AZSWAJjHOCmfhcaqTkDviJFoar/VYdG96iY7ouGhKQpAg3CMJ22BrZvhOUA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/material-dashboard/core/jquery.min.js')}}" type="text/javascript"></script>
   <script src="{{asset('js/material-dashboard/core/popper.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/material-dashboard/plugins/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    {{-- IF ON HOME PAGE --}}
    @livewireScripts
    
    @if (Route::currentRouteName() == 'home')
    <script type="text/javascript">
        $(document).ready( function () {
        $('#sample').DataTable();
        } );
    </script>
    @endif
</body>
</html>
