@extends('layouts.app')

@section('title')
    Product Detail | {{ $article->title }}
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
                                    Blog Details
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-gallery mb-3" id="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12" data-aos="zoom-in">
                        <img src="{{ $article->getPhoto() }}" alt="" class="w-100">
                    </div>
                </div>
            </div>
        </section>

        <div class="store-details-container" data-aos="fade-up">
            <section class="store-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1>{{ $article->title }}</h1>
                        </div>
                    </div>
                </div>
            </section>
            <section class="store-description">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            {!! $article->body !!}
                        </div>
                    </div>
                </div>
            </section>
            {{-- <section class="store-review">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8 mt-3 mb-3">
                            <h5>Customer Review (3)</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <ul class="list-unstyled">
                                <li class="media">
                                    <img src="/images/reviewer-1" class="mr-3 rounded-circle" alt="">
                                    <div class="media-body">
                                        <h5 class="mt-2 mb-1">
                                            Hazza Rizky
                                        </h5>
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur hic
                                        repellendus necessitatibus iste officia ratione.
                                    </div>
                                </li>
                                <li class="media">
                                    <img src="/images/reviewer-2" class="mr-3 rounded-circle" alt="">
                                    <div class="media-body">
                                        <h5 class="mt-2 mb-1">
                                            Anna Sukkirata
                                        </h5>
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur hic
                                        repellendus necessitatibus iste officia ratione.
                                    </div>
                                </li>
                                <li class="media">
                                    <img src="/images/reviewer-3" class="mr-3 rounded-circle" alt="">
                                    <div class="media-body">
                                        <h5 class="mt-2 mb-1">
                                            Dakimu Wangi
                                        </h5>
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur hic
                                        repellendus necessitatibus iste officia ratione.
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section> --}}
        </div>
    </div>
@endsection
