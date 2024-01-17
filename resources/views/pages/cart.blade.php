@extends('layouts.app')

@section('title', 'Cart')

@section('content')
    <div class="page-content page-cart">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/">Home</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Cart
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="store-cart">
            {{-- @if (Session::has('kosong'))
                @push('addon-script')
                    <script src="/vendor/vue/vue.js"></script>
                    <script src="https://unpkg.com/vue-toasted"></script>
                    <script>
                        Vue.use(Toasted);
                        Vue.toasted.error(
                            "Keranjang Kosong, Silahkan Pilih Product terlebih dahulu !", {
                                position: "top-center",
                                className: "rounded",
                                duration: 1000
                            }
                        );
                    </script>
                @endpush
            @endif --}}
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart">
                            <thead>
                                <tr>
                                    <td>Image</td>
                                    <td>Name &amp; Seller</td>
                                    <td>Variasi</td>
                                    <td>Size</td>
                                    <td>Price</td>
                                    <td>Menu</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @forelse ($carts as $cart)
                                    <tr>
                                        <td style="width: 15%;">
                                            @if ($cart->product->galleries->count() > 0)
                                                <img src="{{ asset($cart->product->galleries->first()->getPhotos()) }}"
                                                    alt="" class="cart-image">
                                            @endif
                                        </td>
                                        <td style="width: 30%;">
                                            <div class="product-title">{{ $cart->product->name }}</div>
                                            <div class="product-subtitle">
                                                {{ $cart->product->user->store_name ?? ($cart->product->user->name ?? '') }}
                                            </div>
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="product-title">{{ $cart->variation->name }}</div>
                                            <div class="product-subtitle">
                                                Variasi
                                            </div>
                                        </td>
                                        <td style="width: 10%;">
                                            <div class="product-title">{{ $cart->size }}</div>
                                            <div class="product-subtitle">
                                                size
                                            </div>
                                        </td>
                                        <td style="width: 35%;">
                                            @if ($cart->product->discon_price > 0)
                                                <div class="product-title">
                                                    Rp.{{ number_format($cart->variation->price) }}
                                                </div>
                                            @else
                                                <div class="product-title">
                                                    Rp.{{ number_format($cart->variation->price) }}
                                                </div>
                                            @endif
                                            <div class="product-subtitle">IDR</div>
                                        </td>
                                        <td style="width: 20%;">
                                            <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-remove-cart">
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                        if ($cart->product->discon_price > 0) {
                                            $totalPrice += $cart->variation->price;
                                        } else {
                                            $totalPrice += $cart->variation->price;
                                        }
                                    @endphp
                                @empty
                                    <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="200">
                                        Cart is Empty
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12">
                        <h2 class="mb-4">Shipping Details</h2>
                    </div>
                </div>
                <form action="{{ route('checkout') }}" id="locations" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="grand_total_input" name="grand_total">
                    <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="address_one">Alamat 1</label>
                                <input type="text" required class="form-control" id="address_one" name="address_one"
                                    value="{{ auth()->user()->address_one ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="address_two">Alamat 2</label>
                                <input type="text" required class="form-control" id="address_two" name="address_two"
                                    value="{{ auth()->user()->address_two ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="province_id">Provinsi</label>
                                <select name="province_id" id="province_id" class="form-select" v-if="provincies"
                                    v-model="province_id" required>
                                    <option v-for="province in provincies" :value="province.id">@{{ province.name }}
                                    </option>
                                </select>
                                <select v-else class="form-select"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="regency_id">Kota</label>
                                <select name="regency_id" id="regency_id" class="form-select" v-if="provincies"
                                    v-model="regency_id" required>
                                    <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}
                                    </option>
                                </select>
                                <select v-else class="form-select"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="zip_code">Kode Pos</label>
                                <input type="text" required class="form-control" id="zip_code" name="zip_code"
                                    value="{{ auth()->user()->zip_code ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="country">Negara</label>
                                <input type="text" required class="form-control" id="country" name="country"
                                    value="{{ auth()->user()->country ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="phone_number">No Hp</label>
                                <input type="text" required class="form-control" id="phone_number"
                                    name="phone_number" value="{{ auth()->user()->phone_number ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="country">Pilih Kurir</label>
                                <select onchange="kurir(this)" class="form-select" name="courir" id="courir"
                                    required>
                                    <option value="{{ null }}" selected disabled>Pilih Kurir..</option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">POS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="pilihan">Layanan</label>
                                <select onchange="ship(this)" class="form-select" name="courier_cost" id="layanan"
                                    required>
                                    <option value="{{ null }}" selected disabled>Pilih Layanan..</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="150">
                        <div class="col-12">
                            <h2 class="mb-1">Payment Information</h2>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="200">
                        <div class="col-3 col-md-2">
                            <div class="product-title">Rp.0</div>
                            <div class="product-subtitle">Tax</div>
                        </div>
                        <div class="col-3 col-md-2">
                            <div class="product-title" id="sub_total">Rp.{{ number_format($totalPrice) }}</div>
                            <div class="product-subtitle">Sub Total</div>
                        </div>
                        <div class="col-3 col-md-2">
                            <div class="product-title" id="ship_val">-</div>
                            <div class="product-subtitle">Ongkir</div>
                        </div>
                        <div class="col-3 col-md-2">
                            <div class="product-title text-success" id="grand_total">-</div>
                            <div class="product-subtitle">Grand Total</div>
                        </div>
                        <div class="col-12 col-md-4">
                            <button type="submit" class="btn btn-success mt-4 px-4 w-100">
                                CEKOUT SEKARANG
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
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
                // this.getOngkir();
            },
            data: {
                provincies: null,
                regencies: null,
                province_id: {{ auth()->user()->province_id ?? 'null' }},
                regency_id: {{ auth()->user()->regency_id ?? 'null' }},
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
                },
            },
            watch: {
                province_id: function(val, oldVal) {
                    this.regency_id = null,
                        this.getRegenciesData();
                },
            }
        });

        function kurir(e) {
            var regency = $('#regency_id').find(":selected").val();
            var courier = e.value;
            axios.post('api/ongkir', {
                    regency: regency,
                    courier: courier
                })
                .then(function(response) {
                    var title = response.data.name;
                    var $select = $('#layanan');
                    $select.html('<option value="{{ null }}" selected disabled>Pilih Layanan..</option>');
                    $.each(response.data.costs, function(i, val) {
                        $select.append($('<option />', {
                            value: val.cost[0].value,
                            text: title + ' ' + val.service + ' - ' +
                                val.cost[0].value
                        }));
                    });
                });
        }

        function ship(e) {
            // console.log(e.value);
            $('#ship_val').html('Rp.' + e.value);

            $('#grand_total').html('Rp.' + (+e.value + {{ $totalPrice }}));
            $('#grand_total_input').val(+e.value + {{ $totalPrice }});


        }
    </script>
@endpush
