@extends('layouts.admin')

@section('title', 'Edit Transaction')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Transaction</h2>
                <p class="dashboard-subtitle">
                    Edit Transaction
                </p>
            </div>
            <div class="dashboard-contennt">
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any)
                            @foreach ($errors->all as $error)
                                <div class="alert alert-danger">
                                    <li>{{ $error }}</li>
                                </div>
                            @endforeach
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('transaction.update', $item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="transaction_status" class="form-label">Status Transaksi</label>
                                                <select name="transaction_status" id="transaction_status"
                                                    class="form-select" required>
                                                    <option value="{{ $item->transaction_status }} selected">
                                                        {{ $item->transaction_status }}</option>
                                                    <option value="" disabled>-----------------</option>
                                                    <option value="SHIPPING">SHIPPING</option>
                                                    <option value="PENDING">PENDING</option>
                                                    <option value="SUCCESS">SUCCESS</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="total_price" class="form-label">Total</label>
                                                <input type="number" name="total_price" id="price" class="form-control"
                                                    value="{{ $item->total_price }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-end">
                                            <button class="btn btn-success px-5">Save Now</button>
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
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor1');
    </script>
@endpush
