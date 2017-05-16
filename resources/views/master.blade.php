<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <style type="text/css">
            body{
                background: url("{{asset('images/library.jpg')}}") no-repeat center center fixed;
                background-size: 100% auto;
                font-family: 'Merriweather', sans-serif;
                font-weight: 100;
            }
            header{opacity: 0.9;}
            footer{background-color: #fff; opacity: 0.9; text-align: center;}
            .col-md-3 {height: 500px;}
            .link > a {
                color: #006064;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
      <header class="jumbotron">
          <div class="container">
              <div class="col-md-10">
                  <h1>The Bookstore!</h1>
                  <p>Reading a good book is like taking a journey.</p>
              </div>
              <div class="col-md-2 link">
                  <a href="/../library">Home Page</a><br>
                  @if (Route::has('login'))
                      <div class="link">
                          @if (Auth::check())
                              <a href="/../authors/{{ Auth::user()->id}}">{{ Auth::user()->name }}'s Area</a><br>
                              <a href="/../admin">Manage Sections</a><br>
                              <a href="{{ url('/logout') }}">Logout</a>
                          @else
                              <a href="{{ url('/login') }}">Login</a><br>
                              <a href="{{ url('/register') }}">Register</a><br>
                          @endif
                      </div>
                  @endif
                  <a href="/../summary" class="index">Summary</a><br>
                  Date : {{ date('Y-m-d') }} <br/>Time : {{ date('H:m:s') }}
              </div>
          </div>
      </header>

      @if(Session::has('m'))
      <div class="container">
        <?php $a = []; $a = session()->pull('m'); ?>
        <div class="alert alert-{{ $a[0] }}">
          {{ $a[1] }}
        </div>
      </div>
      @endif

      @yield('content')

      <footer class="container">
          &copy; All Right Reserved for Bilal Saad - 2017
      </footer>
    </body>
</html>