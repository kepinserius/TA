<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Etalase UMKM</title>
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
        
        /* Supaya Ringkasan Belanja tetap di posisi saat discroll */
        .sticky-summary {
            position: sticky;
            top: 20px; /* Jarak dari atas */
            max-height: 450px; /* Hindari agar tidak terlalu tinggi */
            overflow-y: auto; /* Jika isi terlalu panjang, bisa discroll sendiri */
            transition: all 0.3s ease;
        }
        
        .header {
            background-color: #FF7F27;
            color: white;
            padding: 15px 0;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            top: -100px;
            left: -100px;
        }
        
        .header::after {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            bottom: -75px;
            right: -75px;
        }
        
        .product-container {
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .product-container:hover {
            box-shadow: 0 10px 30px rgba(255,127,39,0.1);
            transform: translateY(-5px);
        }
        
        .product {
            transition: all 0.3s ease;
            border-bottom: 1px solid transparent;
        }
        
        .product:hover {
            background-color: #fff8f2;
            border-bottom-color: #FFE0C4;
            transform: translateX(5px);
        }
        
        .quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .quantity-control:hover {
            border-color: #FF7F27;
            box-shadow: 0 2px 8px rgba(255,127,39,0.2);
        }
        
        .quantity-btn {
            background-color: #f0f0f0;
            border: none;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
        }
        
        .quantity-btn::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 0;
            left: 0;
            bottom: 0;
            background-color: rgba(255,127,39,0.3);
            transition: height 0.2s ease;
            z-index: 0;
        }
        
        .quantity-btn:hover::before {
            height: 100%;
        }
        
        .quantity-btn:hover {
            background-color: #FF7F27;
            color: white;
        }
        
        .quantity-btn i {
            position: relative;
            z-index: 1;
        }
        
        .quantity {
            width: 40px;
            text-align: center;
            font-weight: 500;
            padding: 0 5px;
            transition: all 0.3s ease;
        }
        
        .checkout-btn {
            background-color: #FF7F27;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(255,127,39,0.2);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .checkout-btn::after {
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
        
        .checkout-btn:hover {
            background-color: #E66C1E;
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(255,127,39,0.3);
        }
        
        .checkout-btn:hover::after {
            height: 100%;
        }
        
        .checkbox-custom {
            width: 18px;
            height: 18px;
            accent-color: #FF7F27;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .checkbox-custom:hover {
            transform: scale(1.2);
        }
        
        .delete-text {
            color: #FF7F27;
            font-weight: 500;
            transition: all 0.2s;
            position: relative;
        }
        
        .delete-text::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #FF7F27;
            transition: width 0.3s ease;
        }
        
        .delete-text:hover {
            color: #E66C1E;
        }
        
        .delete-text:hover::after {
            width: 100%;
        }
        
        .empty-cart {
            padding: 40px 20px;
            text-align: center;
            transition: all 0.5s ease;
        }
        
        .empty-cart i {
            font-size: 4rem;
            color: #d1d5db;
            margin-bottom: 1rem;
            transition: all 0.5s ease;
        }
        
        .empty-cart:hover i {
            color: #FF7F27;
            transform: scale(1.1);
        }
        
        .back-btn {
            display: inline-flex;
            align-items: center;
            color: #FF7F27;
            font-weight: 500;
            transition: all 0.3s;
            position: relative;
        }
        
        .back-btn i {
            transition: transform 0.3s ease;
        }
        
        .back-btn::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -3px;
            left: 0;
            background-color: rgba(255,255,255,0.5);
            transition: width 0.3s ease;
        }
        
        .back-btn:hover i {
            transform: translateX(-5px);
        }
        
        .back-btn:hover::after {
            width: 100%;
        }
        
        .price {
            color: #FF7F27;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .price:hover {
            transform: scale(1.05);
        }
        
        .summary-box {
            border-radius: 12px;
            background-color: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .summary-box:hover {
            box-shadow: 0 15px 30px rgba(255,127,39,0.1);
            transform: translateY(-5px);
        }
        
        .summary-title {
            border-bottom: 2px solid #f3f4f6;
            padding-bottom: 10px;
            margin-bottom: 15px;
            font-weight: 600;
            font-size: 1.2rem;
            position: relative;
        }
        
        .summary-title::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background-color: #FF7F27;
            bottom: -2px;
            left: 0;
            transition: width 0.5s ease;
        }
        
        .summary-box:hover .summary-title::after {
            width: 100px;
        }
        
        .summary-total {
            border-top: 2px solid #f3f4f6;
            margin-top: 10px;
            padding-top: 10px;
            display: flex;
            justify-content: space-between;
            font-size: 1.1rem;
            position: relative;
        }
        
        .total-price {
            font-weight: 700;
            color: #FF7F27;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }
        
        .total-price:hover {
            transform: scale(1.05);
            text-shadow: 0 0 10px rgba(255,127,39,0.3);
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
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Image hover effect */
        .product-image {
            overflow: hidden;
            border-radius: 8px;
        }
        
        .product-image img {
            transition: transform 0.5s ease;
        }
        
        .product:hover .product-image img {
            transform: scale(1.1);
        }
        
        /* Highlight text */
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
            height: 30%;
            background-color: rgba(255,127,39,0.1);
            z-index: -1;
            transform: scale(0);
            transform-origin: bottom;
            transition: transform 0.3s ease;
        }
        
        .highlight-text:hover::after {
            transform: scale(1);
        }
        
        /* Floating labels */
        .floating-label {
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
    </style>
</head>
<body>
    <!-- Loading animation -->
    <div class="loading-animation" id="loadingAnimation">
        <div class="loading-spinner"></div>
    </div>
    
    <!-- Progress bar -->
    <div class="scroll-progress-container">
        <div class="scroll-progress-bar" id="scrollProgressBar"></div>
    </div>
    
    <!-- Header -->
    <div class="header animate__animated animate__fadeIn">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <a href="/" class="back-btn group">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-2 transition-transform"></i> Kembali Belanja
                </a>
                <h1 class="text-xl font-bold animate__animated animate__bounceIn">Keranjang Belanja</h1>
                <div></div> <!-- Spacer for flex alignment -->
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 pb-10">
        <!-- Keranjang -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Daftar Barang -->
            <div class="lg:col-span-2" data-aos="fade-right" data-aos-duration="1000">
                <div class="bg-white p-6 product-container">
                    <form action="/checkout" id="submit" method="post">
                        @csrf
                        <div class="flex items-center justify-between mb-4">
                            <label class="flex items-center font-medium text-gray-800 cursor-pointer group">
                                <input type="checkbox" id="checkAll" class="mr-2 checkbox-custom"> 
                                <span class="highlight-text">Pilih Semua</span>
                            </label>
                            <span class="delete-text cursor-pointer group" id="hapusSemua">
                                <i class="fas fa-trash-alt mr-1 group-hover:animate-bounce"></i> Hapus Semua
                            </span>
                        </div>
                        
                        <div id="product-list" class="space-y-4">
                            <!-- Produk -->
                            @if ($data->items->toArray() == null)
                            <div class="empty-cart animate__animated animate__fadeIn">
                                <i class="fas fa-shopping-cart animate__animated animate__pulse animate__infinite animate__slow"></i>
                                <h3 class="text-xl font-medium text-gray-700 mb-2">Keranjang Belanja Kosong</h3>
                                <p class="text-gray-500 mb-6">Anda belum menambahkan produk ke dalam keranjang</p>
                                <a href="/" class="checkout-btn inline-block animate__animated animate__pulse animate__infinite animate__slow">
                                    <i class="fas fa-shopping-bag mr-2"></i> Mulai Belanja
                                </a>
                            </div>
                            @else
                            @foreach ($data->items as $cartItems)
                            <div class="border-t py-4 flex flex-wrap md:flex-nowrap items-center product" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->index * 100 }}">
                                <input type="checkbox" value="{{$cartItems->id}}" name="check[]" class="mr-4 product-checkbox checkbox-custom">
                                <div class="product-image w-20 h-20 mr-4">
                                    <img src="{{asset('uploads/products/'.$cartItems->product->image)}}" class="w-full h-full object-cover rounded-lg">
                                </div>
                                <div class="flex-1 min-w-0 my-2 md:my-0">
                                    <h3 class="font-semibold text-gray-800 truncate">{{$cartItems->product->product_name}}</h3>
                                    <p class="text-gray-500">
                                        <i class="fas fa-store-alt mr-1"></i>
                                        <span class="highlight-text">{{$cartItems->product->umkm->umkm_name}}</span>
                                    </p>
                                </div>
                                <div class="w-full md:w-auto flex flex-col items-end">
                                    <p class="font-bold price mb-2" data-price="{{$cartItems->product->price - ($cartItems->product->price * ($cartItems->product->discount / 100))}}">
                                        Rp {{number_format($cartItems->product->price - ($cartItems->product->price * ($cartItems->product->discount / 100)), 0, ',', '.')}}
                                    </p>
                                    <div class="quantity-control">
                                        <button type="button" class="quantity-btn decrease" data-id="{{$cartItems->id}}">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <span class="quantity">{{$cartItems->qty}}</span>
                                        <button type="button" class="quantity-btn increase" data-id="{{$cartItems->id}}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Ringkasan Belanja -->
            <div class="summary-box p-6 sticky-summary" data-aos="fade-left" data-aos-duration="1000">
                <h2 class="summary-title">Ringkasan Belanja</h2>
                <div class="space-y-3 mb-6">
                    <p class="flex justify-between text-gray-600">
                        <span>Total Produk</span> 
                        <span id="total-items" class="floating-label">0 item</span>
                    </p>
                    <p class="flex justify-between text-gray-600">
                        <span>Subtotal</span> 
                        <span id="subtotal" class="floating-label">Rp0</span>
                    </p>
                </div>
                <div class="summary-total">
                    <span>Total</span> 
                    <span class="total-price animate__animated animate__pulse animate__infinite animate__slow" id="total-price">Rp0</span>
                </div>
                <button id="btn-submit" class="checkout-btn w-full mt-6 group">
                    <i class="fas fa-shopping-bag mr-2 group-hover:animate-bounce"></i> Checkout
                </button>
            </div>
        </div>
    </div>

    <!-- Script untuk Mengontrol Checkbox dan Perubahan Jumlah -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            duration: 800,
        });
        
        document.getElementById('btn-submit').addEventListener('click', function() {
            document.getElementById('submit').submit();
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
        
        function updateTotalPrice() {
            let total = 0;
            let totalItems = 0;
            document.querySelectorAll(".product").forEach(product => {
                let checkbox = product.querySelector(".product-checkbox");
                if (checkbox.checked) {
                    let quantity = parseInt(product.querySelector(".quantity").textContent);
                    let price = parseInt(product.querySelector(".price").getAttribute("data-price"));
                    total += quantity * price;
                    totalItems += quantity;
                }
            });
            
            // Format the numbers
            document.getElementById("total-price").textContent = `Rp${formatNumber(total)}`;
            document.getElementById("subtotal").textContent = `Rp${formatNumber(total)}`;
            document.getElementById("total-items").textContent = `${totalItems} item`;
            
            // Disable checkout button if no items selected
            document.getElementById("btn-submit").disabled = totalItems === 0;
            document.getElementById("btn-submit").style.opacity = totalItems === 0 ? "0.5" : "1";
            
            // Add animation to the updated elements
            const totalPriceElement = document.getElementById("total-price");
            totalPriceElement.classList.add("animate__animated", "animate__headShake");
            setTimeout(() => {
                totalPriceElement.classList.remove("animate__animated", "animate__headShake");
            }, 1000);
        }
        
        function formatNumber(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        function checkIfEmpty() {
            if (document.querySelectorAll(".product").length === 0) {
                document.getElementById("checkAll").checked = false;
                document.getElementById("total-price").textContent = "Rp0";
                document.getElementById("subtotal").textContent = "Rp0";
                document.getElementById("total-items").textContent = "0 item";
                
                // Show empty cart message with animation
                document.getElementById("product-list").innerHTML = `
                <div class="empty-cart animate__animated animate__fadeIn">
                    <i class="fas fa-shopping-cart animate__animated animate__pulse animate__infinite animate__slow"></i>
                    <h3 class="text-xl font-medium text-gray-700 mb-2">Keranjang Belanja Kosong</h3>
                    <p class="text-gray-500 mb-6">Anda belum menambahkan produk ke dalam keranjang</p>
                    <a href="/" class="checkout-btn inline-block animate__animated animate__pulse animate__infinite animate__slow">
                        <i class="fas fa-shopping-bag mr-2"></i> Mulai Belanja
                    </a>
                </div>`;
            }
        }

        document.getElementById("checkAll").addEventListener("change", function () {
            let checkboxes = document.querySelectorAll(".product-checkbox");
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
                // Add animation to parent row
                const productRow = checkbox.closest('.product');
                if (this.checked) {
                    productRow.classList.add('animate__animated', 'animate__pulse');
                    setTimeout(() => {
                        productRow.classList.remove('animate__animated', 'animate__pulse');
                    }, 800);
                }
            });
            updateTotalPrice();
        });

        document.querySelectorAll(".product-checkbox").forEach(checkbox => {
            checkbox.addEventListener("change", function() {
                updateTotalPrice();
                
                // Add animation to parent row
                const productRow = this.closest('.product');
                if (this.checked) {
                    productRow.classList.add('animate__animated', 'animate__pulse');
                    setTimeout(() => {
                        productRow.classList.remove('animate__animated', 'animate__pulse');
                    }, 800);
                }
            });
        });

        document.querySelectorAll(".increase").forEach((button) => {
            button.addEventListener("click", function () {
                let product = button.closest(".product");
                let quantityElement = product.querySelector(".quantity");
                let quantity = parseInt(quantityElement.textContent);
                let dataId = this.getAttribute('data-id');
                quantity++;
                $.ajax({
                    url: `/cart/${dataId}`,
                    type: 'PUT',
                    dataType: 'json',
                    cache: false,
                    data: {
                        'qty': quantity,
                        '_token': "{{csrf_token()}}"
                    },
                });
                quantityElement.textContent = quantity;
                // Add animation to quantity
                quantityElement.classList.add('animate__animated', 'animate__bounceIn');
                setTimeout(() => {
                    quantityElement.classList.remove('animate__animated', 'animate__bounceIn');
                }, 500);
                updateTotalPrice();
            });
        });

        document.querySelectorAll(".decrease").forEach((button) => {
            button.addEventListener("click", function () {
                let product = button.closest(".product");
                let quantityElement = product.querySelector(".quantity");
                let quantity = parseInt(quantityElement.textContent);
                let dataId = this.getAttribute('data-id');
                
                if (quantity > 1) {
                    quantity--;
                    $.ajax({
                        url: `/cart/${dataId}`,
                        type: 'PUT',
                        dataType: 'json',
                        cache: false,
                        data: {
                            'qty': quantity,
                            '_token': "{{csrf_token()}}"
                        },
                    });
                    quantityElement.textContent = quantity;
                    // Add animation to quantity
                    quantityElement.classList.add('animate__animated', 'animate__bounceIn');
                    setTimeout(() => {
                        quantityElement.classList.remove('animate__animated', 'animate__bounceIn');
                    }, 500);
                } else {
                    quantity--;
                    // Add animation before remove
                    product.classList.add('animate__animated', 'animate__fadeOutRight');
                    setTimeout(() => {
                        product.remove();
                        checkIfEmpty();
                    }, 500);
                    
                    $.ajax({
                        url: `/cart/${dataId}`,
                        type: 'PUT',
                        dataType: 'json',
                        cache: false,
                        data: {
                            'qty': quantity,
                            '_token': "{{csrf_token()}}"
                        },
                    });
                }

                updateTotalPrice();
            });
        });

        document.getElementById("hapusSemua").addEventListener("click", function () {
            let checkedItems = document.querySelectorAll(".product-checkbox:checked");
            
            if (checkedItems.length === 0) {
                // Show notification if no item selected
                alert('Silakan pilih produk yang ingin dihapus terlebih dahulu');
                return;
            }
            
            checkedItems.forEach(checkbox => {
                let product = checkbox.closest(".product");
                // Add animation before remove
                product.classList.add('animate__animated', 'animate__fadeOutRight');
            });
            
            setTimeout(() => {
                checkedItems.forEach(checkbox => {
                    checkbox.closest(".product").remove();
                });
                checkIfEmpty();
                updateTotalPrice();
            }, 500);
        });

        // Saat halaman dimuat, checklist otomatis produk yang jumlahnya 1 atau lebih
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".product").forEach(product => {
                let quantity = parseInt(product.querySelector(".quantity").textContent);
                let checkbox = product.querySelector(".product-checkbox");

                if (quantity >= 1) {
                    checkbox.checked = true;
                }
            });

            updateTotalPrice(); // Perbarui total harga setelah checkbox diatur
        });
    </script>
</body>
</html>
