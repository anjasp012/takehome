@extends('layouts.admin')

@section('title', 'Create New Product')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Product</h2>
                <p class="dashboard-subtitle">
                    Create New Product
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
                                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data"
                                    id="product">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="meta_description" class="form-label">Meta Description</label>
                                                <input type="text" name="meta_description" id="meta_description"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="meta_keyword" class="form-label">Meta Keyword</label>
                                                <input type="text" name="meta_keyword" id="meta_keyword"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="name" class="form-label">Nama Produk</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="user_id" class="form-label">Pemilik Produk</label>
                                                <select name="user_id" id="user_id" class="form-select" required>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="header_category_id" class="form-label">Header Kategori</label>
                                                <select name="header_category_id" id="header_category_id"
                                                    class="form-select" v-if="headerCategories" v-model="header_category_id"
                                                    required>
                                                    <option value="null" selected disabled>Pilih ..</option>
                                                    <option v-for="headerCategory in headerCategories"
                                                        :value="headerCategory.id">
                                                        @{{ headerCategory.name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="sub_header_category_id" class="form-label">Sub-Header
                                                    Kategori</label>
                                                <select name="sub_header_category_id" id="sub_header_category_id"
                                                    class="form-select" v-if="subHeaderCategories"
                                                    v-model="sub_header_category_id" required>
                                                    <option value="null" selected disabled>Pilih ..</option>
                                                    <option v-for="subHeaderCategory in subHeaderCategories"
                                                        :value="subHeaderCategory.id">
                                                        @{{ subHeaderCategory.name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label for="category_id" class="form-label">
                                                    Kategori</label>
                                                <select name="category_id" id="category_id" class="form-select"
                                                    v-if="categories" v-model="category_id" required>
                                                    <option value="null" selected disabled>Pilih ..</option>
                                                    <option v-for="category in categories" :value="category.id">
                                                        @{{ category.name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="price" class="form-label">Harga Produk</label>
                                                <input type="number" name="price" id="price" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="discon_price" class="form-label">Harga Diskon</label>
                                                <input type="number" name="discon_price" id="discon_price"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="link_youtube" class="form-label">Link Youtube</label>
                                                <input type="text" name="link_youtube" id="link_youtube"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label d-block mb-0" for="Ukuran">Jumlah Kamar</label>
                                                <small class="text-muted d-block mb-2">Pilih Jumlah Kamar yang
                                                    tersedia</small>
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
                                                        3 Kamar Tidur
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
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
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
                                            <div class="mb-3">
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
                                            <div class="mb-3">
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
                                                            <input type="file" name="variations[0][photos]"
                                                                class="form-control @error('variations[0][photos]') is-invalid @enderror">
                                                            @error('variations[0][photos]')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
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
                                        <div class="col-md-12 ">
                                            <div class="form-group mb-3">
                                                <label for="description" class="form-label">Deskripsi Produk</label>
                                                <textarea name="description" id="editor1"></textarea>
                                            </div>
                                        </div>
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
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <script>
        var locations = new Vue({
            el: "#product",
            mounted() {
                AOS.init();
                this.getHeaderCategoryData();
                // this.getSubHeaderCategoryData();
                // this.getOngkir();
            },
            data: {
                headerCategories: null,
                subHeaderCategories: null,
                categories: null,
                header_category_id: null,
                sub_header_category_id: null,
                category_id: null,
            },
            methods: {
                getHeaderCategoryData() {
                    var self = this;
                    axios.get('{{ route('api-header-categories') }}')
                        .then(function(response) {
                            self.headerCategories = response.data;
                        })
                },
                getSubHeaderCategoryData() {
                    var self = this;
                    axios.get('{{ url('api/sub-header-categories') }}/' + self.header_category_id)
                        .then(function(response) {
                            self.subHeaderCategories = response.data;
                        })
                },
                getCategoryData() {
                    var self = this;
                    axios.get('{{ url('api/categories') }}/' + self.sub_header_category_id)
                        .then(function(response) {
                            self.categories = response.data;
                        })
                },
            },
            watch: {
                header_category_id: function(val, oldVal) {
                    this.sub_header_category_id = null,
                        this.getSubHeaderCategoryData();
                },
                sub_header_category_id: function(val, oldVal) {
                    this.category_id = null,
                        this.getCategoryData();
                },
            }
        });
    </script>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor1');
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
                `<div class="form-group mb-3 variasiDiv"><div class="row g-3 mb-2"><div class="col-6"><input type="text" name="variations[${i}][name]" class="form-control" placeholder="Nama Variasi"></div><div class="col-6"><input type="text" name="variations[${i}][type]" class="form-control" placeholder="Pilihan Variasi"></div><div class="col-4"><input type="file" name="variations[${i}][photos]" class="form-control"></div><div class="col-4"><input type="number" name="variations[${i}][price]" class="form-control" placeholder="Harga Variasi"></div><div class="col-4"><input type="number" name="variations[${i}][stok]" class="form-control" placeholder="Stok"></div><hr></div>`
            );
        }
    </script>
@endpush
