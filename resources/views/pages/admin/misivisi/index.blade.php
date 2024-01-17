@extends('layouts.admin')

@section('title', 'Visi Misi')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Visi Misi</h2>
                <p class="dashboard-subtitle">
                    Visi Misi
                </p>
            </div>
            <div class="dashboard-contennt">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('visimisi.create') }}" class="btn btn-primary mb-3">Tambah/Edit Visi
                                    Misi</a>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover scroll-horizontal-vertical w-100"
                                        id='crudTable'>
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>body</th>
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
                    data: 'description',
                    name: 'description'
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
