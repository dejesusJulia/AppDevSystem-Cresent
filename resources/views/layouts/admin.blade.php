<!--
=========================================================
Material Dashboard - v2.1.2
=========================================================

Product Page: https://www.creative-tim.com/product/material-dashboard
Copyright 2020 Creative Tim (https://www.creative-tim.com)
Coded by Creative Tim

=========================================================
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/storage/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('/storage/img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    {{ config('app.name', 'Laravel') }}
  </title>
  {{-- <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' /> --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="{{asset('css/material-dashboard/material-dashboard.min.css')}}" rel="stylesheet"/>
  <link href="{{asset('css/material-dashboard/demo.css')}}" rel="stylesheet"/>
  <link rel="icon" href="{{asset('storage/img/Logo/Favicon.png')}}"> 

  <!-- CSS Just for demo purpose, don't include it in your project -->
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange" data-background-color="white" data-image="{{asset('/storage/img/sidebar-1.jpg')}}">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="{{asset('storage/img/Logo/Crescent.png')}}" class="simple-text logo-normal">
          Cresent
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item" id="dash-link">
            <a class="nav-link " href="{{route('dash')}}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item " id="users-link">
            <a class="nav-link" href="{{route('users.index')}}">
              <i class="material-icons">groups</i>
              <p>Users List</p>
            </a>
          </li>
          <li class="nav-item " id="positions-link">
            <a class="nav-link" href="{{route('position.index')}}">
              <i class="material-icons">badge</i>
              <p>Positions List</p>
            </a>
          </li>
          <li class="nav-item " id="subjects-link">
            <a class="nav-link" href="{{route('subject.index')}}">
              <i class="material-icons">subjects</i>
              <p>Subjects List</p>
            </a>
          </li>
          <li class="nav-item " id="profile-link">
            <a class="nav-link" href="{{route('admin.editprofile')}}">
              <i class="material-icons">person</i>
              <p>User Profile</p>
            </a>
          </li>

          <li class="nav-item active-pro " id="logout-link">
            <a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
              <i class="material-icons">logout</i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="{{route('admin.editprofile')}}">Profile</a>
                  <div class="dropdown-divider"></div>

                  <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
              </li>
            </ul>
          </div>

        </div>
      </nav>
      <!-- End Navbar -->
      @yield('content')

      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="https://creative-tim.com/presentation">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
              <li>
                <a href="https://www.creative-tim.com/license">
                  Licenses
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="{{asset('js/material-dashboard/core/jquery.min.js')}}" type="text/javascript"></script>
   <script src="{{asset('js/material-dashboard/core/popper.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('js/material-dashboard/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('js/material-dashboard/core/popper.min.js')}}" type="text/javascript"></script>

  <!-- Plugin for the momentJs  -->
  <script src="{{asset('js/material-dashboard/plugins/moment.min.js')}}" type="text/javascript"></script>

  <!-- Forms Validations Plugin -->
  <script src="{{asset('js/material-dashboard/plugins/jquery.validate.min.js')}}" type="text/javascript"></script>

  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="{{asset('js/material-dashboard/plugins/jquery.bootstrap-wizard.js')}}" type="text/javascript"></script>

  <script src="{{asset('js/material-dashboard/plugins/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>

  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="{{asset('js/material-dashboard/plugins/jquery.dataTables.min.js')}}" type="text/javascript"></script>

  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{asset('js/material-dashboard/plugins/nouislider.min.js')}}" type="text/javascript"></script>

  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- Library for adding dinamically elements -->
  <script src="{{asset('js/material-dashboard/plugins/arrive.min.js')}}" type="text/javascript"></script>

  <!--  Google Maps Plugin    -->
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->

  <!-- Chartist JS -->
  <script src="{{asset('js/material-dashboard/plugins/chartist.min.js')}}" type="text/javascript"></script>

  <!--  Notifications Plugin    -->
  <script src="{{asset('js/material-dashboard/plugins/bootstrap-notify.js')}}" type="text/javascript"></script>

  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('js/material-dashboard/material-dashboard.js')}}" type="text/javascript"></script>

  <script src="{{asset('js/material-dashboard/demo.js')}}" type="text/javascript"></script>

  <!-- SIDEBAR script -->
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
      var path = window.location.href;

      $('.sidebar-wrapper .nav li').each(function(){
        //console.log($(this).find('a').attr('href'));
        if($(this).find('a').attr('href') == path){
          $(this).addClass('active').siblings().removeClass('active');
        }
      });
    });
  </script>

  @if (Route::currentRouteName()== 'dash')
    {{-- CHARTS --}}
  <script type="text/javascript">
    if ($('#positionsToUserChart').length != 0 || $('#subjectsToUserChart').length != 0 || $('#connectionsCountChart').length != 0) {

  dataPositionsToUserChart = {
    labels: {!!json_encode($data['positions'])!!},
    series: [
    {!!json_encode($data['counts'])!!}
    ]
  };

  optionsPositionsToUserChart = {
    lineSmooth: Chartist.Interpolation.cardinal({
      tension: 0
    }),
    low: 0,
    high: 12, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
    chartPadding: {
      top: 0,
      right: 0,
      bottom: 0,
      left: 0
    },
  }

  var positionsToUserChart = new Chartist.Line('#positionsToUserChart', dataPositionsToUserChart, optionsPositionsToUserChart);

  md.startAnimationForLineChart(positionsToUserChart);


  /* ----------==========     Completed Tasks Chart initialization    ==========---------- */

  dataSubjectsToUserChart = {
    labels: {!!json_encode($data['subjects'])!!},
    series: [
        {!!json_encode($data['subCount'])!!}
    ]
  };

  optionsSubjectsToUserChart = {
    lineSmooth: Chartist.Interpolation.cardinal({
      tension: 0
    }),
    low: 0,
    high: 12, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
    chartPadding: {
      top: 0,
      right: 0,
      bottom: 0,
      left: 0
    }
  }

  var subjectsToUserChart = new Chartist.Line('#subjectsToUserChart', dataSubjectsToUserChart, optionsSubjectsToUserChart);

  // start animation for the Completed Tasks Chart - Line Chart
  md.startAnimationForLineChart(subjectsToUserChart);


  /* ----------==========     Emails Subscription Chart initialization    ==========---------- */

  var dataConnectionsCountChart = {
    labels: {!!json_encode($data['weeklyDates'])!!},
    series: [
        {!!json_encode($data['connectionCount'])!!}

    ]
  };
  var optionsConnectionsCountChart = {
    axisX: {
      showGrid: false
    },
    low: 0,
    high: 12,
    chartPadding: {
      top: 0,
      right: 5,
      bottom: 0,
      left: 0
    }
  };
  var responsiveOptions = [
    ['screen and (max-width: 640px)', {
      seriesBarDistance: 5,
      axisX: {
        labelInterpolationFnc: function(value) {
          return value[0];
        }
      }
    }]
  ];
  var connectionsCountChart = Chartist.Bar('#connectionsCountChart', dataConnectionsCountChart, optionsConnectionsCountChart, responsiveOptions);

  //start animation for the Emails Subscription Chart
  md.startAnimationForBarChart(connectionsCountChart);
  }
  </script>
  @endif

  @if (Route::currentRouteName()== 'position.index')
  <script type="text/javascript">
    $(document).ready( function () {
      $('#position-list').DataTable();
    } );
  </script>
  @endif

  @if (Route::currentRouteName()== 'subject.index')
  <script type="text/javascript">
    $(document).ready( function () {
      $('#subject-list').DataTable();
    } );
  </script>
  @endif

  @if (Route::currentRouteName()== 'users.index')
  <script type="text/javascript">
    $(document).ready( function () {
      $('#user-list').DataTable();
    } );
  </script>
  @endif

  @if (Route::currentRouteName() == 'admin.editprofile')
  <script type="text/javascript">
    $('.form-file-simple .inputFileVisible').click(function() {
      $(this).siblings('.inputFileHidden').trigger('click');
    });
  
    $('.form-file-simple .inputFileHidden').change(function() {
      var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
      $(this).siblings('.inputFileVisible').val(filename);
    });
    </script>
  @endif

</body>

</html>