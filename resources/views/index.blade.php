<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etalase UMKM</title>
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
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
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
                <option value="makanan">Makanan</option>
                <option value="minuman">Minuman</option>
                <option value="kerajinan">Kerajinan</option>
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
            @foreach(range(1, 15) as $i)
            <div class="col-md-3 product-item" data-category="{{ ['makanan', 'minuman', 'kerajinan'][rand(0,2)] }}" data-price="{{ rand(10000, 100000) }}">
                <div class="product-card">
                    <a href="/produk/{{ $i }}" class="text-decoration-none text-dark">
                        <img src="{{ asset('images/download.jpg') }}" alt="Produk {{ $i }}">
                        <h5 class="mt-3">Produk {{ $i }}</h5>
                        <p>Rp {{ number_format(rand(10000, 100000), 0, ',', '.') }}</p>
                        <p><small>Kategori: Random</small></p>
                    </a>
                    <button class="btn btn-primary">Add to Cart</button>
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
        @foreach([
            ['id' => 1, 'nama' => 'Bakso Urat Spesial', 'toko' => 'Warung Bakso Jaya', 'diskon' => 30, 'img' => 'https://via.placeholder.com/150'],
            ['id' => 2, 'nama' => 'Kopi Robusta Premium', 'toko' => 'Kedai Kopi Nusantara', 'diskon' => 25, 'img' => 'https://via.placeholder.com/150'],
            ['id' => 3, 'nama' => 'Kerajinan Kayu Unik', 'toko' => 'Handmade Craft', 'diskon' => 15, 'img' => 'https://via.placeholder.com/150'],
            ['id' => 4, 'nama' => 'Teh Hijau Organik', 'toko' => 'Sehat Herbal', 'diskon' => 20, 'img' => 'https://via.placeholder.com/150'],
            ['id' => 5, 'nama' => 'Madu Murni Hutan', 'toko' => 'Madu Sejahtera', 'diskon' => 40, 'img' => 'https://via.placeholder.com/150']
        ] as $promo)
        <div class="col-md-6">
            <div class="card mb-3 p-3 d-flex align-items-center flex-row">
                <div class="flex-grow-1">
                    <h5 class="card-title">{{ $promo['nama'] }}</h5>
                    <p class="text-muted">Toko: {{ $promo['toko'] }}</p>
                    <p class="card-text">Diskon spesial hingga <strong>{{ $promo['diskon'] }}%</strong>!</p>
                    <p><small>Valid until: 2025-02-{{ rand(15, 28) }}</small></p>
                    <a href="/produk/{{ $promo['id'] }}?nama={{ urlencode($promo['nama']) }}&toko={{ urlencode($promo['toko']) }}&diskon={{ $promo['diskon'] }}" class="btn btn-success">Lihat Detail</a>
                </div>
                <img src="{{ asset('images/download.jpg') }}" class="rounded ms-3" width="100" height="100" alt="Produk {{ $promo['id'] }}">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
