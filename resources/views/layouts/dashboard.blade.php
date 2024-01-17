<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="google-site-verification" content="gdS19GAI9TUR12UKn9c1Vmgoqg_6m3eJPshUF73zgzw" />
    <meta name="google-site-verification" content="uE_Cc3Cr5alQL_CUJXPskZUxcdGNCgGsPFr-i2DXUug" />
    <meta name="google-site-verification" content="ZIaKitojTUkvkpAYAOZoiPqZxacFvyy5ANRBXSIPcUY" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TakeHome') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Scripts -->
    @stack('prepend-style')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('addon-style')
</head>

<body>

    <div class="page-dashboard">
        <div class="d-flex" id="wrapper" data-aos="fade-right">
            <!-- sidebard -->
            <div class="border-right" id="sidebar-wrapper">
                <div class="sidebar-heading text-center">
                    <img src="/images/dashboard-store-logo.svg" alt="" class="my-4">
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('dashboard') ? ' active' : '' }}">
                        Dashboard
                    </a>
                    @if (Auth::user()->store_status == '1')
                        <a href="{{ route('dashboard-product') }}"
                            class="list-group-item list-group-item-action{{ request()->routeIs('dashboard-product*') ? ' active' : '' }}">
                            My Product
                        </a>
                    @endif
                    <a href="{{ route('dashboard-transaction') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('dashboard-transaction*') ? ' active' : '' }}">
                        Transactions
                    </a>
                    @if (auth()->user()->store_status != 1)
                    @else
                        <a href="{{ route('dashboard-settings-store') }}"
                            class="list-group-item list-group-item-action{{ request()->routeIs('dashboard-settings-store') ? ' active' : '' }}">
                            Store Settings
                        </a>
                    @endif
                    <a href="{{ route('dashboard-settings-account') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('dashboard-settings-account*') ? ' active' : '' }}">
                        My Account
                    </a>
                </div>
            </div>

            <!-- page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top" data-aos="fade-down">
                    <div class="container-fluid">
                        <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">
                            &laquo; Menu
                        </button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Desktop Menu -->
                            <ul class="navbar-nav d-none d-lg-flex ms-auto">
                                <li class="nav-item dropdown">
                                    <a href="" class="nav-link" id="navbarDropdown" role="button"
                                        data-bs-toggle="dropdown">
                                        <img src="/images/user_pc.png" alt=""
                                            class="rounded-circle mr-2 profile-picture">
                                        Hi, {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                                        <a href="{{ route('dashboard-settings-account') }}"
                                            class="dropdown-item">Settings</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="{{ route('logout') }}" class="dropdown-item"
                                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();
                                ">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                                        @if (Auth::user()->cart->count() > 0)
                                            <img src="/images/icon-cart-filled.svg" alt="">
                                            <div class="cart-badge">{{ Auth::user()->cart->count() }}</div>
                                        @else
                                            <img src="/images/icon-cart-empty.svg" alt="">
                                        @endif
                                    </a>
                                </li>
                            </ul>

                            <!-- Mobile Menu -->
                            <ul class="navbar-nav d-block d-lg-none">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Hi, {{ Auth::user()->name }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link d-inline-block">
                                        Cart
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('logout') }}" class="nav-link d-inline-block"
                                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();
                                ">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- section Content -->
                @yield('content')
            </div>
        </div>
    </div>

    @stack('prepend-script')
    <script src="/vendor/jquery/jquery.slim.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        $('#menu-toggle').click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass('toggled');
        })
    </script>
    @stack('addon-script')
</body>

</html>
