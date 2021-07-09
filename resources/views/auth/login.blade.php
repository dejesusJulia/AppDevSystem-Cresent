<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{asset('storage/img/Logo/Favicon.png')}}"> 
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="{{asset('css/auth-style.css')}}" />
    <style>
      input:-webkit-autofill,
      input:-webkit-autofill:hover,
      input:-webkit-autofill:focus,
      input:-webkit-autofill:active{
        -webkit-box-shadow: 0 0 0 30px #f0f0f0 inset !important;
      }
      
    </style>
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="login-signup">
          <form action="{{ route('login') }}" class="log-in-form" id="login-container" method="POST">
            @csrf
            <h2 class="title">LOGIN</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="email" placeholder="{{ __('E-Mail Address') }}" autocomplete="email" name="email" value="{{ old('email') }}">
            </div>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" autocomplete="current-password" name="password">
            </div>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <input type="submit" value="Login" class="btn solid" />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>BE ONE OF US!</h3>
            <p>
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
            </p>
            <a href="{{ route('register') }}" class="btn transparent" id="sign-up-btn">
                Sign up
            </a>
          </div>
          <img src="{{asset('storage/img/login.png')}}" class="image" alt="" />
        </div>
      </div>
    </div>
  </body>
</html>
