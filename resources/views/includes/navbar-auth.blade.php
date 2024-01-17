<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand text-success fw-bold">
            <img src="{{ asset('images/logo.png') }}" class="w-50 m-0 p-0" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item active">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories') }}" class="nav-link">Categories</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('berita.index') }}" class="nav-link">Berita</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Info
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('tentangkami') }}">Tentang Kami</a></li>
                        <li><a class="dropdown-item" href="{{ route('visi-misi') }}">Visi & Misi</a></li>
                        <li><a class="dropdown-item" href="{{ route('kontak') }}">Kontak</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-bs-toggle="modal"
                        data-bs-target="#searchModal">Pencarian</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('search') }}" class="d-flex" role="search">
                    <input class="form-control me-2 w-100" name="cari" required type="search"
                        placeholder="pencarian..." aria-label="pencarian..." value="{{ $cari ?? '' }}">
                    <button class="btn btn-sm btn-outline-success" type="submit">Cari</button>
                </form>
            </div>
        </div>
    </div>
</div>
