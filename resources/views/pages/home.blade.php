@extends('layouts.app')

@section('title', 'HomePage')

@section('content')
    <div class="page-content page-home">
        <section class="store-carousel">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12" data-aos="zoom-in">
                        <div id="storeCarousel" class="carousel slide" data-bs-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($sliders as $key => $slider)
                                    <li class="{{ $key == 0 ? 'active' : '' }}" data-bs-target="#storeCarousel"
                                        data-bs-slide-to="{{ $key }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($sliders as $key => $slider)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset($slider->getPhoto()) }}"
                                            class="d-block w-100 rounded-2 carouselHeight">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-promo">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Produk Favorit</h5>
                    </div>
                </div>
                <div class="row">
                    @forelse ($favorites as $key => $product)
                        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ ($key + 1) * 100 }}">
                            <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
                                <div class="products-thumbnail">
                                    <div class="products-image"
                                        style={{ $product->galleries->count() > 0 ? 'background-image:url(' . asset($product->galleries->first()->getPhotos()) . ');' : 'background-color:#eee;' }}>
                                    </div>
                                </div>
                                <div class="products-text">
                                    {{ $product->name }}
                                </div>
                                @if ($product->discon_price > 0)
                                    <div class="products-price text-dark fw-lighter text-decoration-line-through"
                                        style="font-size: 12px">
                                        Rp. {{ number_format($product->price, '0', '.', '.') }}
                                    </div>
                                    <div class="products-price">
                                        Rp. {{ number_format($product->discon_price, '0', '.', '.') }}
                                    </div>
                                @else
                                    <div class="products-price text-dark fw-lighter text-decoration-line-through"
                                        style="font-size: 12px">
                                        Rp. -
                                    </div>
                                    <div class="products-price">
                                        Rp. {{ number_format($product->price, '0', '.', '.') }}
                                    </div>
                                @endif
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                            No Products Found
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
        <section class="store-new-products mb-4">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Promo</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="swiper promo">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                @forelse ($promos as $promo)
                                    <a href="{{ $promo->link }}" class="swiper-slide"><img class="w-100 rounded"
                                            height="148px" style="object-fit: cover;object-position: center"
                                            src="{{ $promo->getPhoto() }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                        No Promo Found
                    </div>
                    @endforelse
                </div>
            </div>
        </section>
        {{-- <section class="store-trend-categories">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Trend Categories</h5>
                    </div>
                </div>
                <div class="row">
                    @forelse ($categories as $key => $category)
                        <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{ ($key + 1) * 100 }}">
                            <a href="{{ route('categories-details', $category->slug) }}"
                                class="component-categories d-block">
                                <div class="categories-image">
                                    <img src="{{ asset($category->getPhoto()) }}" alt="" class="w-100">
                                </div>
                                <p class="categories-text">{{ $category->name }}</p>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                            No Categories Found
                        </div>
                    @endforelse
                </div>
            </div>
        </section> --}}
        <section class="store-new-products">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Produk Terpopuler</h5>
                    </div>
                </div>
                <div class="row">
                    @forelse ($products as $key => $product)
                        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ ($key + 1) * 100 }}">
                            <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
                                <div class="products-thumbnail">
                                    <div class="products-image"
                                        style={{ $product->galleries->count() > 0 ? 'background-image:url(' . asset($product->galleries->first()->getPhotos()) . ');' : 'background-color:#eee;' }}>
                                    </div>
                                </div>
                                <div class="products-text">
                                    {{ $product->name }}
                                </div>
                                @if ($product->discon_price > 0)
                                    <div class="products-price text-dark fw-lighter text-decoration-line-through"
                                        style="font-size: 12px">
                                        Rp. {{ number_format($product->price, '0', '.', '.') }}
                                    </div>
                                    <div class="products-price">
                                        Rp. {{ number_format($product->discon_price, '0', '.', '.') }}
                                    </div>
                                @else
                                    <div class="products-price text-dark fw-lighter text-decoration-line-through"
                                        style="font-size: 12px">
                                        Rp. -
                                    </div>
                                    <div class="products-price">
                                        Rp. {{ number_format($product->price, '0', '.', '.') }}
                                    </div>
                                @endif
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                            No Products Found
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
        <section class="store-new-products">
            <div class="container">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-12" data-aos="fade-up">
                            <h5 class="mb-3">
                                {{ $category->name }}
                            </h5>
                            <div class="col-12">
                                <div class="row">
                                    @forelse ($category->productsByCategory as $key => $product)
                                        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up"
                                            data-aos-delay="{{ ($key + 1) * 100 }}">
                                            <a href="{{ route('detail', $product->slug) }}"
                                                class="component-products d-block">
                                                <div class="products-thumbnail">
                                                    <div class="products-image"
                                                        style={{ $product->galleries->count() > 0 ? 'background-image:url(' . asset($product->galleries->first()->getPhotos()) . ');' : 'background-color:#eee;' }}>
                                                    </div>
                                                </div>
                                                <div class="products-text">
                                                    {{ $product->name }}
                                                </div>
                                                @if ($product->discon_price > 0)
                                                    <div class="products-price text-dark fw-lighter text-decoration-line-through"
                                                        style="font-size: 12px">
                                                        Rp. {{ number_format($product->price, '0', '.', '.') }}
                                                    </div>
                                                    <div class="products-price">
                                                        Rp. {{ number_format($product->discon_price, '0', '.', '.') }}
                                                    </div>
                                                @else
                                                    <div class="products-price text-dark fw-lighter text-decoration-line-through"
                                                        style="font-size: 12px">
                                                        Rp. -
                                                    </div>
                                                    <div class="products-price">
                                                        Rp. {{ number_format($product->price, '0', '.', '.') }}
                                                    </div>
                                                @endif
                                            </a>
                                        </div>
                                    @empty
                                        <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                                            No Products Found
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        {{-- <section class="store-testimonies">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Testimoni</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="swiper promo">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                @forelse ($testimonies as $key => $testimoni)
                                    <div class="swiper-slide pb-2" data-aos="fade-up"
                                        data-aos-delay="{{ ($key + 1) * 100 }}">
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <h6 class="font-sm text-primary mb-3">
                                                    {{ $testimoni->name }}
                                                </h6>
                                                <img src="{{ asset($testimoni->getPhoto()) }}" class="img-fluid mb-3"
                                                    style="width: 100px" alt="">
                                                <div>
                                                    {!! $testimoni->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                        No Testimoni Found
                    </div>
                    @endforelse
                </div>
            </div>
        </section> --}}
        <section class="store-new-articles">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Berita Terbaru</h5>
                    </div>
                </div>
                <div class="row">
                    @forelse ($articles as $key => $article)
                        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ ($key + 1) * 100 }}">
                            <a href="{{ route('berita.show', $article->slug) }}" class="component-products d-block">
                                <div class="products-thumbnail">
                                    <div class="products-image"
                                        style={{ $article->thumbnail ? 'background-image:url(' . asset($article->getPhoto()) . ');' : 'background-color:#eee;' }}>
                                    </div>
                                </div>
                                <div class="products-text" style="font-size: 14px">
                                    {{ $article->title }}
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                            No Products Found
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
@endpush

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
@endpush

@push('addon-script')
    <script>
        var swiper = new Swiper(".promo", {
            slidesPerView: 1.3,
            autoplay: {
                delay: 5000,
            },
            loop: true,
            spaceBetween: 10,
            breakpoints: {
                640: {
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
            }
        });
    </script>
@endpush
