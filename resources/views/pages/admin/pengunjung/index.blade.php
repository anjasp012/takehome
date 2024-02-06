@extends('layouts.admin')

@section('title', 'Pengunjung')

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endpush

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Pengunjung</h2>
                <p class="dashboard-subtitle">
                    List Of Pengunjung
                </p>
            </div>
            <div class="dashboard-contennt">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover scroll-horizontal-vertical w-100"
                                        id='crudTable'>
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>No Wa</th>
                                                <th>No Hp</th>
                                                <th>Email</th>
                                                <th>Produk</th>
                                                <th>Created date</th>
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
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            dom: 'lBfrtip',
            buttons: [{
                extend: 'excel', // Tombol ekspor ke Excel
                attr: {
                    id: 'export',
                    class: 'd-none' // Menambahkan kelas kustom ke tombol
                },
                filename: 'Data pengunjung'
            }],
            ajax: {
                url: '{!! url()->current() !!}',
                data: function(data) {
                    data.from_date = $('#from_date').val();
                    data.to_date = $('#to_date').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'no_wa',
                    name: 'no_wa'
                },
                {
                    data: 'no_hp',
                    name: 'no_hp'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'produk.name',
                    name: 'produk.name'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
            ]
        })

        $('.dataTables_info').css('float', 'left');
        var customInputHtml =
            `<input type="text" id="from_date" class="form-control form-control-sm" style="width:15%;" placeholder="From Date"><input type="text" id="to_date" class="form-control form-control-sm" style="width:15%;" placeholder="To Date"><button class="btn btn-sm btn-dark" id="filterDate">Filter</button><button class="btn btn-sm btn-success" onClick="$('#export').click();">Export Excel</button>`;
        $('.dt-buttons').addClass('d-flex gap-1 mt-3').append(customInputHtml);
        $('.dataTables_filter').addClass('mt-3');
        $('#from_date').flatpickr();
        $('#to_date').flatpickr();

        $('#filterDate').on('click', function() {
            datatable.ajax.reload();
        })
    </script>
@endpush
