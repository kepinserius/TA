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
    </style>
</head>
<body>
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <!-- Alamat Pengiriman -->
                    <div class="mb-6" data-aos="fade-right" data-aos-duration="800">
                        <h3 class="section-title">Alamat Pengiriman</h3>
                        <div class="address-card">
                            <p class="font-semibold text-gray-800">Kevin Gans</p>
                            <p class="text-gray-600 mt-2">Jl. Raya Candi Blok 6A RT 1 RW 6, Kota Malang</p>
                            <button class="btn-secondary mt-4 flex items-center group">
                                <i class="fas fa-map-marker-alt mr-2 group-hover:animate-bounce"></i> Ganti Alamat
                            </button>
                        </div>
                    </div>

                    <!-- Ringkasan Pesanan -->
                    <div class="mb-6" data-aos="fade-right" data-aos-duration="800" data-aos-delay="100">
                        <h3 class="section-title">Pesanan</h3>
                        <div class="product-row flex items-center gap-4">
                            <div class="product-img w-16 h-16 rounded overflow-hidden">
                                <img src="https://via.placeholder.com/80" alt="Produk" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">Jam Tangan Custom Velg Volk</p>
                                <p class="text-gray-600">1 x Rp115.000</p>
                            </div>
                        </div>
                    </div>

                    <!-- Opsi Pengiriman -->
                    <div class="mb-6" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
                        <h3 class="section-title">Pengiriman</h3>
                        <select class="form-select">
                            <option>Ekonomi (Rp15.000) - Estimasi 17-19 Feb</option>
                            <option>Reguler (Rp25.000) - Estimasi 15-17 Feb</option>
                        </select>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="mb-6" data-aos="fade-right" data-aos-duration="800" data-aos-delay="300">
                        <h3 class="section-title">Metode Pembayaran</h3>
                        <div class="payment-option selected mb-3">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" checked class="accent-[#FF7F27]">
                                <span class="font-semibold flex items-center">
                                    <i class="fas fa-money-bill-wave text-green-500 mr-2"></i>
                                    Bayar di Tempat (COD)
                                </span>
                            </label>
                        </div>
                        <div class="payment-option mb-3">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" class="accent-[#FF7F27]">
                                <span class="font-semibold flex items-center">
                                    <i class="fas fa-credit-card text-blue-500 mr-2"></i>
                                    Transfer Bank
                                </span>
                            </label>
                        </div>
                        <div class="payment-option">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" class="accent-[#FF7F27]">
                                <span class="font-semibold flex items-center">
                                    <i class="fas fa-wallet text-purple-500 mr-2"></i>
                                    E-Wallet
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan Pembayaran -->
                <div class="bg-gray-50 p-6 rounded-lg" data-aos="fade-left" data-aos-duration="800">
                    <h3 class="section-title">Ringkasan Pembayaran</h3>
                    <div class="summary-item">
                        <p>Total Harga</p>
                        <p>Rp115.000</p>
                    </div>
                    <div class="summary-item">
                        <p>Ongkos Kirim</p>
                        <p>Rp15.000</p>
                    </div>
                    <div class="summary-total">
                        <p>Total Tagihan</p>
                        <p class="animate__animated animate__pulse animate__infinite animate__slow">Rp130.000</p>
                    </div>

                    <!-- Tombol Konfirmasi -->
                    <button class="w-full btn-primary mt-8 group animate__animated animate__pulse animate__infinite animate__slow">
                        <i class="fas fa-check-circle mr-2 group-hover:animate-bounce"></i> Konfirmasi Pesanan
                    </button>
                    
                    <div class="mt-6 text-xs text-gray-500 text-center">
                        <p>Dengan menekan tombol di atas, Anda menyetujui</p>
                        <a href="#" class="text-[#FF7F27] hover:underline">Syarat dan Ketentuan</a> kami
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            duration: 800,
        });
        
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
