<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etalase UMKM</title>
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 70px;
        }
        .navbar-custom {
            background-color: #42b549;
        }
        .navbar-custom .nav-link {
            color: white !important;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
            transition: transform 0.2s ease-in-out;
        }
        .product-card:hover {
            transform: scale(1.05);
        }
        .product-card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand text-white" href="#">Etalase UMKM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="cart">Keranjang</a></li>
                    @if (session()->has('user'))
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-lg-inline">{{session('user')['name']}}</span>
                            <img class="img-profile rounded-circle"
                                style="max-width: 1.8em;"
                                src="img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            @if ($umkm)
                            <a class="dropdown-item" href="umkm/product">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                UMKM
                            </a>
                            @else    
                            <a class="dropdown-item" href="umkm/signup">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                UMKM
                            </a>
                            @endif
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/logout">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                    @else
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Search Bar -->
    <div class="container search-bar mb-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <input type="text" id="searchBox" class="form-control" placeholder="Cari produk..." onkeyup="filterProducts()">
            </div>
        </div>
    </div>

    <!-- Carousel -->
    <div class="container-fluid w-75 mx-auto px-5 mt-4">
        <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('images/download.jpg') }}" class="d-block w-100 rounded-4" alt="Promo 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/download.jpg') }}" class="d-block w-100 rounded-4" alt="Promo 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/download.jpg') }}" class="d-block w-100 rounded-4" alt="Promo 3">
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
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <select id="filterCategory" class="form-select w-25" onchange="filterProducts()">
                <option value="all">Semua Kategori</option>
                @foreach ($category as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>

            <select id="sortPrice" class="form-select w-25" onchange="sortProducts()">
                <option value="default">Urutkan</option>
                <option value="low-high">Harga Terendah</option>
                <option value="high-low">Harga Tertinggi</option>
            </select>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="container mt-4">
        <div class="row" id="productGrid">
            @foreach($product as $i)
            <div class="col-md-3 product-item" data-category="{{ $i->category }}" data-price="{{ $i->price - ($i->price * ($i->discount / 100)) }}">
                <div class="product-card">
                    <a href="/produk/{{ $i->id }}" class="text-decoration-none text-dark">
                        <img style="max-height: 10em;" src="{{ asset('uploads/products/'.$i->image) }}" alt="">
                        <h5 class="mt-3">Produk {{ $i->product_name }}</h5>
                        <p>Rp {{ number_format($i->price - ($i->price * ($i->discount / 100)), 0, ',', '.') }}</p>
                        <p><small>Kategori: {{ $i->category }}</small></p>
                    </a>
                    <form action="/cart" method="post">
                    @csrf
                        <input type="text" name="id" value="{{$i->id}}" hidden>
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Produk Terbaru -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Produk Terbaru</h2>
    <div class="row">
        @foreach(range(1, 4) as $i)
        <div class="col-md-3">
            <div class="product-card">
                <img src="https://via.placeholder.com/200" alt="Produk Baru {{ $i }}">
                <h5 class="mt-3">Produk Baru {{ $i }}</h5>
                <p>Rp {{ number_format(rand(10000, 150000), 0, ',', '.') }}</p>
                <button class="btn btn-primary">Add to Cart</button>
            </div>
        </div>
        @endforeach
    </div>
</div>


   <!-- Ads Section -->
<div class="container mt-4">
    <h2>Promo dan Ads</h2>
    <div class="row">
        @foreach($ads as $promo)
        <div class="col-md-6">
            <div class="card mb-3 p-3 d-flex align-items-center flex-row">
                <div class="flex-grow-1">
                    <h5 class="card-title">{{ $promo->ad_title }}</h5>
                    <p class="text-muted">Toko: {{ $promo->product->umkm->umkm_name }}</p>
                    <p class="card-text">{{$promo->ad_content}}</p>
                    <p><small>Valid until: {{ $promo->end_date }}</small></p>
                    <a href="/produk/{{$promo->product->id}}" class="btn btn-success">Lihat Detail</a>
                </div>
                <img src="{{ asset('uploads/ads/'.$promo->ad_image) }}" class="rounded ms-3" width="100" height="100" alt="Produk {{ $promo['id'] }}">
            </div>
        </div>
        @endforeach
    </div>
</div>


<!-- Footer -->
<footer class="bg-dark text-white mt-5 pt-4">
    <div class="container">
        <div class="row">
            <!-- Informasi Perusahaan -->
            <div class="col-md-3">
                <h5>Tentang Kami</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none">Tentang Etalase UMKM</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Karir</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Syarat & Ketentuan</a></li>
                </ul>
            </div>

            <!-- Bantuan & Layanan -->
            <div class="col-md-3">
                <h5>Bantuan</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none">Pusat Bantuan</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Kontak Kami</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Pengembalian Barang</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Panduan Belanja</a></li>
                </ul>
            </div>

            <!-- Kategori Produk -->
            <div class="col-md-3">
                <h5>Kategori</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white text-decoration-none">Makanan</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Minuman</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Kerajinan</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Fashion</a></li>
                </ul>
            </div>

            <!-- Ikuti Kami & Pembayaran -->
            <div class="col-md-3">
                <h5>Ikuti Kami</h5>
                <div class="d-flex">
                    <a href="#" class="me-3"><img src="https://img.icons8.com/ios-filled/30/ffffff/facebook.png"/></a>
                    <a href="#" class="me-3"><img src="https://img.icons8.com/ios-filled/30/ffffff/instagram-new.png"/></a>
                    <a href="#" class="me-3"><img src="https://img.icons8.com/ios-filled/30/ffffff/twitter.png"/></a>
                    <a href="#"><img src="https://img.icons8.com/ios-filled/30/ffffff/youtube.png"/></a>
                </div>

                <h5 class="mt-3">Metode Pembayaran</h5>
                <div class="d-flex">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5b/Visa_Inc._logo.svg/100px-Visa_Inc._logo.svg.png" class="me-2" width="50">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/MasterCard_Logo.svg/100px-MasterCard_Logo.svg.png" class="me-2" width="50">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/GoPay-logo.svg/100px-GoPay-logo.svg.png" width="50">
                </div>
            </div>
        </div>

        <!-- Hak Cipta -->
        <div class="text-center mt-4 py-3 border-top">
            <p class="mb-0">&copy; 2025 Etalase UMKM. Semua Hak Dilindungi.</p>
        </div>
    </div>
</footer>


    <!-- JavaScript untuk Filter & Sorting -->
    <script>
        function filterProducts() {
            let searchValue = document.getElementById("searchBox").value.toLowerCase();
            let selectedCategory = document.getElementById("filterCategory").value;
            let products = document.querySelectorAll(".product-item");

            products.forEach(product => {
                let productName = product.querySelector("h5").textContent.toLowerCase();
                let productCategory = product.getAttribute("data-category");

                product.style.display = productName.includes(searchValue) && (selectedCategory === "all" || productCategory === selectedCategory) ? "block" : "none";
            });
        }

        function sortProducts() {
            let sortValue = document.getElementById("sortPrice").value;
            let productGrid = document.getElementById("productGrid");
            let products = Array.from(document.querySelectorAll(".product-item"));

            products.sort((a, b) => {
                let priceA = parseInt(a.getAttribute("data-price"));
                let priceB = parseInt(b.getAttribute("data-price"));

                return sortValue === "low-high" ? priceA - priceB :
                       sortValue === "high-low" ? priceB - priceA : 0;
            });

            productGrid.innerHTML = "";
            products.forEach(product => productGrid.appendChild(product));
        }
    </script>
    
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
