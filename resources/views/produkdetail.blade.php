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
                <img id="product-image" src="https://via.placeholder.com/300" class="w-full rounded-lg shadow-md">
            </div>

            <!-- Detail Produk -->
            <div>
                <h2 id="product-name" class="text-2xl font-bold text-gray-800">Nama Produk</h2>
                <p id="product-price" class="text-green-500 text-xl font-bold mt-2">Rp0</p>

                <!-- Stok -->
                <p id="product-stock" class="text-gray-600 mt-2">Stok: <span class="text-green-600">Tersedia</span></p>

                <!-- Deskripsi -->
                <p id="product-description" class="text-gray-600 mt-4">
                    Deskripsi produk akan ditampilkan di sini.
                </p>

                <!-- Tombol Tambah ke Keranjang -->
                <div class="mt-6 flex space-x-4">
                    <button onclick="addToCart()" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded shadow-md">
                        Tambah ke Keranjang
                    </button>
                    <a href="cart.html" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded shadow-md">
                        Lihat Keranjang
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        // Data produk dummy (bisa diubah dari URL parameter jika mau dinamis)
        let product = {
            name: "Jam Tangan Custom Velg Volk Rays Nissan",
            price: 115000,
            stock: 10,
            description: "Jam tangan custom dengan desain velg Volk Rays Nissan. Cocok untuk kolektor dan penggemar otomotif.",
            image: "https://via.placeholder.com/300"
        };

        // Load data produk ke halaman
        document.getElementById("product-name").innerText = product.name;
        document.getElementById("product-price").innerText = `Rp${product.price.toLocaleString()}`;
        document.getElementById("product-stock").innerHTML = product.stock > 0
            ? `<span class="text-green-600">${product.stock} tersedia</span>`
            : `<span class="text-red-600">Habis</span>`;
        document.getElementById("product-description").innerText = product.description;
        document.getElementById("product-image").src = product.image;

        // Fungsi Tambah ke Keranjang (Dummy)
        function addToCart() {
            alert(`"${product.name}" telah ditambahkan ke keranjang!`);
        }
    </script>

</body>
</html>
