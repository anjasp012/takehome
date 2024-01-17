@extends('layouts.admin')

@section('title', 'Create New Category')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Kategori</h2>
                <p class="dashboard-subtitle">
                    Create New Kategori
                </p>
            </div>
            <div class="dashboard-contennt">
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form id="category" action="{{ route('category.store') }}" id="category" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="name" class="form-label">Nama</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    required>
                                            </div>
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
                                            <div class="form-group mb-3">
                                                <label for="photo" class="form-label">Foto</label>
                                                <input type="file" name="photo" id="photo" class="form-control"
                                                    required>
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

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <script>
        var locations = new Vue({
            el: "#category",
            mounted() {
                AOS.init();
                this.getHeaderCategoryData();
                // this.getSubHeaderCategoryData();
                // this.getOngkir();
            },
            data: {
                headerCategories: null,
                subHeaderCategories: null,
                header_category_id: null,
                sub_header_category_id: null,
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
            },
            watch: {
                header_category_id: function(val, oldVal) {
                    this.sub_header_category_id = null,
                        this.getSubHeaderCategoryData();
                },
            }
        });
    </script>
@endpush
