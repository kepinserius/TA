<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="flex flex-col items-center p-6">
            <img id="profile-pic" src="https://via.placeholder.com/100" class="w-24 h-24 rounded-full border-4 border-green-500 shadow-md">
            <h2 class="mt-4 text-xl font-bold text-gray-700" id="name">Nama Anda</h2>
            <p class="text-gray-500" id="email">email@example.com</p>
            <p class="text-gray-500" id="phone">+62 812-3456-7890</p>
            <p class="text-gray-600 mt-2 text-center" id="address">Jl. Contoh No. 123, Jakarta</p>
            <div class="mt-4 flex space-x-4">
                <button onclick="window.location.href='edit-profile.html'"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded shadow-md transition duration-300">
                    Edit Profil
                </button>
                <button onclick="logout()"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded shadow-md transition duration-300">
                    Logout
                </button>
            </div>
        </div>
    </div>

    <script>
        function logout() {
            alert("Anda telah logout.");
            window.location.href = "/login"; // Redirect ke halaman login
        }
    </script>
</body>
</html>
