@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Dashboard</h2>
                <p class="dashboard-subtitle">
                    Look what you have made today!
                </p>
            </div>
            <div class="dashboard-contennt">
                <div class="row">
                    @if (Auth::user()->store_status == '1')
                        <div class="col-md-4">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="dashboard-card-title">
                                        Customer
                                    </div>
                                    <div class="dashboard-card-subtitle">
                                        {{ $customer }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="dashboard-card-title">
                                        Revenue
                                    </div>
                                    <div class="dashboard-card-subtitle">
                                        Rp.{{ number_format($revenue) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-title">
                                    Transaction
                                </div>
                                <div class="dashboard-card-subtitle">
                                    {{ $transaction_count }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 mt-2">
                        <h5 class="mb-3">Recent Transactions</h5>
                        @forelse ($transaction_data as $transaction)
                            <a href="{{ route('dashboard-transaction-details', $transaction->id) }}"
                                class="card card-list d-block">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img src="{{ asset($transaction->product->galleries->first()->getPhotos() ?? '') }}"
                                                alt="" class="w-75">
                                        </div>
                                        <div class="col-md-4">
                                            {{ $transaction->product->name ?? '' }}
                                        </div>
                                        <div class="col-md-3">
                                            {{ $transaction->transaction->user->name ?? '' }}
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
@endsection
