<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>
    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
    <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
      document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
    }

    /* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
      document.getElementById("main").style.marginLeft = "0";
      document.body.style.backgroundColor = "white";
    }
    $('#mySidenav').click(function(event){
    event.stopPropagation();
});
    </script>
    <script src="https://kit.fontawesome.com/f636442e25.js"></script>
    @yield('javascript')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style = "position:fixed; width:100%; z-index: 50;">
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
                        <li>
                            <a class="nav-link" href="/message">Home <span class="sr-only"></span></a>
                        </li>
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
                                    <img src = "/uploads/{{ Auth::user()->avatar }}" style = "width:32px;height:32px;border-radius:50%;">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class = "dropdown-item" href = "{{URL('profile')}}">Personal Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
            <nav id="mySidenav" class="sidenav">
                <div class = sibar-header>
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
                <div class = "sibar-img" style = "display: flex;border-top: 1px solid #3a3f48;">
                    <div style = "padding:10px 20px;">
                        <img class = "img-responsive img-rounded" src = "/uploads/default.png" style = "width:50px;height:50px; border-radius: 50%;">
                    </div>
                    <div class="user-info" >
                        <span class="user-name">

                        </span>
                        <br>
                        <span class="user-role">Name</span>
                        <!-- <span class="user-status">
                            <i class="fa fa-circle"></i>
                            <span>Online</span>
                        </span> -->
                    </div>
                </div>
                <div class = "sidebar-menu" style = "border-top: 1px solid #3a3f48;">
                    <div style = "padding:10px 20px;">
                        <a href="/home"><i class="fas fa-home"></i>Home</a>
                        <a href="/profile"><i class="fas fa-id-card"></i>Profile</a>
                        <a href="/message"><i class="fas fa-comments"></i>Blog</a>
                        <a href="#">Test2</a>
                    </div>
                </div>
            </nav>

            <!-- Use any element to open the sidenav -->
            <span onclick="openNav()"><i id = "open_icon" class="fas fa-align-justify fa-3x"></i></span>

            <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
            <div id="main">
            @include('common.flash-message')
              @yield('content')
            </div>

        </main>
    </div>
@yield('js')
</body>
</html>
