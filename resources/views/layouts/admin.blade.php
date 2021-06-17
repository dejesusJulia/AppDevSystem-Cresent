<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (Auth::user()->avatar)
                                    <img src="{{asset('/storage/avatars/' . Auth::user()->avatar)}}" alt="avatar" class="rounded-circle" width="50px">
                                    
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.min.js" integrity="sha512-SG4yH2eYtAR5eK4/VL0bhqOsIb6AZSWAJjHOCmfhcaqTkDviJFoar/VYdG96iY7ouGhKQpAg3CMJ22BrZvhOUA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        var ctx1 = document.getElementById('positionsToUserChart');
        var ctx2 = document.getElementById('subjectsToUserChart');
        var ctx3 = document.getElementById('regUsersChart');

        var date = new Date();
        var month = date.toLocaleString('default', {month:'short'});
        var date1 = month + ' 1';
        var date2 = month + ' 10';
        var date3 = month + ' 20';
        var lastDay = new Date(date.getFullYear(), date.getMonth() +1, 0).getDate();
        var date4 = month + ' ' + lastDay;

        var myChart1 = new Chart(ctx1, {
            type: 'doughnut',
            data: {
            labels: {!!json_encode($data['positions'])!!},
            datasets: [{
                label: 'Users per Position',
                // data: [12, 19, 3, 5, 6, 8],
                data: {!!json_encode($data['counts'])!!},
                backgroundColor: [
                'rgba(1, 50, 67, 1)',
                'rgba(51, 110, 123, 1)',
                'rgba(197, 239, 247, 1)',
                'rgba(129, 207, 224, 1)', 
                'rgba(0, 181, 204, 1)',
                'rgba(228, 241, 254, 1)'
                ],
            }]
            },
            options: {
                //cutoutPercentage: 40,
            responsive: true,
        
            }
        });

        var myChart2 = new Chart(ctx2, {
            type: 'doughnut',
            data: {
            labels: {!!json_encode($data['subjects'])!!},
            datasets: [{
                label: 'Users per Subject',
                data: {!!json_encode($data['subCount'])!!},
                backgroundColor: [
                'rgba(42, 187, 155, 1)',
                'rgba(27, 163, 156, 1)',
                'rgba(162, 222, 208, 1)',
                'rgba(54, 215, 183, 1)', 
                'rgba(30, 130, 76, 1)'
                ],
            }]
            },
            options: {
                //cutoutPercentage: 40,
            responsive: true,
        
            }
        });

        var myLineChart = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: {!!json_encode($data['registeredDate'])!!},
                datasets: [{
                label: "User registration",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: {!!json_encode($data['registeredCount'])!!},
                }],
            },
            options: {
                scales: {
                xAxes: [{
                    time: {
                    unit: 'date'
                    },
                    gridLines: {
                    display: false
                    },
                    ticks: {
                    maxTicksLimit: 3
                    }
                }],
                yAxes: [{
                    ticks: {
                    min: 0,
                    max: 30,
                    maxTicksLimit: 5
                    },
                    gridLines: {
                    color: "rgba(0, 0, 0, .125)",
                    }
                }],
                },
                legend: {
                display: false
                }
            }
            });
    </script>
    
</body>
</html>
