@extends('layouts.success')

@section('title', 'Success')

@section('content')
    <div class="page-content page-success">
        <div class="section-success" data-aos="zoom-in">
            <div class="container">
                <div class="row align-items-center row-login justify-content-center">
                    <div class="col-lg-6 text-center">
                        <img src="/images/bag 1.svg" alt="" class="mb-4">
                        <h2>Welcome to Store</h2>
                        <p>Kamu sudah berhasil terdaftar
                            <br> bersama kami. Let's grow up now.
                        </p>
                        <div class="">
                            <a href="{{ route('dashboard') }}" class="btn btn-success w-50 mt-4">
                                My Dashboard
                            </a>
                            <a href="{{ route('home') }}" class="btn btn-signup w-50 mt-4">
                                Go To Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
