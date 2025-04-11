<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$data->product_name}} - Etalase UMKM</title>
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
            -webkit-backdrop-filter: blur(10px);
        }
        
        .card-custom {
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            background-color: white;
            transition: all 0.5s ease;
        }
        
        .card-custom:hover {
            box-shadow: 0 15px 30px rgba(255,127,39,0.15);
            transform: translateY(-5px);
        }
        
        .btn-primary {
            background-color: #FF7F27;
            color: white;
            border-radius: 8px;
            font-weight: 500;
            padding: 10px 24px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(255,127,39,0.2);
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
            transition: all 0.3s ease;
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
            font-weight: 500;
            padding: 10px 24px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-secondary::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 0;
            left: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            z-index: -1;
        }
        
        .btn-secondary:hover {
            background-color: #e0e0e0;
            transform: translateY(-3px);
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }
        
        .btn-secondary:hover::after {
            height: 100%;
        }
        
        .price-tag {
            color: #FF7F27;
            font-weight: 700;
            font-size: 1.5rem;
            display: inline-block;
            position: relative;
        }
        
        .price-tag::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #FF7F27;
            transition: width 0.5s ease;
        }
        
        .price-tag:hover::after {
            width: 100%;
        }
        
        .store-card {
            border-top: 1px solid #eee;
            margin-top: 2rem;
            padding-top: 2rem;
            transition: all 0.5s ease;
        }
        
        .store-card:hover {
            border-top-color: #FF7F27;
        }
        
        .store-image {
            border: 3px solid #FF7F27;
            transition: all 0.5s ease;
            transform: scale(1);
        }
        
        .store-image:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(255,127,39,0.3);
        }
        
        .product-image {
            border-radius: 12px;
            overflow: hidden;
            position: relative;
        }
        
        .product-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255,127,39,0);
            transition: all 0.5s ease;
            z-index: 1;
        }
        
        .product-image:hover::before {
            background: rgba(255,127,39,0.1);
        }
        
        .product-image img {
            transition: transform 0.8s ease;
        }
        
        .product-image:hover img {
            transform: scale(1.1);
        }
        
        .breadcrumb {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: #666;
            position: relative;
        }
        
        .breadcrumb a {
            color: #FF7F27;
            margin: 0 0.5rem;
            transition: all 0.3s;
            position: relative;
        }
        
        .breadcrumb a::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 1px;
            background-color: #FF7F27;
            transition: width 0.3s ease;
        }
        
        .breadcrumb a:hover {
            color: #E66C1E;
        }
        
        .breadcrumb a:hover::after {
            width: 100%;
        }
        
        .stock-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 500;
            background-color: #e6f7ed;
            color: #00a550;
            transition: all 0.3s ease;
        }
        
        .stock-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 3px 6px rgba(0,165,80,0.2);
        }
        
        .section-title {
            position: relative;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            font-weight: 600;
            font-size: 1.25rem;
            overflow: hidden;
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
        
        /* Scroll progress indicator */
        .scroll-progress-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: rgba(255,255,255,0.1);
            z-index: 9999;
        }
        
        .scroll-progress-bar {
            height: 100%;
            background: #FF7F27;
            width: 0%;
            transition: width 0.1s;
        }
        
        /* Image zoom on click */
        .zoomable {
            cursor: zoom-in;
        }
        
        .zoom-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.8);
            z-index: 9999;
            display: none;
            justify-content: center;
            align-items: center;
            cursor: zoom-out;
        }
        
        .zoom-overlay img {
            max-width: 90%;
            max-height: 90vh;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            animation: zoomIn 0.3s ease forwards;
        }
        
        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        /* Floating label animation */
        .floating-element {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0px);
            }
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
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
        
        /* Highlight text on hover */
        .highlight-text {
            position: relative;
            display: inline-block;
        }
        
        .highlight-text::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 0.2em;
            background-color: rgba(255,127,39,0.2);
            opacity: 0;
            transform: scale(0);
            transform-origin: center;
            transition: opacity 0.3s, transform 0.3s;
        }
        
        .highlight-text:hover::after {
            opacity: 1;
            transform: scale(1);
        }
    </style>
