@extends('layouts.admin')

@section('title', 'Category')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Artikel</h2>
                <p class="dashboard-subtitle">
                    List Of Artikel
                </p>
            </div>
            <div class="dashboard-contennt">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('news.create') }}" class="btn btn-primary mb-3">+ Tambah Artikel
                                    Baru</a>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover scroll-horizontal-vertical w-100"
                                        id='crudTable'>
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Title</th>
                                                <th>Foto</th>
                                                <th>Slug</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'photo',
                    name: 'thumbnail'
                },
                {
                    data: 'slug',
                    name: 'slug'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searcable: false,
                    width: '15%'
                },
            ]
        })
    </script>
@endpush
