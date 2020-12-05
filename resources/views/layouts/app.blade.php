<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Fast Event') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        
        <nav class="navbar my-navbar navbar-expand-md mb-5">
            <div class="container">
                
                @if(auth()->check())
                @if(auth()->user()->role!="admin")
                <a class=" mylink navbar-brand text-uppercase" href="{{ url('/mano-renginiai') }}">
                    Mano renginiai
                </a>
                <a class=" mylink navbar-brand text-uppercase" href="{{ url('/renginiai') }}">
                    Visi renginiai
                </a>
                @endif
                @if(auth()->user()->role=="renginio_organizatorius")
                <a class=" mylink navbar-brand text-uppercase" href="{{ url('/renginys') }}">
                    Sukurti renginį
                </a>
                @endif
                @if (auth()->user()->role=="admin")
                <a class=" mylink navbar-brand text-uppercase" href="{{ url('/renginiai') }}">
                    Visi renginiai
                </a>
                <a class=" mylink navbar-brand text-uppercase" href="{{ url('/vartotojai') }}">
                    Visi vartotojai
                </a>
                @endif 
                @endif                               
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
                                <a class=" mylink navbar-brand text-uppercase" href="{{ route('login') }}">
                                    Prisijungti
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item text-uppercase">
                                    <a class="mylink navbar-brand text-uppercase" href="{{ route('register') }}">Užsiregistruoti</a>
                                </li>
                            @endif
                        @else

                        <a class=" mylink navbar-brand text-uppercase" href="{{ route('logout') }}">
                            Atsijungti
                        </a>

                    

                                    

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container col-md-8">
            @include('layouts.flash-message')
            </div>
            @yield('content')
            
        </main>
    </div>
</body>
</html>
