@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Product</h2>
                <p class="dashboard-subtitle">
                    Edit Product
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
                                <form id="product" action="{{ route('product.update', $item->id) }}" method="POST"
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
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="meta_description">Meta Description</label>
                                                <input type="text" name="meta_description" id="meta_description"
                                                    class="form-control" value="{{ $item->meta_description }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="name" class="form-label">Nama Produk</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    value="{{ $item->name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="user_id" class="form-label">Pemilik Produk</label>
                                                <select name="user_id" id="user_id" class="form-select" required>
                                                    <option value="{{ $item->user->id }}" selected>Tidak Diubah</option>
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
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="price" class="form-label">Harga Produk</label>
                                                <input type="number" name="price" id="price" class="form-control"
                                                    value="{{ $item->price }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="discon_price" class="form-label">Harga Diskon</label>
                                                <input type="number" name="discon_price" id="discon_price"
                                                    class="form-control" value="{{ $item->discon_price }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="link_youtube">Link Youtube</label>
                                                <input type="text" name="link_youtube" id="link_youtube"
                                                    class="form-control" value="{{ $item->link_youtube }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label d-block mb-0" for="Ukuran">Jumlah Kamar</label>
                                                <small class="text-muted d-block mb-2">Pilih Jumlah Kamar yang tersedia
                                                    tersedia</small>
                                                <div class="form-check form-check-inline">
                                                    <input {{ $item->size_s ? 'checked' : '' }} class="form-check-input"
                                                        type="checkbox" name="size_s" id="1 Kamar Tidur">
                                                    <label class="form-check-label" for="s">
                                                        1 Kamar Tidur
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input {{ $item->size_m ? 'checked' : '' }} class="form-check-input"
                                                        type="checkbox" name="size_m" id="2 Kamar Tidur">
                                                    <label class="form-check-label" for="m">
                                                        2 Kamar Tidur
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input {{ $item->size_l ? 'checked' : '' }} class="form-check-input"
                                                        type="checkbox" name="size_l" id="3 Kamar Tidur">
                                                    <label class="form-check-label" for="l">
                                                        3 Kamar Tidur
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input {{ $item->size_xl ? 'checked' : '' }} class="form-check-input"
                                                        type="checkbox" name="size_xl" id="4 Kamar Tidur">
                                                    <label class="form-check-label" for="xl">
                                                        4 Kamar Tidur
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input {{ $item->size_xxl ? 'checked' : '' }} class="form-check-input"
                                                        type="checkbox" name="size_xxl" id="5 Kamar Tidur">
                                                    <label class="form-check-label" for="xxl">
                                                        5 Kamar Tidur
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mt-3">
                                                <div class="form-group" id="spesifikasi">
                                                    <div id="spesificationsDelete" class="d-none"></div>
                                                    <label for="discon_price" class="form-label">Spesifikasi
                                                        Produk</label>
                                                    @foreach ($spesifications as $key => $spesification)
                                                        <div class="row g-3 mb-2 spesifikasiDiv"
                                                            id="spesifikasiDiv{{ $key }}">
                                                            <div class="col-4">
                                                                <input type="hidden"
                                                                    name="spesifications[{{ $key }}][id]"
                                                                    value="{{ $spesification->id }}" id="spesifikasi_id">
                                                                <input required type="text"
                                                                    name="spesifications[{{ $key }}][name]"
                                                                    class="form-control" placeholder="spesifikasi"
                                                                    value="{{ $spesification->name }}">
                                                            </div>
                                                            <div class="col-7">
                                                                <input required type="text"
                                                                    name="spesifications[{{ $key }}][description]"
                                                                    class="form-control" placeholder="deskripsi"
                                                                    value="{{ $spesification->description }}">
                                                            </div>
                                                            <div class="col-1"><button type="button"
                                                                    class="btn btn-danger w-100"
                                                                    onclick="deleteSpesifikasi({{ $key }})">⁙</button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="col-12"><button class="btn btn-outline-success w-100"
                                                        type="button" onclick="addSpesifikasi()">+ Tambah
                                                        Spesifikasi</button></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mt-3">
                                                <div class="form-group" id="variasi">
                                                    <div id="variationsDelete" class="d-none"></div>
                                                    <label for="discon_price" class="form-label">Tipe Unit</label>
                                                    @foreach ($variations as $key => $variation)
                                                        <div class="row g-3 mb-2 variasiDiv"
                                                            id="variasiDiv{{ $key }}">
                                                            <div class="col-6">
                                                                <input type="hidden"
                                                                    name="variations[{{ $key }}][id]"
                                                                    value="{{ $variation->id }}" id="variasi_id">
                                                                <input required type="text"
                                                                    name="variations[{{ $key }}][name]"
                                                                    class="form-control" placeholder="Nama Variasi"
                                                                    value="{{ $variation->name }}">
                                                            </div>
                                                            <div class="col-6">
                                                                <input required type="text"
                                                                    name="variations[{{ $key }}][type]"
                                                                    class="form-control" placeholder="Pilihan Variasi"
                                                                    value="{{ $variation->type }}">
                                                            </div>
                                                            <div class="col-4">
                                                                <input type="file"
                                                                    name="variations[{{ $key }}][photos]"
                                                                    class="form-control @error('variations[' . $key . '][photos]') is-invalid @enderror"
                                                                    value="{{ $variation->photos }}">
                                                                @error('variations[' . $key . '][photos]')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                                {{-- @if ($errors->has('variations[' . $key . '][photos]'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    <div class="alert alert-danger">
                                                                        <strong>{{ $errors->first('variations[' . $key . '][photos]') }}</strong>
                                                                    </div>
                                                                @endif --}}
                                                            </div>
                                                            <div class="col-4">
                                                                <input required type="number"
                                                                    name="variations[{{ $key }}][price]"
                                                                    class="form-control" placeholder="Harga Variasi"
                                                                    value="{{ $variation->price }}">
                                                            </div>
                                                            <div class="col-3">
                                                                <input required type="number"
                                                                    name="variations[{{ $key }}][stok]"
                                                                    class="form-control" placeholder="Stok"
                                                                    value="{{ $variation->stok }}">
                                                            </div>
                                                            <div class="col-1">
                                                                <button type="button" class="btn btn-danger w-100"
                                                                    onclick="deleteVariasi({{ $key }})">⁙</button>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="col-12"><button class="btn btn-outline-success w-100"
                                                        type="button" onclick="addVariasi()">+ Tambah
                                                        Variasi</button></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb-3 mt-3">
                                                <label for="description" class="form-label">Deskripsi Produk</label>
                                                <textarea name="description" id="editor1">{!! $item->description !!}</textarea>
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
                this.getSubHeaderCategoryData();
                this.getCategoryData();
                // this.getOngkir();
            },
            data: {
                headerCategories: null,
                subHeaderCategories: null,
                categories: null,
                header_category_id: {{ $item->category->subHeaderCategory->header_category_id }},
                sub_header_category_id: {{ $item->category->sub_header_category_id }},
                category_id: {{ $item->category_id }},
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
                `<div id="spesifikasiDiv${i}" class="row g-3 mb-2 spesifikasiDiv"><div class="col-4"><input required type="hidden" name="spesifications[${i}][id]" class="form-control" placeholder="id"/><input required type="text" name="spesifications[${i}][name]" class="form-control" placeholder="spesifikasi"/></div><div class="col-7"><input required type="text" name="spesifications[${i}][description]" class="form-control" placeholder="deskripsi"></div><div class="col-1"><button type="button" class="btn btn-danger w-100" onclick="deleteSpesifikasi(${i})">⁙</button></div></div>`
            );
        }

        function addVariasi() {
            let i = $('.variasiDiv').length;
            $('#variasi').append(
                `<div id="variasiDiv${i}" class="row g-3 mb-2 variasiDiv"><div class="col-6"><input required type="hidden" name="variations[${i}][id]" class="form-control" placeholder="id"/><input required type="text" name="variations[${i}][name]" class="form-control" placeholder="Nama Variasi"></div><div class="col-6"><input required type="text" name="variations[${i}][type]" class="form-control" placeholder="Pilihan Variasi"></div><div class="col-4"><input type="file" name="variations[${i}][photos]" class="form-control"></div><div class="col-4"><input required type="number" name="variations[${i}][price]" class="form-control" placeholder="Harga Variasi"></div><div class="col-3"><input required type="number" name="variations[${i}][stok]" class="form-control" placeholder="Stok"></div><div class="col-1"><button type="button" class="btn btn-danger w-100" onclick="deleteVariasi(${i})">⁙</button></div></div><hr>`
            );
        }

        function deleteSpesifikasi(i) {
            let d = $('spesificationDelete').length;
            var id = $(`#spesifikasiDiv${i}`).find('#spesifikasi_id').val();
            $('#spesificationsDelete').append(
                `<input name="spesificationDelete[]" value="${id}">`
            )
            $(`#spesifikasiDiv${i}`).remove();
        }

        function deleteVariasi(i) {
            let d = $('variationDelete').length;
            var id = $(`#variasiDiv${i}`).find('#variasi_id').val();
            $('#variationsDelete').append(
                `<input name="variationDelete[]" value="${id}">`
            )
            $(`#variasiDiv${i}`).remove();
        }
    </script>
@endpush
