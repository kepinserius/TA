<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen w-screen flex">

    <div class="w-full h-full bg-white flex">
        <!-- Foto Profil di Kiri -->
        <div class="w-1/3 flex flex-col items-center justify-center bg-gray-200 p-6">
            <img id="previewImage" src="{{$data->image ? asset('uploads/profile_umkm/'.$data->image) : asset('img/online-shop_586604.png')}}" alt="Foto Profil" class="w-40 h-40 rounded-full border">

            <!-- Tombol Ubah Foto -->
            <button onclick="document.getElementById('fileInput').click()" class="mt-4 px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
                Ubah Foto
            </button>
        </div>

        <!-- Form Edit Profil di Kanan -->
        <div class="w-2/3 flex flex-col justify-center p-10">
            <h1 class="text-3xl font-bold mb-6">Edit Profil Toko</h1>

            <form action="/umkm/profile/{{$data->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-600">Nama Toko</label>
                    <input name="name" type="text" class="w-full border p-3 rounded bg-gray-50 focus:ring-2 focus:ring-green-500" value="{{$data->umkm_name}}">
                    <input type="file" name="image" id="fileInput" class="hidden" accept="image/*">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-600">Nomor HP</label>
                    <input name="phone" type="text" class="w-full border p-3 rounded bg-gray-50 focus:ring-2 focus:ring-green-500" value="{{$data->contact}}">
                </div>

                
                <div class="mb-4">
                    <label class="block text-gray-600">Alamat Toko</label>
                    <input name="address" type="text" class="w-full border p-3 rounded bg-gray-50 focus:ring-2 focus:ring-green-500" value="{{$data->address}}">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-600">Deskripsi</label>
                    <textarea name="description" class="w-full border p-3 rounded bg-gray-50 focus:ring-2 focus:ring-green-500">{{{$data->description}}}</textarea>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="/profile" class="px-6 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script untuk Preview Foto -->
    <script>
        document.getElementById('fileInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>
</html>
