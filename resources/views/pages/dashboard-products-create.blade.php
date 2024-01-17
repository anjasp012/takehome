@extends('layouts.dashboard')

@section('title', 'Product Create')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Create New Product</h2>
                <p class="dashboard-subtitle">
                    Create your own product
                </p>
            </div>
            <div class="dashboard-contennt">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('dashboard-product-store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="meta_keyword">Meta Keyword</label>
                                                <input type="text" name="meta_keyword" id="meta_keyword"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="meta_description">Meta Description</label>
                                                <input type="text" name="meta_description" id="meta_description"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Product Name</label>
                                                <input type="text" name="name" id="name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="price">Harga normal</label>
                                                <input type="number" name="price" id="price" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="discon_price">Harga Diskon</label>
                                                <input type="number" name="discon_price" id="discon_price"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="">Kategori</label>
                                                <select name="category_id" class="form-select">
                                                    <option value="" disabled selected>Select Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="thumbnail">Thumbnail</label>
                                                <input type="file" name="thumbnail[]" id="thumbnail" multiple
                                                    class="form-control">
                                                <small class="text-muted">Kamu dapat memilih lebih dari satu file</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="link_youtube">Link Youtube</label>
                                                <input type="text" name="link_youtube" id="link_youtube"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label class="form-label d-block mb-0" for="Ukuran">Jumlah Kamar</label>
                                                <small class="text-muted d-block mb-2">Pilih Jumlah Kamar yang Tersedia</small>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="size_s"
                                                        id="s">
                                                    <label class="form-check-label" for="s">
                                                        1 Kamar Tidur
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="size_m"
                                                        id="m">
                                                    <label class="form-check-label" for="m">
                                                        2 Kamar Tidur
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="size_l"
                                                        id="l">
                                                    <label class="form-check-label" for="l">
                                                        3 kamar Tidur
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="size_xl"
                                                        id="xl">
                                                    <label class="form-check-label" for="xl">
                                                        4 Kamar Tidur
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="size_xxl"
                                                        id="xxl">
                                                    <label class="form-check-label" for="xxl">
                                                        5 Kamar Tidur
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label class="form-label d-block mb-0" for="Ukuran">Kondisi</label>
                                                <small class="text-muted d-block mb-2">Pilih Kondisi Barang</small>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="kondisi"
                                                        id="kondisiBaru" value="baru">
                                                    <label class="form-check-label" for="kondisiBaru">
                                                        Baru
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="kondisi"
                                                        id="kondisiBekas" value="bekas">
                                                    <label class="form-check-label" for="kondisiBekas">
                                                        Bekas
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mt-3">
                                                <div class="form-group" id="spesifikasi">
                                                    <label for="discon_price" class="form-label">Spesifikasi
                                                        Produk</label>
                                                    <div class="row g-3 mb-2">
                                                        <div class="col-6 spesifikasiDiv">
                                                            <input type="text" name="spesifications[0][name]"
                                                                class="form-control" placeholder="spesifikasi">
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="text" name="spesifications[0][description]"
                                                                class="form-control" placeholder="deskripsi">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12"><button class="btn btn-outline-success w-100"
                                                        type="button" onclick="addSpesifikasi()">+ Tambah
                                                        Spesifikasi</button></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mt-3">
                                                <div class="form-group" id="variasi">
                                                    <label for="discon_price" class="form-label">Tipe Unit</label>
                                                    <div class="row g-3 mb-2">
                                                        <div class="col-6">
                                                            <input type="text" name="variations[0][name]"
                                                                class="form-control" placeholder="Nama Variasi">
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="text" name="variations[0][type]"
                                                                class="form-control" placeholder="Pilihan Variasi">
                                                        </div>
                                                        <div class="col-4">
                                                            <input required type="file" name="variations[0][photos]"
                                                                class="form-control">
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="number" name="variations[0][price]"
                                                                class="form-control" placeholder="Harga Variasi">
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="number" name="variations[0][stok]"
                                                                class="form-control" placeholder="Stok">
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="col-12"><button class="btn btn-outline-success w-100"
                                                        type="button" onclick="addVariasi()">+ Tambah
                                                        Variasi</button></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="description">Description</label>
                                                <textarea name="description" id="description"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-success px-5 w-100">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
    <script>
        function addSpesifikasi() {
            let i = $('.spesifikasiDiv').length;
            $('#spesifikasi').append(
                `<div class="row g-3 mb-2 spesifikasiDiv"><div class="col-6"><input type="text" name="spesifications[${i}][name]"class="form-control" placeholder="spesifikasi"/></div><div class="col-6"><input type="text" name="spesifications[${i}][description]" class="form-control" placeholder="deskripsi"></div></div>`
            );
        }

        function addVariasi() {
            let i = $('.variasiDiv').length;
            $('#variasi').append(
                `<div class="form-group mb-3 variasiDiv"><div class="row g-3 mb-2"><div class="col-6"><input type="text" name="variations[${i}][name]" class="form-control" placeholder="Nama Variasi"></div><div class="col-6"><input type="text" name="variations[${i}][type]" class="form-control" placeholder="Pilihan Variasi"></div><div class="col-4"><input required type="file" name="variations[${i}][photos]" class="form-control"></div><div class="col-4"><input type="number" name="variations[${i}][price]" class="form-control" placeholder="Harga Variasi"></div><div class="col-4"><input type="number" name="variations[${i}][stok]" class="form-control" placeholder="Stok"></div><hr></div>`
            );
        }
    </script>
@endpush
