@extends('layouts.admin')

@section('title', 'Tambah / Update Kontak')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Kontak</h2>
                <p class="dashboard-subtitle">
                    Tambah / Update Kontak
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
                                <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea name="alamat" id="alamat" class="form-control">{{ @$contact->alamat }}</textarea>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="no_telp" class="form-label">no telp</label>
                                                <input type="text" name="no_telp" id="no_telp" class="form-control"
                                                    value="{{ @$contact->no_telp }}" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    required value="{{ @$contact->email }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="jam_operasional" class="form-label">jam operasional</label>
                                                <textarea name="jam_operasional" id="jam_operasional" class="form-control">{{ @$contact->jam_operasional }}</textarea>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="google_map" class="form-label">google map</label>
                                                <input type="google_map" name="google_map" id="google_map"
                                                    class="form-control" required value="{{ @$contact->google_map }}">
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
