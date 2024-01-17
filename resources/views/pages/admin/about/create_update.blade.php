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
                                <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="meta_description" class="form-label">Meta Description</label>
                                                <input type="text" name="meta_description" id="meta_description"
                                                    class="form-control" required value="{{ @$about->meta_description }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="meta_keyword" class="form-label">Meta Keyword</label>
                                                <input type="text" name="meta_keyword" id="meta_keyword"
                                                    class="form-control" required value="{{ @$about->meta_keyword }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="page_title" class="form-label">Title</label>
                                                <input type="text" name="page_title" id="page_title" class="form-control"
                                                    required value="{{ @$about->page_title }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="page_body" class="form-label">Body</label>
                                                <textarea name="page_body" id="editor1">{{ @$about->page_body }}</textarea>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="picture" class="form-label">Foto</label>
                                                <input type="file" name="picture" id="picture" class="form-control"
                                                    required>
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
