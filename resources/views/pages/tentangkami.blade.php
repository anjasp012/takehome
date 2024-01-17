@extends('layouts.app')

@section('title', 'Tengtang kami')

@section('content')
    <div class="page-content page-home">
        <section class="store-new-articles">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Tentang Kami</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        {!! @$tentangkami->page_body !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
