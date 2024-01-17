@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Category</h2>
                <p class="dashboard-subtitle">
                    Edit Category
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
                                <form action="{{ route('user.update', $item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="name" class="form-label">Nama User</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    value="{{ $item->name }}" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="email" class="form-label">Email User</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    value="{{ $item->email }}" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="password" class="form-label">Password User</label>
                                                <input type="password" name="password" id="password" class="form-control">
                                                <small class="text-muted">Kosongkan jika tidak ingin diganti</small>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="roles" class="form-label">Roles User</label>
                                                <select name="roles" id="roles" class="form-select" required>
                                                    <option value="{{ $item->roles }}" selected>Tidak Diganti</option>
                                                    <option value="USER">USER</option>
                                                    <option value="ADMIN">ADMIN</option>
                                                </select>
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
