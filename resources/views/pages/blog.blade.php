@extends('layouts.app')

@section('title', 'Category')

@section('content')
    <div class="page-content page-home">
        <section class="store-new-articles">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Artikel Blog</h5>
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
