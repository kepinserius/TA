<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css" integrity="sha512-riZwnB8ebhwOVAUlYoILfran/fH0deyunXyJZ+yJGDyU0Y8gsDGtPHn1eh276aNADKgFERecHecJgkzcE9J3Lg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="flex items-center justify-center h-screen bg-gray-100 bg-gradient-to-r from-[#42b549] to-[#ffff]">
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

<div class="w-full max-w-4xl bg-white shadow-lg rounded-lg flex">
    <div class="w-full p-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Registrasi Toko</h2>


        <form method="POST" action="">
            @csrf
            <div class="mb-4">
                <label for="umkm_name" class="block text-gray-700">Nama Toko</label>
                <input type="text" id="umkm_name" name="name" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#42b549]" placeholder="Masukkan Nama Toko" required>
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea name="description" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#42b549]" id="description" cols="10" rows="5"></textarea>
            </div>
            
            <div class="mb-4">
                <label for="address" class="block text-gray-700">Alamat Toko</label>
                <input type="text" id="address" name="address" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#42b549]" placeholder="Masukkan Alamat" required>
            </div>

            <div class="mb-4">
                <label for="contact" class="block text-gray-700">Nomor Kontak</label>
                <input type="text" id="contact" name="contact" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#42b549]" placeholder="Masukkan Nomor Kontak" required>
            </div>

            <button type="submit" class="w-full mt-4 bg-[#42b549] text-white py-2 rounded hover:bg-green-600">Sign Up</button>
        </form>
    </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js" integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/index.js')}}"></script>
</body>
</html>
