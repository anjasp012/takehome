@extends('layouts.dashboard')

@section('title', 'Account Setting')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">My Account</h2>
                <p class="dashboard-subtitle">
                    Make store that profitable
                </p>
            </div>
            <div class="dashboard-contennt">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('dashboard-settings-account-update') }}" id="locations" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="name">Your Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $user->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="yorEmail">Your Email</label>
                                                <input type="text" class="form-control" id="yorEmail" readonly
                                                    value="{{ $user->email }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="address_one">Addres 1</label>
                                                <input type="text" class="form-control" id="address_one"
                                                    name="address_one" value="{{ $user->address_one }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="address_two">Addres 2</label>
                                                <input type="text" class="form-control" id="address_two"
                                                    name="address_two" value="{{ $user->address_two }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="province_id">Province</label>
                                                <select name="province_id" id="province_id" class="form-select"
                                                    v-if="provincies" v-model="province_id">
                                                    <option v-for="province in provincies" :value="province.id">
                                                        @{{ province.name }}
                                                    </option>
                                                </select>
                                                <select v-else class="form-select"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="regency_id">Regency</label>
                                                <select name="regency_id" id="regency_id" class="form-select"
                                                    v-if="provincies" v-model="regency_id">
                                                    <option v-for="regency in regencies" :value="regency.id">
                                                        @{{ regency.name }}
                                                    </option>
                                                </select>
                                                <select v-else class="form-select"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="zip_code">Postal Code</label>
                                                <input type="text" class="form-control" id="zip_code" name="zip_code"
                                                    value="{{ $user->zip_code }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="country">Country</label>
                                                <input type="text" class="form-control" id="country" name="country"
                                                    value="{{ $user->country }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <div class="form-group">
                                                <label class="form-label" for="phone_number">Mobile</label>
                                                <input type="text" class="form-control" id="phone_number"
                                                    name="phone_number" value="{{ $user->phone_number }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mt-3 text-end">
                                            <button type="sumbit" class="btn btn-success px-5">Save Now</button>
                                        </div>
                                    </div>
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
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <script>
        var locations = new Vue({
            el: "#locations",
            mounted() {
                AOS.init();
                this.getProvinciesData();
                this.getRegenciesData();
            },
            data: {
                provincies: null,
                regencies: null,
                province_id: {{ $user->province_id ?? 'null' }},
                regency_id: {{ $user->regency_id ?? 'null' }},
            },
            methods: {
                getProvinciesData() {
                    var self = this;
                    axios.get('{{ route('api-provincies') }}')
                        .then(function(response) {
                            self.provincies = response.data;
                        })
                },
                getRegenciesData() {
                    var self = this;
                    axios.get('{{ url('api/regencies') }}/' + self.province_id)
                        .then(function(response) {
                            self.regencies = response.data;
                        })
                }
            },
            watch: {
                province_id: function(val, oldVal) {
                    this.regency_id = null,
                        this.getRegenciesData();
                }
            }
        });
    </script>
@endpush
