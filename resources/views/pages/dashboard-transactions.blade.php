@extends('layouts.dashboard')

@section('title', 'Transactions')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Transactions</h2>
                <p class="dashboard-subtitle">
                    Big result start from the small one
                </p>
            </div>
            <div class="dashboard-contennt">

                <div class="row mt-3">
                    <div class="col-12 mt-2">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            @if (Auth::user()->store_status == '1')
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-sell-product-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-sell-product" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">Sell Product</button>
                                </li>
                            @endif
                            <li class="nav-item" role="presentation">
                                <button class="nav-link{{ Auth::user()->store_status != '1' ? ' active' : '' }}"
                                    id="pills-buy-product-tab" data-bs-toggle="pill" data-bs-target="#pills-buy-product"
                                    type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Buy
                                    Product</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            @if (Auth::user()->store_status == '1')
                                <div class="tab-pane fade {{ Auth::user()->store_status == '1' ? ' show active' : '' }}"
                                    id="pills-sell-product" role="tabpanel" aria-labelledby="pills-home-tab">
                                    @forelse ($sellTransactions as $transaction)
                                        <a href="{{ route('dashboard-transaction-details', $transaction) }}"
                                            class="card card-list d-block">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <img src="{{ asset($transaction->product->galleries->first()->getPhotos() ?? '') }}"
                                                            alt="" class="w-75">
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ $transaction->product->name }}
                                                    </div>
                                                    <div class="col-md-3">
                                                        {{ $transaction->transaction->user->name }}
                                                    </div>
                                                    <div class="col-md-3">
                                                        {{ $transaction->created_at }}
                                                    </div>
                                                    <div class="col-md-1 d-none d-md-block">
                                                        <img src="/images/expand_more_24px.svg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @empty
                                    @endforelse
                                </div>
                            @endif
                            <div class="tab-pane fade{{ Auth::user()->store_status != '1' ? ' show active' : '' }}"
                                id="pills-buy-product" role="tabpanel" aria-labelledby="pills-profile-tab">
                                @forelse ($buyTransactions as $transaction)
                                    <a href="{{ route('dashboard-transaction-details', $transaction) }}"
                                        class="card card-list d-block">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <img src="{{ asset($transaction->product->galleries->first()->getPhotos() ?? '') }}"
                                                        alt="" class="w-75">
                                                </div>
                                                <div class="col-md-4">
                                                    {{ $transaction->product->name }}
                                                </div>
                                                <div class="col-md-3">
                                                    {{ $transaction->transaction->user->name }}
                                                </div>
                                                <div class="col-md-3">
                                                    {{ $transaction->created_at }}
                                                </div>
                                                <div class="col-md-1 d-none d-md-block">
                                                    <img src="/images/expand_more_24px.svg" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
