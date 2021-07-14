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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/other-pages-style.css') }}">
    @livewireStyles

    <style>
        html{
            scroll-behavior: smooth;
        }
        #nav-img{
            background-image: url('{{ asset('storage/avatars/'.Auth::user()->avatar) }}'); 
            width: 30px;
            height: 30px;
            top: 10px;
            display: inline-block;
        }

        #back-to-top-btn{
            position: fixed;
            display: none;
            bottom: 20px;
            right: 20px;
            border: 2px solid #d5a021;
            border-radius: 50%;
            background-color: #ffffff;
            color: #d5a021;
            transition: 0.4s ease-in-out;
        }

        #back-to-top-btn:hover, #back-to-top-btn:focus {
            border: 2px solid #4b4237;
            background-color: #4b4237;
            color: #ffffff;
        }
    </style>

</head>
<body>
    {{-- MAIN --}}
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
                                    {{-- <span class="--cropper">
                                        <img src="{{asset('/storage/avatars/' . Auth::user()->avatar)}}" alt="avatar" class="--img-circle" > 
                                    </span> --}}

                                    {{-- <img src="{{asset('/storage/avatars/' . Auth::user()->avatar)}}" alt="avatar" class="--img-circle" width="30px" height="30px"> --}}

                                    <div class="--img" id="nav-img" style=""></div>
                                    {{-- {{asset('/storage/avatars/' . Auth::user()->avatar)}} --}}

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

        <div>            
            <main class="py-4" style="min-height: 100vh">
                @yield('content')
            </main>    
        </div>     
    </div>

    {{-- FOOTER --}}
    <footer class="--footer w-100 --dark-lava-bg --text-color-papaya-whip mt-auto p-3 text-center">
        <p>Copyright &copy; {{now()->year}} Cresent. All Rights Reserved</p>
    </footer>

    <!-- Back to Top Button -->
    <button type="button" class="btn btn-light btn-floating btn-md" id="back-to-top-btn">
        <i class="fas fa-chevron-up"></i>
    </button>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.min.js" integrity="sha512-SG4yH2eYtAR5eK4/VL0bhqOsIb6AZSWAJjHOCmfhcaqTkDviJFoar/VYdG96iY7ouGhKQpAg3CMJ22BrZvhOUA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/landing-main.js')}}"></script>
    @livewireScripts

    @if (Route::currentRouteName()== 'home')
        <script type="text/javascript">
            function showSubjectDescription(){
                var id = document.getElementById('subject-name').value;

                var descriptions = document.querySelectorAll('.--subject-descriptions');

                for(let desc of descriptions){
                    if(id == desc.getAttribute('data-number')){
                        desc.style.display = 'block';
                    }else{
                        desc.style.display = 'none';
                    }
                }
            }
        </script>
    @endif
</body>
</html>
