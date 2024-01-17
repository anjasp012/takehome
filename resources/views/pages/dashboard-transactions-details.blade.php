@extends('layouts.dashboard')

@section('title', 'Transaction Details')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">{{ $transaction->code }}</h2>
                <p class="dashboard-subtitle">
                    Transactions Detailss
                </p>
            </div>
            <div class="dashboard-contennt" id="transactionsDetails">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <img src="{{ asset($transaction->product->galleries->first()->getPhotos() ?? '') }}"
                                            alt="" class="w-100 mb-3">
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Customer Name
                                                </div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->transaction->user->name }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Product Name <small>(Product Variation)</small>
                                                </div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->product->name }}
                                                    <small>({{ @$transaction->variation->name }})</small>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Date of Transaction
                                                </div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->created_at }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Payment Status
                                                </div>
                                                <div class="product-subtitle text-danger">
                                                    {{ $transaction->transaction->transaction_status }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Total Amount
                                                </div>
                                                <div class="product-subtitle">
                                                    Rp.{{ number_format($transaction->price) }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Mobile
                                                </div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->transaction->user->phone_number }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="product-title">
                                                    Size
                                                </div>
                                                <div class="product-subtitle">
                                                    {{ $transaction->size }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('dashboard-transaction-update', $transaction->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 mt-4">
                                            <h5>Shipping Information</h5>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">
                                                        Address I
                                                    </div>
                                                    <div class="product-subtitle">
                                                        {{ $transaction->transaction->user->address_one }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">
                                                        Address II
                                                    </div>
                                                    <div class="product-subtitle">
                                                        {{ $transaction->transaction->user->address_two }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">
                                                        Province
                                                    </div>
                                                    <div class="product-subtitle">
                                                        {{ App\Models\Province::find($transaction->transaction->user->province_id)->name }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">
                                                        City
                                                    </div>
                                                    <div class="product-subtitle">
                                                        {{ App\Models\Regency::find($transaction->transaction->user->regency_id)->name }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">
                                                        Postal Code
                                                    </div>
                                                    <div class="product-subtitle">
                                                        {{ $transaction->transaction->user->zip_code }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="product-title">
                                                        Country
                                                    </div>
                                                    <div class="product-subtitle">
                                                        {{ $transaction->transaction->user->country }}
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <div class="product-title">
                                                        Shipping Status
                                                    </div>
                                                    <select name="shipping_status" id="status" class="form-select"
                                                        v-model="status"
                                                        {{ Auth::user()->id == $transaction->transaction->user->id ? 'disabled' : '' }}>
                                                        <option value="SHIPPING">SHIPPING</option>
                                                        <option value="PENDING">PENDING</option>
                                                        <option value="SUCCESS">SUCCESS</option>
                                                    </select>
                                                </div>
                                                <template v-if="status == 'SHIPPING'">
                                                    <div class="col-md-3">
                                                        <div class="product-title">Input Resi</div>
                                                        <input type="text" class="form-control" name="resi"
                                                            v-model="resi">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button class="btn btn-success btn-block mt-4">Update</button>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 text-end">
                                            @if (auth()->user()->store_status)
                                                <button class="btn btn-success btn-lg">Save Now</button>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var transactionsDetails = new Vue({
            el: '#transactionsDetails',
            data: {
                status: '{{ $transaction->shipping_status }}',
                resi: '{{ $transaction->resi }}'
            },
        });
    </script>
@endpush
