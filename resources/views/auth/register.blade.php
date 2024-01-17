@extends('layouts.auth')

@section('title', 'Sign Up')

@section('content')
    <div class="page-content page-auth" id="register">
        <div class="section-store-auth">
            <div class="container">
                <div class="row align-items-center justify-content-center row-login">
                    <div class="col-lg-4">
                        <h2>Memulai untuk jual beli <br>
                            dengan cara terbaru</h2>
                        <form action="{{ route('register') }}" method="POST" class="mt-3">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="form-label" for="name">Full Name</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" v-model="name" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="phone_number">Nomor Telepon</label>
                                <input id="phone_number" type="text"
                                    class="form-control @error('phone_number') is-invalid @enderror" v-model="phone_number"
                                    name="phone_number" value="{{ old('phone_number') }}" required>

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="email">Email Address</label>
                                <input id="email" type="email" @input="checkForEmailAvailability()"
                                    :class="{ 'is-invalid': this.email_unavailable }"
                                    class="form-control @error('email') is-invalid @enderror" name="email" v-model="email"
                                    value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="password-confirm">Password confirm</label>
                                <input id="password-confirm" type="password"
                                    class="form-control @error('password-confirm') is-invalid @enderror"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                            {{-- <div class="form-group mb-3">
                                <label class="form-label" for="">Store</label>
                                <p class="text-muted">Apakah anda juga ingin membuka toko?</p>
                                <div class="d-flex gap-3">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="is_store_open"
                                            id="openStoreTrue" v-model="is_store_open" :value="true">
                                        <label for="openStoreTrue" class="custom-control-label">
                                            Iya, Boleh
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="is_store_open"
                                            id="openStoreFalse" v-model="is_store_open" :value="false">
                                        <label for="openStoreFalse" class="custom-control-label">
                                            Enggak, Makasih
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3" v-if="is_store_open">
                                <label class="form-label" for="store_name">Nama Toko</label>
                                <input id="store_name" type="text"
                                    class="form-control @error('store_name') is-invalid @enderror" name="store_name"
                                    v-model="store_name" required autocomplete="store_name" autocomplete autofocus>
                                @error('store_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group" v-if="is_store_open">
                                <label class="form-label" for="category_id">Kategori</label>
                                <select name="category_id" class="form-select">
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}
                            <button type="submit" class="btn btn-success w-100 d-block mt-4"
                                :disabled="this.email_unavailable">Sign Up
                                Now</button>
                            <a href="{{ route('login') }}" class="btn btn-signup d-block mt-2">Back to Sign In</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <script>
        Vue.use(Toasted);

        var register = new Vue({
            el: '#register',
            mounted() {
                AOS.init();
            },
            methods: {
                checkForEmailAvailability: function() {
                    var self = this;
                    axios.get('{{ route('api-register-check') }}', {
                            params: {
                                email: this.email,
                            }
                        })
                        .then(function(response) {
                            if (response.data == 'available') {
                                self.$toasted.success(
                                    "Email dapat digunakan silahkan kelangkah selanjutnya !", {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 1000
                                    }
                                );
                                self.email_unavailable = false;
                            } else {
                                self.$toasted.error(
                                    "Email tidak dapat digunakan, silahkan gunakan email lain !", {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 1000
                                    }
                                );
                                self.email_unavailable = true;
                            }
                        });
                }
            },
            data() {
                return {
                    name: "",
                    email: "",
                    phone_number: "",
                    is_store_open: false,
                    store_name: "",
                    email_unavailable: false
                }
            }
            // data: {
            // }
        })
    </script>
@endpush
