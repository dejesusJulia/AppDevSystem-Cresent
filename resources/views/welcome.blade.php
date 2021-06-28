<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cresent</title>

        <link rel="icon" href="{{asset('storage/img/Logo/Favicon.png')}}"> 
        <link rel="stylesheet" href="{{asset('css/landing-style.css')}}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    </head>
    <body>
        <!----Navigation Bar---->
	<section id="navbar">
		<div class="row no-gutters">
            <div class="col-md-5 col-sm-5 col-5">
                <a class="navbar-brand" href="#"><img src="{{asset('storage/img/Logo/Crescent.png')}}" alt="Logo"></a>
            </div>
            @if (Route::has('login'))
                @auth
                <div class="col-md-5 col-sm-5 col-5">
                    <a class="signin float-right" href="{{ url('/home') }}">Home</a>
                </div>

                @else
                <div class="col-md-5 col-sm-5 col-5">
                    <a class="signin float-right" href="{{ route('login') }}">Sign In</a>
                </div>
                @endauth
            @endif
        </div>
	</section>

    <!-- Landing Banner -->
	<section id="banner" class="landing">
		<div class="row no-gutters">
			<img src="{{asset('storage/img/Backdrops/Mesh.jpg')}}" alt="Mesh" class="img-fluid">
			<div class="greetings">
				<h1>Building</h1>
				<h1 style="color: #d5a021">brighter</h1>
				<h1>connections</h1>
				<h3>Take your first step on building your own professional team. Start your business venture here at Crescent!</h3>
                @if (Route::has('login'))
                    @auth
                    @else
                        @if (Route::has('register'))
                        <a class="register" href="{{ route('register') }}">Register Now</a>
                        @endif 
                    @endauth 
                @endif
			</div>
		</div>
        <div class="overlay"></div>
	</section>

    <!-- Introduction -->
    <section id="intro">
        <div class="row no-gutters">
			<div class="col-md-12 roots">
				<h1>Discover Our Roots</h1>
				<p>Crescent symbolizes new beginnings and the making of dreams into reality. It also represents empowerment and building a better future. We believe that these representations perfectly describe our main objective of helping those aspiring entrepreneurs to build a solid foundation on starting their own business venture. This is also the reason we created Crescent so as to guide them on their journey and achieve their goals to become successful in the future.</p>
			</div>
		</div>
        <div class="row no-gutters">
			<div class="col-md-6">
				<img src="{{asset('storage/img/Backdrops/Connect.jpg')}}" alt="Connect" class="img-fluid">
			</div>
			<div class="col-md-6 intro">
				<h1>What is Crescent?</h1>
				<p>Crescent is a system especially made for aspiring entrepreneurs who wish to build their own professional team and run their very first business venture. This system will help them find other entrepreneurs that have similar interests as they have. Using Crescent will guide them on building the appropriate team that will cater to their needs and preferences for their future business.</p>
			</div>
		</div>
    </section>

    <!-- Features -->
    <section id="features">
        <div class="row no-gutters">
			<div class="col-md-12 label">
                <h5>Features</h5>
                <h1>Let Innovation Go Further</h1>
                <p>We provide our users an environment where they can confidently present themselves as who they are. The following features will help them to connect easily with other entrepreneurs and build their dream team based on their similarities in terms of their field of expertise and interests.</p>
            </div>
		</div>
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-4">
                    <img src="{{asset('storage/img/Icons/profile.png')}}" alt="Profile">
                    <h1>Profile Customization</h1>
                    <p>Customize your own profile to showcase your expertise and interests. This will help you find the perfect team members that will complete your dream team.</p>
                </div>
                <div class="col-lg-4">
                    <img src="{{asset('storage/img/Icons/search.png')}}" alt="Search">
                    <h1>Member Selection</h1>
                    <p>Search and browse a list of users and check their profiles. Connect with them by sending a request to join their team, this may be a start of something incredible.</p>
                </div>
                <div class="col-lg-4">
                    <img src="{{asset('storage/img//Icons/team.png')}}" alt="Team">
                    <h1>Team Management</h1>
                    <p>Create and manage your team the way you want it to be. The sky is the limit, you have the freedom to accept or reject any users who want to join your team.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Get In Touch -->
    <section id="get">
        <div class="container-fluid">
            <div class="row logo text-center no-gutters">
                <div class="col-md-12">
                    <img src="images/Logo/Crescent.png" alt="Logo" class="img-fluid">
                    <img src="{{asset('storage/img/Logo/Crescent.png')}}" alt="Logo" class="img-fluid">
                </div>
            </div>
            <div class="row touch no-gutters">
                <div class="col-md-6 matter">
                    <h5>Get In Touch</h5>
                    <h1>Your Suggestions<br>Do Matter</h1>
                    <p>Help us create a healthier and user-friendly environment for everyone. Send us your feedbacks and recommendations through the following contact channels. This will be a great help for us to further improve our services for our users. Thank you for your support!</p>
                </div>
                <div class="col-md-6 reach">
                    <div class="contact"><i class="fab fa-facebook-messenger"></i>Developer's Name</div>
                    <div class="contact"><i class="fas fa-phone-alt"></i>8888-888-8888</div>
                    <div class="contact"><i class="fas fa-envelope"></i>crescent@gmail.com</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <section id="footer">
        <div class="end-bar">
            <p>Copyright © 2021 Crescent. All Rights Reserved.</p>
        </div>
    </section>

    <!-- Back to Top Button -->
    <button type="button" class="btn btn-light btn-floating btn-md" id="back-to-top-btn">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Back To Top JS -->
    <script src="{{asset('js/landing-main.js')}}"></script>
    </body>
</html>
