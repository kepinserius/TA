<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Etalase UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            overflow-x: hidden;
        }
        
        .navbar-custom {
            background-color: #FF7F27;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
        }
        
        .checkout-card {
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .checkout-card:hover {
            box-shadow: 0 15px 30px rgba(255,127,39,0.1);
            transform: translateY(-5px);
        }
        
        .section-title {
            position: relative;
            font-weight: 600;
            color: #333;
            margin-bottom: 1.2rem;
            padding-bottom: 0.7rem;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            width: 40px;
            height: 3px;
            background-color: #FF7F27;
            bottom: 0;
            left: 0;
            transition: width 0.5s ease;
        }
        
        .section-title:hover:after {
            width: 100px;
        }
        
        .btn-primary {
            background-color: #FF7F27;
            color: white;
            border-radius: 8px;
            font-weight: 500;
            padding: 12px 24px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-primary::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 0;
            left: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.1);
            transition: height 0.3s ease;
            z-index: -1;
        }
        
        .btn-primary:hover {
            background-color: #E66C1E;
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(255,127,39,0.3);
        }
        
        .btn-primary:hover::after {
            height: 100%;
        }
        
        .btn-secondary {
            background-color: #f0f0f0;
            color: #333;
            border-radius: 8px;
            padding: 8px 16px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .btn-secondary:hover {
            background-color: #e0e0e0;
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        
        .address-card {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .address-card:hover {
            border-color: #FF7F27;
            box-shadow: 0 5px 15px rgba(255,127,39,0.1);
            transform: translateY(-3px);
        }
        
        .address-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 0;
            background-color: #FF7F27;
            transition: height 0.3s ease;
        }
        
        .address-card:hover::before {
            height: 100%;
        }
        
        .product-row {
            transition: all 0.3s ease;
            border-bottom: 1px solid transparent;
            padding: 1rem 0;
        }
        
        .product-row:hover {
            background-color: rgba(255, 127, 39, 0.05);
            border-bottom-color: #FFE0C4;
            transform: translateX(5px);
        }
        
        .product-img {
            transition: all 0.3s ease;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .product-row:hover .product-img {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            width: 100%;
            transition: all 0.3s ease;
            background-color: white;
        }
        
        .form-select:focus {
            border-color: #FF7F27;
            box-shadow: 0 0 0 3px rgba(255,127,39,0.1);
            outline: none;
        }
        
        .form-select:hover {
            border-color: #FFB27F;
        }
        
        .payment-option {
            transition: all 0.3s ease;
            padding: 1rem;
            border-radius: 8px;
            border: 2px solid #eee;
            cursor: pointer;
        }
        
        .payment-option:hover {
            background-color: rgba(255,127,39,0.05);
            border-color: #FF7F27;
            transform: translateY(-3px);
        }
        
        .payment-option.selected {
            border-color: #FF7F27;
            background-color: rgba(255,127,39,0.05);
        }
        
        .payment-option input {
            accent-color: #FF7F27;
            transform: scale(1.2);
            transition: all 0.3s ease;
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            transition: all 0.3s ease;
        }
        
        .summary-item:hover {
            transform: translateX(5px);
            color: #FF7F27;
        }
        
        .summary-total {
            border-top: 2px dashed #eee;
            margin-top: 10px;
            padding-top: 10px;
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            font-size: 1.1rem;
            color: #FF7F27;
        }
        
        .breadcrumb {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            font-size: 0.9rem;
            color: #666;
        }
        
        .breadcrumb a {
            color: #FF7F27;
            margin: 0 0.5rem;
            transition: all 0.3s;
        }
        
        .breadcrumb a:hover {
            color: #E66C1E;
            text-decoration: underline;
        }
        
        /* Loading animation */
        .loading-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            z-index: 10000;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #FF7F27;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Progress steps */
        .checkout-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
        }
        
        .checkout-steps::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #eee;
            z-index: 0;
        }
        
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1;
        }
        
        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #eee;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .step.active .step-number {
            background-color: #FF7F27;
            color: white;
            box-shadow: 0 0 15px rgba(255,127,39,0.5);
            transform: scale(1.2);
        }
        
        .step.completed .step-number {
            background-color: #4CAF50;
            color: white;
        }
        
        .step-label {
            font-size: 0.8rem;
            color: #777;
            font-weight: 500;
        }
        
        .step.active .step-label {
            color: #FF7F27;
            font-weight: 600;
        }
        #map {
            height: 400px;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css" integrity="sha512-riZwnB8ebhwOVAUlYoILfran/fH0deyunXyJZ+yJGDyU0Y8gsDGtPHn1eh276aNADKgFERecHecJgkzcE9J3Lg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body x-data="modalMap()">
    <!-- Loading animation -->
    <div class="loading-animation" id="loadingAnimation">
        <div class="loading-spinner"></div>
    </div>
    
    <!-- Navbar -->
    <nav class="navbar-custom p-4 text-white sticky top-0 z-50 animate__animated animate__fadeInDown">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-lg font-bold flex items-center">
                <i class="fas fa-store mr-2"></i> Etalase UMKM
            </a>
            <div class="flex items-center space-x-6">
                <a href="/" class="hover:text-gray-200 transition-colors flex items-center group">
                    <i class="fas fa-home mr-1 group-hover:animate-bounce"></i> Beranda
                </a>
                <a href="/cart" class="hover:text-gray-200 transition-colors flex items-center group">
                    <i class="fas fa-shopping-cart mr-1 group-hover:animate-bounce"></i> Keranjang
                </a>
                <a href="/profile" class="hover:text-gray-200 transition-colors flex items-center group">
                    <i class="fas fa-user mr-1 group-hover:animate-bounce"></i> Profil
                </a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-6">
        <!-- Breadcrumb -->
        <div class="breadcrumb animate__animated animate__fadeIn">
            <a href="/">
                <i class="fas fa-home"></i>
            </a>
            <i class="fas fa-chevron-right text-xs mx-2"></i>
            <a href="/cart">Keranjang</a>
            <i class="fas fa-chevron-right text-xs mx-2"></i>
            <span class="text-gray-600">Checkout</span>
        </div>
        
        <!-- Checkout Steps -->
        <div class="checkout-steps animate__animated animate__fadeInDown">
            <div class="step completed">
                <div class="step-number">
                    <i class="fas fa-check"></i>
                </div>
                <div class="step-label">Keranjang</div>
            </div>
            <div class="step active">
                <div class="step-number">2</div>
                <div class="step-label">Checkout</div>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-label">Pembayaran</div>
            </div>
            <div class="step">
                <div class="step-number">4</div>
                <div class="step-label">Konfirmasi</div>
            </div>
        </div>
        
        <div class="max-w-4xl mx-auto checkout-card bg-white p-8" data-aos="fade-up" data-aos-duration="800">
            <h2 class="text-2xl font-semibold mb-6 animate__animated animate__fadeInUp">Checkout</h2>
            <form action="/checkout/order" method="post">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <!-- Alamat Pengiriman -->
                        <div class="mb-6" data-aos="fade-right" data-aos-duration="800">
                            <h3 class="section-title">Alamat Pengiriman</h3>
                            <div class="address-card">
                                <p class="font-semibold text-gray-800">{{$user->name}}</p>
                                <p id="view-address" class="text-gray-600 mt-2">{{$user->address}}</p>
                                <input type="text" value="{{$user->lat}}" id="lat" hidden>
                                <input type="text" value="{{$user->lng}}" id="lng" hidden>
                                <button type="button" class="btn-secondary mt-4 flex items-center group" @click="openModal">
                                    <i class="fas fa-map-marker-alt mr-2 group-hover:animate-bounce"></i> Ganti Alamat
                                </button>
                            </div>
                        </div>
    
                        <!-- Ringkasan Pesanan -->
                        <div class="mb-6" data-aos="fade-right" data-aos-duration="800" data-aos-delay="100">
                            <input type="hidden" name="payment" id="inpPayment">
                            <?php $i = 1; ?>
                            @foreach ($data as $items)
                            <input type="hidden" name="splits[{{$items['umkm']['id']}}][umkm]" value="{{$items['umkm']}}">
                            <input type="hidden" name="splits[{{$items['umkm']['id']}}][address]" value="{{$user->address}}" id="inpAddress">
                            <div class="geo">
                                <input type="text" class="lat" value="{{$items['umkm']['lat']}}" hidden>
                                <input type="text" class="lng" value="{{$items['umkm']['lng']}}" hidden>
                                <h3 class="section-title">Pesanan {{$i}}</h3>
                                <div class="row product">
                                    @foreach ($items['items'] as $item => $value)
                                    <input type="hidden" name="splits[{{$items['umkm']['id']}}][items][]"
                                    value="{{json_encode(['id' => $value->product->id, 'qty' => $value->qty, 'price' => $value->product->price])}}"
                                    >
                                    <div class="px-2 product-row w-full flex items-center gap-8">
                                        <div class="product-img w-16 h-16 rounded overflow-hidden">
                                            <img src="{{asset('uploads/products/'.$value->product->image)}}" alt="Produk" class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-800">{{$value->product->product_name}}</p>
                                            <p class="text-gray-600 price" data-price="{{$value->product->price * $value->qty}}">{{$value->qty}} x {{formatRupiah($value->product->price)}}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- Opsi Pengiriman -->
                                <div class="mb-6" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
                                    <h3 class="section-title">Pengiriman</h3>
                                    <select class="form-select shipping_select" name="splits[{{$items['umkm']['id']}}][shipping_option]">
                                        <option value="15000">Ekonomi</option>
                                    </select>
                                </div>
                            </div>
                            <?php $i++?>
                            @endforeach
                        </div>
    
                        <!-- Metode Pembayaran -->
                        <div x-data="{ selectedPayment: false }" class="mb-6" data-aos="fade-right" data-aos-duration="800" data-aos-delay="300">
                            <h3 class="section-title">Metode Pembayaran</h3>
                        
                            <!-- COD -->
                            <div class="payment-option mb-3">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="paymentMethod" onclick="check()" value="cod" @click="selectedPayment = false" x-model="selectedPayment" class="accent-[#FF7F27]" required>
                                    <span class="font-semibold flex items-center">
                                        <i class="fas fa-money-bill-wave text-green-500 mr-2"></i>
                                        Bayar di Tempat (COD)
                                    </span>
                                </label>
                            </div>
                        
                            <!-- E-Wallet -->
                            <div class="payment-option mb-3">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="paymentMethod" onclick="check()" value="ewallet" @click="selectedPayment = true"  x-model="selectedPayment" class="accent-[#FF7F27]" required>
                                    <span class="font-semibold flex items-center">
                                        <i class="fas fa-wallet text-purple-500 mr-2"></i>
                                        E-Wallet
                                    </span>
                                </label>
                        
                                <!-- Dropdown muncul jika ewallet dipilih -->
                                <div x-show="selectedPayment" x-transition class="mt-3 ml-6">
                                    <label for="e_wallet_select" class="block text-sm font-medium mb-1">Pilih E-Wallet:</label>
                                    <select id="e_wallet_select" onchange="ewallet(event)" class="w-full border rounded-lg p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF7F27]">
                                        <option value="">-- Pilih E-Wallet --</option>
                                        <option value="ID_DANA">DANA</option>
                                        <option value="ID_SHOPEEPAY">ShopeePay</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Ringkasan Pembayaran -->
                    <div class="bg-gray-50 p-6 rounded-lg" data-aos="fade-left" data-aos-duration="800">
                        <h3 class="section-title">Ringkasan Pembayaran</h3>
                        <div class="summary-item">
                            <p>Total Harga</p>
                            <p id="totalProduct">Rp115.000</p>
                        </div>
                        <div class="summary-item">
                            <p>Ongkos Kirim</p>
                            <p id="ongkir">Rp15.000</p>
                        </div>
                        <div class="summary-total">
                            <p>Total Tagihan</p>
                            <p class="animate__animated animate__pulse animate__infinite animate__slow" id="total">Rp130.000</p>
                        </div>
    
                        <!-- Tombol Konfirmasi -->
                        <button class="w-full btn-primary mt-8 group animate__animated animate__pulse animate__infinite animate__slow">
                            <i class="fas fa-check-circle mr-2 group-hover:animate-bounce"></i> Konfirmasi Pesanan
                        </button>
                        
                        <div class="mt-6 text-xs text-gray-500 text-center">
                            <p>Dengan menekan tombol di atas, Anda menyetujui</p>
                            <button type="submit" class="text-[#FF7F27] hover:underline">Syarat dan Ketentuan</button> kami
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div x-show="open" x-transition class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div @click.outside="closeModal" class="bg-white rounded-lg shadow-lg w-11/12 md:w-2/3 lg:w-1/2 p-6">
          
          <h2 class="text-2xl font-bold mb-4">Tentukan Alamat</h2>
    
          <!-- Map -->
          <div id="map" class="rounded mb-4"></div>
    
          <!-- Form Alamat -->
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Alamat Rumah</label>
            <input type="text" x-model="address" class="w-full border p-3 rounded focus:ring-2 focus:ring-blue-400" placeholder="Masukkan alamat rumah">
          </div>
    
          <!-- Action Buttons -->
          <div class="flex justify-end space-x-2">
            <button @click="closeModal" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Batal</button>
            <button @click="saveLocation" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Simpan</button>
          </div>
        </div>
      </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>

        const ewallet = (event) => {
            document.getElementById('inpPayment').value = event.target.value
        }

        const check = () => {
            const radio = document.getElementsByName('paymentMethod')
            const inpPayment = document.getElementById('inpPayment')
            radio.forEach(element => {
                if (element.checked) {
                    if (element.value == 'cod') {
                        inpPayment.value = 'cod'
                    }
                    document.getElementById('e_wallet_select').required = true
                }
            });

        }

        const setDistance = async (lat1, lng1, lat2, lng2) => {
            let apiKey = "5b3ce3597851110001cf62483babf501c4a04dc1a1546a31cfa7f743"

            const url = `https://api.openrouteservice.org/v2/directions/driving-car?api_key=${apiKey}&start=${lng1},${lat1}&end=${lng2},${lat2}`

            let total = 0

            try {
                const response = await fetch(url)
                const data = await response.json()
                const distance = data.features[0].properties.summary.distance

                if (distance < 500) {
                    total = 1000
                    return total
                } else {
                    total = 3000

                    const sisa = distance - 500
                    const pembulatan = Math.ceil( sisa / 500 )
                    total = pembulatan * 2000
                    return total
                }
            } catch (error) {
                console.error('error: ', error)
            }
        }

        const setShipping = async () => {
            let totalOngkir = 0 
            const geoElements = document.querySelectorAll('.geo')
            const promises = Array.from(geoElements).map( async (element) => {
                let lat1 = element.querySelector('.lat').value
                let lng1 = element.querySelector('.lng').value
                let lat2 = document.getElementById('lat').value
                let lng2 = document.getElementById('lng').value
                let shipping = element.querySelector('.shipping_select')

                const priceShipping = await setDistance(lat1, lng1, lat2, lng2)

                totalOngkir += parseInt(priceShipping)

                shipping.options[0].text = `Ekonomi (Rp${formatNumber(priceShipping)})`
                shipping.options[0].value = priceShipping

            })
            
            await Promise.all(promises)
            document.getElementById('ongkir').textContent = `Rp${formatNumber(totalOngkir)}`

            return totalOngkir
        }

        setShipping()

        function modalMap() {
            return {
                open: false,
                map: null,
                marker: null,
                latitude: '',
                longitude: '',
                address: '',

                openModal() {
                    this.open = true;
                    this.$nextTick(() => {
                        if (!this.map) {
                            this.initMap();
                        } else {
                            setTimeout(() => {
                                this.map.invalidateSize();
                            }, 300);
                        }
                    });
                },

                closeModal() {
                    this.open = false;
                },

            initMap() {
                this.map = L.map('map').setView([{{$user->lat}}, {{$user->lng}}], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(this.map);

                this.marker = L.marker([{{$user->lat}}, {{$user->lng}}]).addTo(this.map);

                this.map.on('click', (e) => {
                    const lat = e.latlng.lat;
                    const lng = e.latlng.lng;

                    this.latitude = lat.toFixed(6);
                    this.longitude = lng.toFixed(6);

                    if (this.marker) {
                        this.map.removeLayer(this.marker);
                    }
                    this.marker = L.marker([lat, lng]).addTo(this.map);
                });

                setTimeout(() => {
                    this.map.invalidateSize();
                }, 300);
            },

            async saveLocation() {
                if (!this.latitude || !this.longitude || !this.address) {
                    alert('Lengkapi alamat dan pilih lokasi dulu.');
                    return;
                }
                document.getElementById('view-address').textContent = this.address
                document.getElementById('inpAddress').value = this.address
                document.getElementById('lat').value = this.latitude
                document.getElementById('lng').value = this.longitude

                await setTotal()

                this.closeModal();
            }
        }
    }

        // Initialize AOS
        AOS.init({
            once: true,
            duration: 800,
        });
        
        const setTotal = async () => {
            let total = 0

            const totalProduct = totalPrice()
            const totalOngkir = await setShipping()

            total += (totalProduct + totalOngkir)

            document.getElementById('total').textContent = `Rp${formatNumber(total)}`
        }

        
        const totalPrice = () => {
            let total = 0

            document.querySelectorAll('.product').forEach(element => {
                element.querySelectorAll('.product-row').forEach(e => {
                    let price = parseInt(e.querySelector('.price').getAttribute('data-price'))
                    total += price
                })
            });
            document.getElementById('totalProduct').textContent = `Rp${formatNumber(total)}`
            return total
        }
        
        
        totalPrice()
        
        setTotal()

        function formatNumber(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        // Hide loading animation after page load
        window.addEventListener('load', function() {
            setTimeout(function() {
                const loadingAnimation = document.getElementById('loadingAnimation');
                loadingAnimation.style.opacity = '0';
                setTimeout(function() {
                    loadingAnimation.style.display = 'none';
                }, 500);
            }, 800);
        });
        
        // Payment option selection
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function() {
                // Remove selected class from all options
                document.querySelectorAll('.payment-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                
                // Add selected class to clicked option
                this.classList.add('selected');
                
                // Check the radio button
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;
                
                // Add small animation
                this.classList.add('animate__animated', 'animate__pulse');
                setTimeout(() => {
                    this.classList.remove('animate__animated', 'animate__pulse');
                }, 1000);
            });
        });
    </script>
</body>
</html>
