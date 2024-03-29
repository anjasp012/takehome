@extends('layouts.app')

@section('title')
    Product Detail | {{ $product->name }}
@endsection

@section('meta')
    <meta name="description" content="{{ $product->meta_description }}">
    <meta name="keywords" content="{{ $product->meta_keyword }}">
@endsection

@section('content')
    <div class="page-content page-details">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/">Home</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Product Details
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="row justify-content-between gy-5">
                <div class="col-lg-12">
                    <section class="store-gallery mb-3" id="gallery">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-5" data-aos="zoom-in">
                                    <transition name="slide-fade" mode="out-in">
                                        <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" alt=""
                                            class="w-100">
                                    </transition>
                                    <div class="d-flex overflow-auto" style="gap: 0.8rem">
                                        <div class="mt-2" style="width: 24.5%;height: 118px"
                                            v-for="(photo, index) in photos" :key="photo.id">
                                            <a href="#" @click="changeActive(index)">
                                                <img :src="photo.url" style="width: 100px; height: 100px"
                                                    class="thumbnail-image" :class="{ active: index == activePhoto }"
                                                    alt="">
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-7">
                                    <div class="store-details-container" data-aos="fade-up">
                                        <section class="store-heading">
                                            <div class="container">
                                                <form action="{{ route('detail-add', $product->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            <h1>{{ $product->name }}</h1>
                                                            <div class="owner">
                                                                {{ $product->user->store_name ?? ($product->user->name ?? '') }}
                                                            </div>
                                                            {{-- @if ($product->discon_price > 0)
                                                                <div class="mb-0 price text-dark fw-lighter text-decoration-line-through"
                                                                    style="font-size: 14px">
                                                                    Rp. {{ number_format($product->price, '0', '.', '.') }}
                                                                </div>
                                                                <div class="price">Rp.
                                                                    {{ number_format($product->discon_price, '0', '.', '.') }}
                                                                </div>
                                                            @else
                                                                <div class="mb-0 price text-dark fw-lighter text-decoration-line-through"
                                                                    style="font-size: 14px">
                                                                    Rp. -
                                                                </div>
                                                                <div class="price">Rp.
                                                                    {{ number_format($product->price, '0', '.', '.') }}
                                                                </div>
                                                            @endif --}}
                                                            <div class="price" id="hargaVariasi">Rp.
                                                                {{ number_format($product->variationLowerPrice->price, '0', '.', '.') }}
                                                                -
                                                                {{ number_format($product->variationHigherPrice->price, '0', '.', '.') }}
                                                            </div>
                                                            <div class="mb-2">
                                                                <div>Jumlah Kamar</div>
                                                                <div class="d-flex gap-2">
                                                                    <input {{ $product->size_s ? '' : 'disabled' }}
                                                                        type="radio" class="btn-check" name="size"
                                                                        value="s" id="s" data-size="1 BR">
                                                                    <label class="btn btn-outline-dark" for="s">1
                                                                        BR</label>
                                                                    <input {{ $product->size_m ? '' : 'disabled' }}
                                                                        type="radio" class="btn-check" name="size"
                                                                        value="m" id="m" data-size="2 BR">
                                                                    <label class="btn btn-outline-dark" for="m">2
                                                                        BR</label>
                                                                    <input {{ $product->size_l ? '' : 'disabled' }}
                                                                        type="radio" class="btn-check" name="size"
                                                                        value="l" id="l" data-size="3 BR">
                                                                    <label class="btn btn-outline-dark" for="l">3
                                                                        BR</label>
                                                                    <input {{ $product->size_xl ? '' : 'disabled' }}
                                                                        type="radio" class="btn-check" name="size"
                                                                        value="xl" id="xl" data-size="4 BR">
                                                                    <label class="btn btn-outline-dark" for="xl">4
                                                                        BR</label>
                                                                    <input {{ $product->size_xxl ? '' : 'disabled' }}
                                                                        type="radio" class="btn-check" name="size"
                                                                        value="xxl" id="xxl" data-size="5 BR">
                                                                    <label class="btn btn-outline-dark" for="xxl">5
                                                                        BR</label>
                                                                </div>
                                                                @error('size')
                                                                    <small class="text-danger">silahkan pilih jumlah kamar
                                                                        !</small>
                                                                @enderror
                                                            </div>
                                                            <div>
                                                                <div>Tipe Unit</div>
                                                                <div class="col-12">
                                                                    @foreach ($product->variations as $key => $variation)
                                                                        <input
                                                                            @click="changeActive({{ $key + $galleries->count() }})"
                                                                            data-harga="{{ number_format($variation->price, '0', '.', '.') }}"
                                                                            type="radio" class="btn-check"
                                                                            name="variation" value="{{ $variation->id }}"
                                                                            data-variation="{{ $variation->name }}"
                                                                            id="{{ $variation->id }}">
                                                                        <label class="btn btn-outline-dark mb-1"
                                                                            for="{{ $variation->id }}">{{ $variation->name }}
                                                                        </label>
                                                                    @endforeach

                                                                    @error('variation')
                                                                        <small class="text-danger d-block">silahkan pilih tipe
                                                                            unit!</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12" data-aos="zoom-in">
                                                            <button type="button"
                                                                class="btn btn-success px-4 text-white btn-block mb-3"
                                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                Minta Pricelist
                                                            </button>



                                                            {{-- @auth
                                                                @if (auth()->id() != $product->user_id && auth()->user()->roles != 'ADMIN')
                                                                    <button type="submit"
                                                                        class="btn btn-success px-4 text-white btn-block mb-3">
                                                                        Add To Cart
                                                                    </button>
                                                                @endif
                                                            @else
                                                                <a href="{{ route('login') }}"
                                                                    class="btn btn-success px-4 text-white btn-block mb-3">
                                                                    Booking Sekarang
                                                                </a>
                                                            @endauth --}}
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="store-details-container" data-aos="fade-up">
                        <section class="store-description">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <h5>Produk Terkait</h5>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            @forelse ($productSimilar as $similar)
                                                <div class="col-6 col-lg-2" data-aos="fade-up">
                                                    <a href="{{ route('detail', $similar->slug) }}"
                                                        class="component-products d-block">
                                                        <div class="products-thumbnail">
                                                            <div class="products-image"
                                                                style={{ $similar->galleries->count() > 0 ? 'background-image:url(' . asset($similar->galleries->first()->getPhotos()) . ');' : 'background-color:#eee;' }}>
                                                            </div>
                                                        </div>
                                                        <div class="products-text">
                                                            {{ $similar->name }}
                                                        </div>
                                                        @if ($similar->discon_price > 0)
                                                            <div class="products-price text-dark fw-lighter text-decoration-line-through"
                                                                style="font-size: 12px">
                                                                Rp. {{ number_format($similar->price, '0', '.', '.') }}
                                                            </div>
                                                            <div class="products-price">
                                                                Rp.
                                                                {{ number_format($similar->discon_price, '0', '.', '.') }}
                                                            </div>
                                                        @else
                                                            <div class="products-price text-dark fw-lighter text-decoration-line-through"
                                                                style="font-size: 12px">
                                                                Rp. -
                                                            </div>
                                                            <div class="products-price">
                                                                Rp. {{ number_format($similar->price, '0', '.', '.') }}
                                                            </div>
                                                        @endif
                                                    </a>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="store-description">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <h5>Spesifikasi Produk</h5>
                                    </div>
                                    <div class="col-12">
                                        <table class="table table-borderless">
                                            @foreach ($product->spesifications as $spesification)
                                                <tr>
                                                    <td class="w-25 px-0">
                                                        <div class="text-secondary">
                                                            {{ $spesification->name }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $spesification->description }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="store-description">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <h5>Deskripsi Produk</h5>
                                    </div>
                                    <div class="col-12">
                                        {!! $product->description !!}
                                    </div>
                                    @isset($product->link_youtube)
                                        <div class="col-lg-5">
                                            <div class="ratio ratio-16x9 rounded overflow-hidden">
                                                <iframe src="{{ $product->link_youtube }}" title="YouTube video"
                                                    allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    @endisset
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Data Pengunjung</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('detail-pengunjung', $product) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="size">
                        <input type="hidden" name="variation">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">email</label>
                            <input type="text" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_wa" class="form-label">No Wa</label>
                            <input type="text" class="form-control" name="no_wa" id="no_wa" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No Hp</label>
                            <input type="text" class="form-control" name="no_hp" id="no_hp" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Minta Pricelist</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var gallery = new Vue({
            el: "#gallery",
            mounted() {
                AOS.init();
            },
            data: {
                activePhoto: 0,
                photos: [
                    @foreach ($galleries as $g => $gallery)
                        {
                            id: {{ $g + 1 }},
                            url: "{{ asset($gallery->getPhotos()) }}",
                        },
                    @endforeach
                    @foreach ($variations as $v => $variation)
                        @if ($variation->getPhotos() != null)
                            {
                                id: {{ $v + $galleries->count() + 1 }},
                                url: "{{ asset($variation->getPhotos()) }}",
                            },
                        @else
                            {
                                id: {{ $v + $galleries->count() + 1 }},
                                url: "{{ asset($galleries[0]->getPhotos()) }}",
                            },
                        @endif
                    @endforeach
                ],
            },
            methods: {
                changeActive(id) {
                    console.log(id);
                    this.activePhoto = id
                },
            },
        });


        $('input[type="radio"][name="variation"]').click(function() {
            var harga = $(this).data('harga');
            $('#hargaVariasi').html('Rp. ' +
                harga)
        });

        document.addEventListener("DOMContentLoaded", function() {
            var sizeRadioButtons = document.querySelectorAll("input[name='size']");
            sizeRadioButtons.forEach(function(radioButton) {
                $(radioButton).on("change", function() {
                    var selectedSize;
                    for (var i = 0; i < sizeRadioButtons.length; i++) {
                        if (sizeRadioButtons[i].checked) {
                            selectedSize = $(sizeRadioButtons[i]).attr("data-size");
                            break;
                        }
                    }
                    $('.modal-body input[name="size"]').val(selectedSize);
                });
            });

            function changeActive(variationId) {
                $('.modal-body input[name="variation"]').val(variationId);
            }

            $('input[name="variation"]').on('change', function() {
                var selectedVariationId = $(this).data('variation');
                changeActive(selectedVariationId);
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                text: "{{ session('success') }}",
                icon: "success"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Open WhatsApp link in a new page
                    window.open('https://api.whatsapp.com/send?phone=6282188892023', '_blank');
                }
            });
        </script>
    @endif
@endpush
