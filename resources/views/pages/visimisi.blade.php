@extends('layouts.app')

@section('title', 'Visi Misi')

@section('content')
    <div class="page-content page-home">
        <section class="store-new-articles">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Visi Misi</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        {!! @$misivisi->description !!}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
