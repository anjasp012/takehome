@extends('layouts.app')

@section('title', 'Category')

@section('content')
    <div class="page-content page-home">
        <section class="store-trend-categories">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>All Categories</h5>
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
        </section>
        <section class="store-new-products">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>All Products</h5>
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
                                <div class="products-price">
                                    Rp. {{ number_format($product->price, '0', '.', '.') }}
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
