<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Checkout</h2>

        <!-- Alamat Pengiriman -->
        <div class="mb-4 border-b pb-4">
            <h3 class="font-semibold text-lg">Alamat Pengiriman</h3>
            <p class="text-gray-600">Kevin Gans</p>
            <p class="text-gray-600">Jl. Raya Candi Blok 6A RT 1 RW 6, Kota Malang</p>
            <button class="mt-2 text-blue-500">Ganti Alamat</button>
        </div>

        <!-- Ringkasan Pesanan -->
        <div class="mb-4 border-b pb-4">
            <h3 class="font-semibold text-lg">Pesanan</h3>
            <div class="flex items-center gap-4">
                <img src="https://via.placeholder.com/80" alt="Produk" class="w-16 h-16 rounded">
                <div>
                    <p class="font-semibold">Jam Tangan Custom Velg Volk</p>
                    <p class="text-gray-600">1 x Rp115.000</p>
                </div>
            </div>
        </div>

        <!-- Opsi Pengiriman -->
        <div class="mb-4 border-b pb-4">
            <h3 class="font-semibold text-lg">Pengiriman</h3>
            <select class="border p-2 w-full rounded">
                <option>Ekonomi (Rp15.000) - Estimasi 17-19 Feb</option>
                <option>Reguler (Rp25.000) - Estimasi 15-17 Feb</option>
            </select>
        </div>

        <!-- Metode Pembayaran -->
        <div class="mb-4 border-b pb-4">
            <h3 class="font-semibold text-lg">Metode Pembayaran</h3>
            <label class="flex items-center gap-2">
                <input type="radio" checked class="w-5 h-5">
                <span class="font-semibold">Bayar di Tempat (COD)</span>
            </label>
        </div>

        <!-- Ringkasan Pembayaran -->
        <div class="mb-4">
            <h3 class="font-semibold text-lg">Ringkasan Pembayaran</h3>
            <div class="flex justify-between">
                <p>Total Harga</p>
                <p>Rp115.000</p>
            </div>
            <div class="flex justify-between">
                <p>Ongkos Kirim</p>
                <p>Rp15.000</p>
            </div>
            <hr class="my-2">
            <div class="flex justify-between font-semibold">
                <p>Total Tagihan</p>
                <p>Rp130.000</p>
            </div>
        </div>

        <!-- Tombol Konfirmasi -->
        <button class="w-full bg-green-500 text-white py-2 rounded-lg font-semibold">Konfirmasi Pesanan</button>
    </div>
</body>
</html>
