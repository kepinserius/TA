<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Merchant</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <!-- Profil Merchant -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="flex items-center">
                <img src="{{asset('uploads/profile_umkm/'.$umkm->image)}}" alt="Merchant Logo" class="rounded-full w-20 h-20">
                <div class="ml-4">
                    <h1 class="text-2xl font-bold">{{$umkm->umkm_name}}</h1>
                    <p class="text-gray-500">{{$umkm->address}}</p>
                    <p class="text-gray-600">{{$umkm->description}}</p>
                </div>
            </div>
        </div>

        <!-- Daftar Produk -->
        <h2 class="text-xl font-semibold mb-4">Produk Kami</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($product as $item)
            <div class="bg-white p-4 rounded-lg shadow-md" v-for="product in products">
                <img src="{{asset('uploads/products/'.$item->image)}}" alt="Product Image" class="w-full h-40 object-cover rounded">
                <h3 class="mt-2 font-semibold">{{ $item->product_name }}</h3>
                <p class="text-gray-600">Rp {{ $item->price }}</p>
                <button class="mt-2 bg-green-500 text-white px-4 py-2 rounded"><a href="/produk/{{$item->id}}">Tambahkan Keranjang</a></button>
            </div>
            @endforeach
        </div>
    </div>

    <script>
    </script>
</body>
</html>
