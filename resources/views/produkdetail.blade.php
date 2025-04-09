<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-green-500 p-4 text-white shadow-md">
        <div class="container mx-auto flex justify-between">
            <a href="index.html" class="text-lg font-bold">Etalase UMKM</a>
            <div>
                <a href="cart.html" class="mr-4">Cart</a>
                <a href="profile.html">Profile</a>
            </div>
        </div>
    </nav>

    <!-- Container Utama -->
    <div class="max-w-4xl mx-auto mt-10 bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
            <!-- Foto Produk -->
            <div>
                <img id="product-image" src="{{asset('uploads/products/'.$data->image)}}" class="w-full rounded-lg shadow-md">
            </div>

            <!-- Detail Produk -->
            <div>
                <h2 id="product-name" class="text-2xl font-bold text-gray-800">{{$data->product_name}}</h2>
                <p id="product-price" class="text-green-500 text-xl font-bold mt-2">Rp {{(int) $data->price}}</p>

                <!-- Stok -->
                <p id="product-stock" class="text-gray-600 mt-2">{{$data->stock}} <span class="text-green-600">Tersedia</span></p>

                <!-- Deskripsi -->
                <p id="product-description" class="text-gray-600 mt-4">
                    {{$data->description}}
                </p>

                <!-- Tombol Tambah ke Keranjang -->
                <div class="mt-6 flex space-x-4">
                    <button onclick="addToCart()" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded shadow-md">
                        Tambah ke Keranjang
                    </button>
                    <a href="/cart" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded shadow-md">
                        Lihat Keranjang
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="max-w-4xl mx-auto my-5 bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-1 p-6">
            <!-- Foto Produk -->
            <div>
                <img id="product-image" src="{{asset('uploads/profile_umkm/'.$data->umkm->image)}}" class="w-36 h-36 rounded-full shadow-md">
            </div>

            <!-- Detail Produk -->
            <div>
                <h2 id="product-name" class="text-2xl font-bold text-gray-800">{{$data->umkm->umkm_name}}</h2>
                <p id="product-stock" class="text-gray-600 mt-2">{{$data->umkm->address}}</p>

                <!-- Tombol Tambah ke Keranjang -->
                <div class="mt-6 flex space-x-4">
                    <a href="/merchant/{{$data->umkm->id}}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded shadow-md">
                        Kunjungi Toko
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        // Fungsi Tambah ke Keranjang (Dummy)
        function addToCart() {
            alert(`"${product.name}" telah ditambahkan ke keranjang!`);
        }
    </script>

</body>
</html>
