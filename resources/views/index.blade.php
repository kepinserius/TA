<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etalase UMKM</title>
    <link href="{{secure_asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{secure_asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        body {
            padding-top: 70px;
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            overflow-x: hidden;
        }
        .navbar-custom {
            background-color: #FF7F27; /* Warna oranye untuk navbar */
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .navbar-custom .nav-link {
            color: white !important;
            font-weight: 500;
            padding: 0.7rem 1rem;
            transition: all 0.3s ease;
            position: relative;
        }
        .navbar-custom .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: white;
            transform: translateX(-50%);
            transition: width 0.3s ease;
        }
        .navbar-custom .nav-link:hover::after {
            width: 70%;
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: 1px;
        }
        .product-card {
            border: none;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 25px;
            text-align: center;
            transition: all 0.3s ease;
            background-color: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }
        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 0;
            background: linear-gradient(135deg, rgba(255,127,39,0.1) 0%, rgba(255,127,39,0.05) 100%);
            transition: height 0.3s ease;
        }
        .product-card:hover::before {
            height: 100%;
        }
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(255,127,39,0.2);
        }
        .product-card img {
            max-width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
            transition: transform 0.5s ease;
        }
        .product-card:hover img {
            transform: scale(1.05);
        }
        .product-card h5 {
            font-weight: 600;
            margin-top: 1rem;
            font-size: 1.1rem;
            color: #333;
        }
        .product-card p {
            color: #FF7F27;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        .product-card p small {
            font-size: 0.8rem;
            color: #777;
            font-weight: normal;
        }
        .footer {
            background-color: #333;
            color: white;
            padding: 30px 0;
            margin-top: 60px;
            position: relative;
        }
        .footer::before {
            content: '';
            position: absolute;
            top: -50px;
            left: 0;
            width: 100%;
            height: 50px;
            background: linear-gradient(to top, rgba(51,51,51,0.1), transparent);
        }
        .btn-primary {
            background-color: #FF7F27;
            border-color: #FF7F27;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s;
            position: relative;
            z-index: 1;
            overflow: hidden;
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
            border-color: #E66C1E;
            transform: translateY(-3px);
            box-shadow: 0 7px 15px rgba(255,127,39,0.3);
        }
        .btn-primary:hover::after {
            height: 100%;
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            box-shadow: none;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #FF7F27;
            box-shadow: 0 0 0 3px rgba(255,127,39,0.1);
            transform: translateY(-2px);
        }
        .search-bar {
            margin-top: 20px;
        }
        .search-bar .form-control {
            border-radius: 50px;
            padding: 12px 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .search-bar .input-group {
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        .search-bar .input-group:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .carousel {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.5s ease;
        }
        .carousel:hover {
            box-shadow: 0 10px 30px rgba(255,127,39,0.2);
            transform: translateY(-5px);
        }
        .carousel-item img {
            height: 300px;
            object-fit: cover;
            transition: transform 4s ease;
        }
        .carousel:hover .carousel-item img {
            transform: scale(1.05);
        }
        .section-title {
            position: relative;
            margin-bottom: 30px;
            padding-bottom: 15px;
            font-weight: 700;
            color: #333;
        }
        .section-title:after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background-color: #FF7F27;
            bottom: 0;
            left: 0;
            transition: width 0.5s ease;
        }
        .section-title:hover:after {
            width: 100px;
        }
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border-radius: 8px;
            transform-origin: top center;
            animation: dropdown 0.2s ease-out forwards;
        }
        @keyframes dropdown {
            0% {
                opacity: 0;
                transform: translateY(-10px) scale(0.97);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        .dropdown-item {
            padding: 10px 20px;
            transition: all 0.2s;
            position: relative;
        }
        .dropdown-item:before {
            content: "";
            position: absolute;
            width: 3px;
            height: 0;
            background-color: #FF7F27;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            transition: height 0.2s;
        }
        .dropdown-item:hover:before {
            height: 70%;
        }
        .dropdown-item:hover {
            background-color: rgba(255,127,39,0.1);
            padding-left: 25px;
        }
        
        /* Animated background */
        .animated-bg {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            opacity: 0.03;
            background: linear-gradient(45deg, #FF7F27 25%, transparent 25%) -50px 0,
                linear-gradient(135deg, #FF7F27 25%, transparent 25%) -50px 0,
                linear-gradient(45deg, transparent 75%, #FF7F27 75%) -50px 0,
                linear-gradient(135deg, transparent 75%, #FF7F27 75%) -50px 0;
            background-size: 100px 100px;
            animation: bg-animation 50s linear infinite;
        }
        
        /* Scroll indicator bar at the top of page */
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
        
        @keyframes bg-animation {
            0% {
                background-position: 0 0, 0 0, 0 0, 0 0;
            }
            100% {
                background-position: 1000px 1000px, 1000px 1000px, 1000px 1000px, 1000px 1000px;
            }
        }
        
        /* Card animations */
        .product-item {
            transition: all 0.5s;
        }
        
        /* Card hover effect */
        .card-hover-effect {
            transition: all 0.3s ease;
        }
        .card-hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Animations for promo cards */
        .promo-card {
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .promo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        .promo-card img {
            transition: transform 0.5s ease;
        }
        .promo-card:hover img {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="animated-bg"></div>
    <div class="scroll-progress-container">
        <div class="scroll-progress-bar" id="scrollBar"></div>
    </div>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand text-white" href="#" data-aos="fade-right" data-aos-duration="800">
                <i class="fas fa-store me-2"></i> Etalase UMKM
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item" data-aos="fade-down" data-aos-duration="600"><a class="nav-link" href="#"><i class="fas fa-home me-1"></i> Home</a></li>
                    <li class="nav-item" data-aos="fade-down" data-aos-duration="800"><a class="nav-link" href="cart"><i class="fas fa-shopping-cart me-1"></i> Keranjang</a></li>
                    @if (session()->has('user'))
                    <li class="nav-item dropdown no-arrow" data-aos="fade-down" data-aos-duration="1000">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="me-2 d-lg-inline">{{$user == null ? session('user')['username'] : $user->name}}</span>
                            <img class="img-profile rounded-circle"
                                style="max-width: 2em; max-height: 2em; border: 2px solid white;"
                                src="{{secure_asset('img/undraw_profile.svg')}}">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="/profile">
                                <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="/order">
                                <i class="fas fa-tasks fa-sm fa-fw me-2 text-gray-400"></i>
                                Order
                            </a>
                            @if ($umkm)
                            <a class="dropdown-item" href="{{$umkm->status === 'approve' ? 'umkm/product' : 'umkm/status/'.$umkm->status}}">
                                <i class="fas fa-store fa-sm fa-fw me-2 text-gray-400"></i>
                                UMKM
                            </a>
                            @else    
                            <a class="dropdown-item" href="umkm/signup">
                                <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>
                                UMKM
                            </a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/logout">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                    @else
                    <li class="nav-item" data-aos="fade-down" data-aos-duration="1000"><a class="nav-link" href="/login"><i class="fas fa-sign-in-alt me-1"></i> Login</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Search Bar -->
    <div class="container search-bar mb-4" data-aos="fade-up" data-aos-duration="800">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" id="searchBox" class="form-control border-start-0" placeholder="Cari produk..." onkeyup="filterProducts()">
                </div>
            </div>
        </div>
    </div>

    <!-- Carousel -->
    <div class="container w-75 mx-auto px-5 mt-4" data-aos="zoom-in" data-aos-duration="1000">
        <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ secure_asset('images/download.jpg') }}" class="d-block w-100" alt="Promo 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="bg-dark bg-opacity-50 p-2 rounded" data-aos="fade-up" data-aos-delay="300">Promo Spesial</h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ secure_asset('images/download.jpg') }}" class="d-block w-100" alt="Promo 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="bg-dark bg-opacity-50 p-2 rounded" data-aos="fade-up" data-aos-delay="300">Produk Terbaik</h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ secure_asset('images/download.jpg') }}" class="d-block w-100" alt="Promo 3">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="bg-dark bg-opacity-50 p-2 rounded" data-aos="fade-up" data-aos-delay="300">Diskon Besar</h5>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>

    <!-- Filter & Sorting -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6" data-aos="fade-right" data-aos-duration="800">
                <h4 class="section-title">Produk Kami</h4>
            </div>
            <div class="col-md-6" data-aos="fade-left" data-aos-duration="800">
                <div class="d-flex justify-content-end gap-3">
                    <select id="filterCategory" class="form-select" style="max-width: 200px;" onchange="filterProducts()">
                        <option value="all">Semua Kategori</option>
                        @foreach ($category as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>

                    <select id="sortPrice" class="form-select" style="max-width: 200px;" onchange="sortProducts()">
                        <option value="default">Urutkan</option>
                        <option value="low-high">Harga Terendah</option>
                        <option value="high-low">Harga Tertinggi</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="container mt-4">
        <div class="row" id="productGrid">
            @if ($product->toArray() == null)
                <div class="col-md-12 mt-4" data-aos="fade-up" data-aos-duration="800">
                    <div class="alert alert-info text-center py-5">
                        <i class="fas fa-shopping-basket fa-3x mb-3"></i>
                        <h4>Tidak ada produk saat ini</h4>
                        <p class="mb-0">Silakan kembali lagi nanti untuk produk terbaru.</p>
                    </div>
                </div>
            @endif
            @foreach($product as $i)
            <div class="col-md-3 col-sm-6 product-item mb-4" data-category="{{ $i->category }}" data-price="{{ $i->price - ($i->price * ($i->discount / 100)) }}" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->index * 50 }}">
                <div class="product-card">
                    <a href="/produk/{{ $i->id }}" class="text-decoration-none text-dark">
                        <div class="product-img-container">
                            <img src="{{ secure_asset('uploads/products/'.$i->image) }}" alt="{{ $i->product_name }}">
                            @if($i->discount > 0)
                                <div class="position-absolute top-0 end-0 bg-danger text-white py-1 px-2 m-2 rounded-pill">
                                    <small>-{{ $i->discount }}%</small>
                                </div>
                            @endif
                        </div>
                        <h5 class="mt-3">{{ $i->product_name }}</h5>
                        <p class="price">Rp {{ number_format($i->price - ($i->price * ($i->discount / 100)), 0, ',', '.') }}</p>
                        <p><small>Kategori: {{ $i->category }}</small></p>
                    </a>
                    <div class="mt-auto">
                        <form action="/cart" method="post">
                        @csrf
                            <input type="text" name="id" value="{{$i->id}}" hidden>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-cart-plus me-2"></i>Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

   <!-- Ads Section -->
   <div class="container mt-5" data-aos="fade-up" data-aos-duration="1000">
       <h4 class="section-title">Promo dan Penawaran Khusus</h4>
       <div class="row">
           @foreach($ads as $ad)
           <div class="col-md-4 mb-4" data-aos="flip-left" data-aos-duration="800" data-aos-delay="{{ $loop->index * 100 }}">
               <div class="card h-100 border-0 shadow-sm promo-card">
                   <div class="card-body text-center">
                       <img src="{{ secure_asset('images/product.jpg') }}" class="img-fluid rounded mb-3" alt="Promo">
                       <h5 class="card-title">{{ $ad->product->product_name }}</h5>
                       <p class="card-text">{{ $ad->caption }}</p>
                       <a href="/produk/{{ $ad->product->id }}" class="btn btn-outline-primary">Lihat Produk</a>
                   </div>
               </div>
           </div>
           @endforeach
       </div>
   </div>

   <!-- Footer -->
   <footer class="footer mt-5">
       <div class="container">
           <div class="row">
               <div class="col-md-4" data-aos="fade-right" data-aos-duration="800">
                   <h5 class="mb-3">Etalase UMKM</h5>
                   <p>Platform untuk membantu UMKM memasarkan produk mereka dengan mudah dan terjangkau.</p>
               </div>
               <div class="col-md-4" data-aos="fade-up" data-aos-duration="800">
                   <h5 class="mb-3">Kategori</h5>
                   <ul class="list-unstyled">
                       @foreach($category as $cat)
                       <li><a href="#" class="text-decoration-none text-white-50">{{ $cat->name }}</a></li>
                       @endforeach
                   </ul>
               </div>
               <div class="col-md-4" data-aos="fade-left" data-aos-duration="800">
                   <h5 class="mb-3">Hubungi Kami</h5>
                   <ul class="list-unstyled">
                       <li><i class="fas fa-envelope me-2"></i> info@etalaseumkm.com</li>
                       <li><i class="fas fa-phone me-2"></i> +62 812 3456 7890</li>
                       <li><i class="fas fa-map-marker-alt me-2"></i> Jakarta, Indonesia</li>
                   </ul>
               </div>
           </div>
           <hr class="mt-4 mb-4" style="border-color: rgba(255,255,255,0.1);">
           <div class="row">
               <div class="col-12 text-center">
                   <p class="mb-0">&copy; 2023 Etalase UMKM. All rights reserved.</p>
               </div>
           </div>
       </div>
   </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{secure_asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{secure_asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{secure_asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{secure_asset('js/sb-admin-2.min.js')}}"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    
    <script>
        // Initialize AOS animation
        AOS.init({
            once: true, // whether animation should happen only once - while scrolling down
            mirror: false, // whether elements should animate out while scrolling past them
        });
        
        // Scroll bar progress
        window.onscroll = function() {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            document.getElementById("scrollBar").style.width = scrolled + "%";
        };
        
        function filterProducts() {
            const searchQuery = document.getElementById('searchBox').value.toLowerCase();
            const categoryFilter = document.getElementById('filterCategory').value;
            const productItems = document.querySelectorAll('.product-item');
            
            productItems.forEach(item => {
                const productName = item.querySelector('h5').textContent.toLowerCase();
                const productCategory = item.dataset.category;
                
                const matchesSearch = productName.includes(searchQuery);
                const matchesCategory = categoryFilter === 'all' || productCategory === categoryFilter;
                
                if (matchesSearch && matchesCategory) {
                    item.style.display = 'block';
                    // Add a subtle animation when showing items
                    item.style.opacity = 0;
                    setTimeout(() => {
                        item.style.opacity = 1;
                    }, 50);
                } else {
                    item.style.display = 'none';
                }
            });
        }
        
        function sortProducts() {
            const sortOption = document.getElementById('sortPrice').value;
            const productGrid = document.getElementById('productGrid');
            const productItems = Array.from(document.querySelectorAll('.product-item'));
            
            if (sortOption === 'low-high') {
                productItems.sort((a, b) => {
                    return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                });
            } else if (sortOption === 'high-low') {
                productItems.sort((a, b) => {
                    return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                });
            }
            
            // Animate the sorting with opacity transition
            productItems.forEach(item => {
                item.style.opacity = 0;
            });
            
            // Clear and append sorted items
            setTimeout(() => {
                productGrid.innerHTML = '';
                productItems.forEach(item => {
                    productGrid.appendChild(item);
                    setTimeout(() => {
                        item.style.opacity = 1;
                    }, 50);
                });
            }, 200);
        }
    </script>
</body>
</html>
