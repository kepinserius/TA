<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="flex justify-center items-center h-screen w-screen">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-5xl h-full flex flex-col">
            <h1 class="text-2xl font-bold border-b pb-3">Profil Saya</h1>

            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 flex-grow">
                <!-- Foto Profil -->
                <div class="flex flex-col items-center">
                    <img src="https://via.placeholder.com/150" alt="Foto Profil" class="w-36 h-36 rounded-full border">
                </div>

                <!-- Informasi Profile -->
                <div class="flex-1 w-full">
                    <div class="mb-4">
                        <label class="block text-gray-600">Nama Lengkap</label>
                        <input type="text" class="w-full border p-3 rounded bg-gray-50" value="John Doe" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-600">Email</label>
                        <input type="email" class="w-full border p-3 rounded bg-gray-50" value="johndoe@email.com" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-600">Nomor HP</label>
                        <input type="text" class="w-full border p-3 rounded bg-gray-50" value="081234567890" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-600">Alamat Pengiriman</label>
                        <textarea class="w-full border p-3 rounded bg-gray-50" readonly>Jl. Merdeka No. 123, Jakarta</textarea>
                    </div>

                    <div class="flex justify-between">
                        <button class="px-6 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 transition">
                            Logout
                        </button>
                        <a href="/profile/edit" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                            Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
