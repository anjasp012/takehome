@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
    <div class="page-content page-home">
        <section class="store-new-articles">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Kontak</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th style="width: 15%">Alamat</th>
                                    <th style="width: 2%">:</th>
                                    <td>{{ @$kontak->alamat }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 15%">No telp</th>
                                    <th style="width: 2%">:</th>
                                    <td>{{ @$kontak->no_telp }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 15%">Email</th>
                                    <th style="width: 2%">:</th>
                                    <td>{{ @$kontak->email }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 15%">Jam Operasional</th>
                                    <th style="width: 2%">:</th>
                                    <td>{{ @$kontak->jam_operasional }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 15%">Google Map</th>
                                    <th style="width: 2%">:</th>
                                    <td>{{ @$kontak->google_map }}</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
