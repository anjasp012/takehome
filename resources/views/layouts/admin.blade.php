<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="google-site-verification" content="ZIaKitojTUkvkpAYAOZoiPqZxacFvyy5ANRBXSIPcUY" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TakeHome') }} | Admin | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Scripts -->
    @stack('prepend-style')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet" />
    @stack('addon-style')
</head>

<body>

    <div class="page-dashboard">
        <div class="d-flex" id="wrapper" data-aos="fade-right">
            <!-- sidebard -->
            <div class="border-right" id="sidebar-wrapper">
                <div class="sidebar-heading text-center">
                    <img src="/images/admin.png" alt="" class="my-4" style="max-width: 150px;">
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin-dashboard') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('admin-dashboard') ? ' active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('slider.index') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('slider.*') ? ' active' : '' }}">
                        Slider
                    </a>
                    <a href="{{ route('contact.index') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('contact.*') ? ' active' : '' }}">
                        Kontak
                    </a>
                    <a href="{{ route('popup.index') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('popup.*') ? ' active' : '' }}">
                        Popup
                    </a>
                    <a href="{{ route('promo.index') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('promo.*') ? ' active' : '' }}">
                        Promo
                    </a>
                    <a href="{{ route('about.index') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('about.*') ? ' active' : '' }}">
                        Tentang
                    </a>
                    <a href="{{ route('visimisi.index') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('visimisi.*') ? ' active' : '' }}">
                        Visi Misi
                    </a>
                    <a href="{{ route('user.index') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('user.*') ? ' active' : '' }}">
                        Users
                    </a>
                    <a href="{{ route('news.index') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('news.*') ? ' active' : '' }}">
                        Berita
                    </a>
                    <a href="{{ route('header-category.index') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('head-category.*') ? ' active' : '' }}">
                        Header Kategori
                    </a>
                    <a href="{{ route('sub-header-category.index') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('sub-category.*') ? ' active' : '' }}">
                        Sub-Header Kategori
                    </a>
                    <a href="{{ route('category.index') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('category.*') ? ' active' : '' }}">
                        Kategori
                    </a>
                    <a href="{{ route('product.index') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('product.*') ? ' active' : '' }}">
                        Products
                    </a>
                    <a href="{{ route('product-gallery.index') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('product-gallery.*') ? ' active' : '' }}">
                        Galleries
                    </a>
                    <a href="{{ route('testimony.index') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('testimony.*') ? ' active' : '' }}">
                        Testimony
                    </a>
                    <a href="{{ route('transaction.index') }}"
                        class="list-group-item list-group-item-action{{ request()->routeIs('transaction.*') ? ' active' : '' }}">
                        Transactions
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
                                        <a href="" class="dropdown-item">Dashboard</a>
                                        <a href="" class="dropdown-item">Settings</a>
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
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
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
