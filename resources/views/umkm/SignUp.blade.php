<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css" integrity="sha512-riZwnB8ebhwOVAUlYoILfran/fH0deyunXyJZ+yJGDyU0Y8gsDGtPHn1eh276aNADKgFERecHecJgkzcE9J3Lg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .btn-maps {
            background-color: #f0f0f0;
            color: #333;
            border-radius: 8px;
            padding: 8px 16px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .btn-maps:hover {
            background-color: #e0e0e0;
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        #map {
            height: 400px;
        }
    </style>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100 bg-gradient-to-r from-[#42b549] to-[#ffff]" x-data="{ open: false, map: null, marker: null }">
    <div class="content-header">
        <div id="flash-data-success" data-flash-success="{{ Session('success') }}"></div>
        <div id="flash-data-error" data-flash-error="{{ session('error') }}"></div>
    </div>

<div class="w-full max-w-4xl bg-white shadow-lg rounded-lg flex">
    <div class="w-full p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Registrasi Toko</h2>


        <form method="POST" action="">
            @csrf
            <div class="mb-4">
                <label for="umkm_name" class="block text-gray-700">Nama Toko</label>
                <input type="text" id="umkm_name" name="name" class="w-full px-2 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#42b549]" placeholder="Masukkan Nama Toko" required>
            </div>

            <div class="mb-4">
                <label for="umkm_email" class="block text-gray-700">Email Toko</label>
                <input type="email" id="umkm_email" name="email" class="w-full px-2 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#42b549]" placeholder="Masukkan Email Toko" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Virtual Account</label>
                <div class="flex space-x-4">
                    <!-- Select Bank -->
                    <div class="w-1/2">
                        <select name="bank_code" id="bank_channel" class="w-full px-2 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#42b549]" required>
                            <option value="">Pilih Bank</option>
                            <option value="BCA">BCA</option>
                            <option value="BNI">BNI</option>
                            <option value="BRI">BRI</option>
                            <option value="MANDIRI">Mandiri</option>
                            <option value="PERMATA">Permata</option>
                            <option value="SAHABAT_SAMPOERNA">Sahabat Sampoerna</option>
                        </select>
                    </div>
            
                    <!-- Input VA -->
                    <div class="w-1/2">
                        <input type="text" id="va_code" name="va_code" class="w-full px-2 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#42b549]" placeholder="Kode VA" required>
                    </div>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="address" class="block text-gray-700">Alamat Toko</label>
                <div class="flex">
                    <input type="text" id="address" name="address" class="w-full px-2 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#42b549]" placeholder="Masukkan Alamat" required>
                    <input type="text" name="lat" id="latitude" class="w-3/4 border p-3 rounded bg-gray-50 focus:ring-2 focus:ring-green-500" hidden>
                    <input type="text" name="lng" id="longitude" class="w-3/4 border p-3 rounded bg-gray-50 focus:ring-2 focus:ring-green-500" hidden>
                        <button type="button" @click="open = true; $nextTick(() => initMap())" class="btn-maps ml-3 w-1/4">
                            <i class="fas fa-map-marker-alt mr-2 group-hover:animate-bounce"></i>
                            Pilih Titik
                        </button>
                </div>
            </div>

            <div class="mb-4">
                <label for="contact" class="block text-gray-700">Nomor Kontak</label>
                <input type="text" id="contact" name="contact" class="w-full px-2 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#42b549]" placeholder="Masukkan Nomor Kontak" required>
            </div>

            <button type="submit" class="w-full mt-4 bg-[#42b549] text-white py-2 rounded hover:bg-green-600">Sign Up</button>
        </form>
    </div>
</div>

<div 
        x-show="open" 
         x-transition 
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" hidden>
        
        <div @click.outside="open = false" 
             class="bg-white rounded-lg overflow-hidden w-11/12 md:w-2/3 lg:w-1/2 shadow-lg">
            
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-xl font-bold">Pilih Lokasi</h3>
                <button @click="open = false" class="text-gray-600 hover:text-gray-800 text-2xl">&times;</button>
            </div>

            <div class="p-4">
                <div id="map" class="rounded shadow"></div>
            </div>

            <div class="flex justify-end p-4 border-t">
                <button @click="open = false" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    Simpan
                </button>
            </div>
        </div>
    </div>
    
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js" integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/index.js')}}"></script>
    <script>
        function initMap() {
        setTimeout(() => {
            if (!window._leafletMap) {

                window._leafletMap = L.map('map').setView([-7.941978, 112.642178], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: 'Map data © OpenStreetMap contributors',
                }).addTo(window._leafletMap);

                let marker;

                window._leafletMap.on('click', async function(e) {
                    var lat = e.latlng.lat;
                    var lng = e.latlng.lng;

                    if (marker) {
                        window._leafletMap.removeLayer(marker);
                    }

                    marker = L.marker([lat, lng]).addTo(window._leafletMap);

                    window._leafletMap.setView([lat, lng], 16); // Auto center ke klik
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;
                });

                setTimeout(() => {
                    window._leafletMap.invalidateSize();
                }, 300);
            } else {
                setTimeout(() => {
                    window._leafletMap.invalidateSize();
                }, 300);
            }
        }, 100);
    }
    </script>
</body>
</html>
