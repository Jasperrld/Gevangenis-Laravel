<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Document')</title>
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/klantenportaal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/klantenportaal_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/klantenportaal_footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bezoekregeling.css') }}">
    <link rel="stylesheet" href="{{ asset('css/historie.css') }}">
    <link rel="stylesheet" href="{{ asset('css/arrestantencomplex.css') }}">
</head>
<body>
<header class="header">
    <a href="{{ url('/') }}"><img class="logo" src="{{ asset('img/logo.png') }}" alt="Logo"></a>

    <nav class="klantenportaal_menu">
        <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/bezoekregeling') }}">Bezoekregeling</a></li>
            <li><a href="{{ url('/historie') }}">Historie</a></li>
            <li><a href="{{ url('/arrestantencomplex') }}">Arrestantencomplex</a></li>

            @guest
                <li><a href="{{ route('login') }}">Login To Hoornhek</a></li>
            @else

                {{-- @hasanyrole('maatschappelijkwerker|opnameofficier|portier|admin')
                    <li><a href="{{ route('prisoners.index') }}">Admin</a></li>
                @endhasanyrole --}}
                @can('index prisoner')
                <li><a href="{{ route('prisoners.index', ['location_id' => Auth::user()->location_id]) }}">Hoornhek</a></li>
                @endcan
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Log out
                    </a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </ul>
    </nav>

    <button class="menu-toggle" aria-label="Toggle Menu">
        <span class="icon-container">
            <i class="fa-sharp fa-solid fa-bars"></i>
        </span>
    </button>
</header>

@yield('content')

<footer class="klantenportaal_footer">
    <div class="footer-content">
        <div class="contact-info">
            <h2>Contact Information</h2>
            <div>Email: arrestantencomplexhout@hotmail.com</div>
            <div>Phone: 0900 8844</div>
            <div>Address: Vleugelboot 21, 3991 CM Houten</div>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuToggle = document.querySelector('.menu-toggle');
        const menu = document.querySelector('.klantenportaal_menu ul');

        menuToggle.addEventListener('click', function () {
            menu.classList.toggle('active');
        });
    });
</script>
</body>
</html>
