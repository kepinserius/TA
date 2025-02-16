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
            <img id="previewImage" src="https://via.placeholder.com/150" alt="Foto Profil" class="w-40 h-40 rounded-full border">

            <!-- Input File Tersembunyi -->
            <input type="file" id="fileInput" class="hidden" accept="image/*">

            <!-- Tombol Ubah Foto -->
            <button onclick="document.getElementById('fileInput').click()" class="mt-4 px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
                Ubah Foto
            </button>
        </div>

        <!-- Form Edit Profil di Kanan -->
        <div class="w-2/3 flex flex-col justify-center p-10">
            <h1 class="text-3xl font-bold mb-6">Edit Profil</h1>

            <form action="#" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-600">Nama Lengkap</label>
                    <input type="text" class="w-full border p-3 rounded bg-gray-50 focus:ring-2 focus:ring-green-500" value="John Doe">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-600">Email</label>
                    <input type="email" class="w-full border p-3 rounded bg-gray-50 focus:ring-2 focus:ring-green-500" value="johndoe@email.com">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-600">Nomor HP</label>
                    <input type="text" class="w-full border p-3 rounded bg-gray-50 focus:ring-2 focus:ring-green-500" value="081234567890">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-600">Alamat Pengiriman</label>
                    <textarea class="w-full border p-3 rounded bg-gray-50 focus:ring-2 focus:ring-green-500">Jl. Merdeka No. 123, Jakarta</textarea>
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
