@extends('layouts.admin')

@section('title', 'Edit Article')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Article</h2>
                <p class="dashboard-subtitle">
                    Edit Article
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
                                <form action="{{ route('news.update', $item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="meta_keyword">Meta Keyword</label>
                                                <input type="text" name="meta_keyword" id="meta_keyword"
                                                    class="form-control" value="{{ $item->meta_keyword }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="meta_description">Meta Description</label>
                                                <input type="text" name="meta_description" id="meta_description"
                                                    class="form-control" value="{{ $item->meta_description }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="title" class="form-label">Title</label>
                                                <input type="text" name="title" id="title" class="form-control"
                                                    value="{{ $item->title }}" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="thumbnail" class="form-label">Foto</label>
                                                <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="body" class="form-label">Body</label>
                                                <textarea name="body" id="editor1">{!! $item->body !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-end">
                                            <button type="submit" class="btn btn-success px-5">Save Now</button>
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
