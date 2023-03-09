@inject('cart', 'App\Services\CartService')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/front/app.scss', 'resources/js/front/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    <img class="logo" src="{{asset('img/logo.jpg')}}" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else



                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>


                                @if(Auth::user()?->role == 'admin')
                                <a class="dropdown-item" href="{{ route('home') }}">
                                    Admin-part
                                </a>
                                @endif



                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>


                        <li class="nav-item dropdown">
                            <a id="cartDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <div class="cart-svg">
                                    <svg class="cart">
                                        <use xlink:href="#cart"></use>
                                    </svg>
                                    <span class="count">{{$cart->count}}</span>

                                </div>
                            </a>
                            <a href="{{route('cart')}}" class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @forelse($cart->list as $product)
                                <div class="dropdown-item">
                                    {{$product->title}}
                                    <b>X</b> {{$product->count}} dish(-es)

                                </div>

                                @empty
                                <span class="dropdown-item">Empty</span>
                                @endforelse
                            </a>
                        </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
            @include('layouts.svg')
        </main>

        <footer class="footer bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h4>About Us</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et quam vitae urna vestibulum semper.</p>
                    </div>
                    <div class="col-md-4">
                        <h4>Contact Us</h4>
                        <ul class="list-unstyled">
                            <li>123 Main St.</li>
                            <li>Anytown, USA 12345</li>
                            <li><a href="tel:555-555-5555">555-555-5555</a></li>
                            <li><a href="evgeny@gmail.com">info@gmail.com</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h4>Follow Us</h4>
                        <ul class="list-unstyled">
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Twitter</a></li>
                            <li><a href="#">Instagram</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

    </div>
</body>
</html>
