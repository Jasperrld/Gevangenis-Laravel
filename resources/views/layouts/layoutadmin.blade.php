<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Application</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/prisoners.css') }}">
    <link rel="stylesheet" href="{{ asset('css/prisoner_new.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cellen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/zaken.css') }}">
    <link rel="stylesheet" href="{{ asset('css/locatie.css') }}">



    <!-- Add your custom stylesheets here -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <script src="https://kit.fontawesome.com/ae11820d03.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts" defer></script>

</head>
<body class="hoornhek_body">
    <header class="header">
        <img class="logo" src="{{ asset('img/logo.png') }}" alt="Logo">
        <nav class="hoornhek_menu">
            @auth
            <ul>
                @hasanyrole('admin')
                <li><a href="{{ url('admin/panel') }}">Admin</a></li>
                @endhasanyrole
                @can('index visitor')
                {{-- <li><a href="{{ route('visitors.index') }}">Bezoekers</a></li> --}}
                <li><a href="{{ route('visitors.index', ['location_id' => Auth::user()->location_id]) }}">Bezoekers</a></li>
                @endcan
                @can('index visit')
                {{-- <li><a href="{{ route('visits.index') }}">Bezoeken</a></li> --}}
                <li><a href="{{ route('visits.index', ['location_id' => Auth::user()->location_id]) }}">Bezoeken</a></li>
                @endcan
                @hasanyrole('maatschappelijkwerker|portier|admin')
                @can('index prisoner')
                <li><a href="{{ route('prisoners.index', ['location_id' => Auth::user()->location_id]) }}">Detentie</a></li>
                 @endcan
                @can('index cell')
                <li><a href="{{ route('cells.index', ['location_id' => Auth::user()->location_id]) }}">Cellen</a></li>
                    {{-- <li><a href="{{ route('cells.index') }}">Cellen</a></li> --}}
                @endcan
                @can('index prisoncase')
                    {{-- <li><a href="{{ route('prisoncases.index') }}">Lopende zaken</a></li> --}}
                    <li><a href="{{ route('prisoncases.index', ['location_id' => Auth::user()->location_id]) }}">Lopende zaken</a></li>

                @endcan
                @can('index historie')
                <li><a href="{{ route('histories.index', ['location_id' => Auth::user()->location_id]) }}">DetentieHistorie</a></li>
                    {{-- <li><a href="{{ route('histories.index') }}">Detentiehistorie</a></li> --}}
                @endcan
                @can('index log')
                <li><a href="{{ route('logs.index') }}">Logs</a></li>
                @endcan
                @can('index location')
                <li><a href="{{ route('locations.index') }}">Locations</a></li>
                @endcan



                @endhasanyrole
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>
            </ul>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endauth
        </nav>


        <button class="menu-toggle" aria-label="Toggle Menu">
            <span class="icon-container">
                <i class="fa-sharp fa-solid fa-bars"></i>
            </span>
        </button>
    </header>
    @yield('topmenu')

    @yield('content')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuToggle = document.querySelector('.menu-toggle');
            const menu = document.querySelector('.hoornhek_menu ul');

            menuToggle.addEventListener('click', function () {
                menu.classList.toggle('active');
            });
        });
    </script>


<footer class="hoornhek_footer">
   <div>
   Welkom op de Hoornhek applicatie</div>
   <div>
    Ingelogd als: {{ Auth::user()->name }} ({{ Auth::user()->email }}) - Rol:
    @foreach(Auth::user()->roles as $role)
        {{ $role->name }}
    @endforeach
</div>
<div>
    Locatie: {{ optional(Auth::user()->location)->name ?? 'N/A' }}
</div>
</footer>

</body>
</html>