</head>
<body>
    <!-- Loading animation -->
    <div class="loading-animation" id="loadingAnimation">
        <div class="loading-spinner"></div>
    </div>
    
    <!-- Zoom overlay -->
    <div class="zoom-overlay" id="zoomOverlay">
        <img id="zoomedImage" src="" alt="Zoomed image">
    </div>
    
    <!-- Progress bar -->
    <div class="scroll-progress-container">
        <div class="scroll-progress-bar" id="scrollProgressBar"></div>
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

    <!-- Container Utama -->
    <div class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <div class="breadcrumb mb-6 animate__animated animate__fadeIn">
            <a href="/">
                <i class="fas fa-home"></i>
            </a>
            <i class="fas fa-chevron-right text-xs mx-2"></i>
            <a href="/">Produk</a>
            <i class="fas fa-chevron-right text-xs mx-2"></i>
            <span class="text-gray-600">{{$data->product_name}}</span>
        </div>
        
        <div class="card-custom p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Foto Produk -->
                <div class="product-image" data-aos="fade-right" data-aos-duration="1000">
                    <img src="{{asset('uploads/products/'.$data->image)}}" alt="{{$data->product_name}}" class="w-full h-auto rounded-lg zoomable" id="productImage">
                    @if($data->discount > 0)
                    <div class="absolute top-3 right-3 bg-red-500 text-white py-1 px-3 rounded-md animate__animated animate__bounce animate__delay-1s">
                        <span>{{$data->discount}}% OFF</span>
                    </div>
                    @endif
                </div>

                <!-- Detail Produk -->
                <div data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2 animate__animated animate__fadeInDown">{{$data->product_name}}</h1>
                    <p class="text-gray-500 mb-4 animate__animated animate__fadeIn animate__delay-1s">Kategori: <span class="highlight-text">{{$data->category}}</span></p>
                    
                    <div class="flex items-center mb-4">
                        <p class="price-tag mr-4 animate__animated animate__fadeInUp">Rp {{number_format($data->price - ($data->price * ($data->discount / 100)), 0, ',', '.')}}</p>
                        @if($data->discount > 0)
                        <span class="bg-red-100 text-red-700 text-sm py-1 px-2 rounded-md animate__animated animate__fadeIn animate__delay-1s">
                            Diskon {{$data->discount}}%
                        </span>
                        @endif
                    </div>

                    <!-- Stok -->
                    <div class="flex items-center mb-6 animate__animated animate__fadeIn animate__delay-2s">
                        <i class="fas fa-box-open mr-2 text-gray-500"></i>
                        <p class="text-gray-600">Stok: <span class="stock-badge floating-element">{{$data->stock}} Tersedia</span></p>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-8" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                        <h3 class="section-title">Deskripsi Produk</h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{$data->description}}
                        </p>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex flex-wrap gap-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                        <form action="/cart" method="post">
                            @csrf
                            <input type="text" name="id" value="{{$data->id}}" hidden>
                            <button type="submit" class="btn-primary flex items-center group">
                                <i class="fas fa-cart-plus mr-2 group-hover:animate-bounce"></i> Tambah ke Keranjang
                            </button>
                        </form>
                        <a href="/cart" class="btn-secondary flex items-center group">
                            <i class="fas fa-shopping-cart mr-2 group-hover:animate-bounce"></i> Lihat Keranjang
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Merchant Info -->
            <div class="store-card mt-10 pt-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                <h3 class="section-title mb-6">Informasi Toko</h3>
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                    <div class="flex-shrink-0" data-aos="zoom-in" data-aos-duration="800">
                        <img src="{{asset('uploads/profile_umkm/'.$data->umkm->image)}}" class="w-24 h-24 rounded-full shadow-md store-image object-cover">
                    </div>
                    <div class="flex-grow" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{$data->umkm->umkm_name}}</h3>
                        <div class="flex items-start mb-3">
                            <i class="fas fa-map-marker-alt text-gray-500 mt-1 mr-2"></i>
                            <p class="text-gray-600">{{$data->umkm->address}}</p>
                        </div>
                        <a href="/merchant/{{$data->umkm->id}}" class="btn-primary inline-flex items-center group">
                            <i class="fas fa-store mr-2 group-hover:animate-bounce"></i> Kunjungi Toko
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div data-aos="fade-right" data-aos-duration="800">
                    <h3 class="text-lg font-semibold mb-4">Etalase UMKM</h3>
                    <p class="text-gray-400">Platform digital untuk membantu UMKM memasarkan produk mereka dengan mudah dan terjangkau.</p>
                </div>
                <div data-aos="fade-up" data-aos-duration="800">
                    <h3 class="text-lg font-semibold mb-4">Hubungi Kami</h3>
                    <p class="text-gray-400 flex items-center mb-2">
                        <i class="fas fa-envelope mr-2"></i> info@etalaseumkm.com
                    </p>
                    <p class="text-gray-400 flex items-center mb-2">
                        <i class="fas fa-phone mr-2"></i> +62 812 3456 7890
                    </p>
                </div>
                <div data-aos="fade-left" data-aos-duration="800">
                    <h3 class="text-lg font-semibold mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors transform hover:scale-125 transition-all duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors transform hover:scale-125 transition-all duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors transform hover:scale-125 transition-all duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; 2023 Etalase UMKM. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            duration: 800,
        });
        
        // Progress bar
        window.addEventListener('scroll', function() {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            document.getElementById("scrollProgressBar").style.width = scrolled + "%";
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
        
        // Image zoom functionality
        const productImage = document.getElementById('productImage');
        const zoomOverlay = document.getElementById('zoomOverlay');
        const zoomedImage = document.getElementById('zoomedImage');
        
        if (productImage && zoomOverlay && zoomedImage) {
            productImage.addEventListener('click', function() {
                zoomedImage.src = this.src;
                zoomOverlay.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            });
            
            zoomOverlay.addEventListener('click', function() {
                zoomOverlay.style.display = 'none';
                document.body.style.overflow = 'auto';
            });
        }
    </script>
</body>
</html>
