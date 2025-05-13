<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
<body class="bg-gray-100 h-screen w-screen flex" x-data="{ open: false, map: null, marker: null }">

    <div class="w-full h-full bg-white flex">
        <!-- Foto Profil di Kiri -->
        <div class="w-1/3 flex flex-col items-center justify-center bg-gray-200 p-6">
            <img id="previewImage" src="{{$data->image ? asset('uploads/profile_user/'.$data->image) : asset('img/undraw_profile.svg')}}" alt="Foto Profil" class="w-40 h-40 rounded-full border">

            <!-- Tombol Ubah Foto -->
            <button onclick="document.getElementById('fileInput').click()" class="mt-4 px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
                Ubah Foto
            </button>
        </div>

        <!-- Form Edit Profil di Kanan -->
        <div class="w-2/3 flex flex-col justify-center p-10">
            <h1 class="text-3xl font-bold mb-6">Edit Profil</h1>

            <form action="/profile/{{$data->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-600">Nama Lengkap</label>
                    <input name="name" type="text" class="w-full border p-3 rounded bg-gray-50 focus:ring-2 focus:ring-green-500" value="{{$data->name}}">
                    <input type="file" name="image" id="fileInput" class="hidden" accept="image/*">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-600">Email</label>
                    <input name="email" type="email" class="w-full border p-3 rounded bg-gray-50 focus:ring-2 focus:ring-green-500" value="{{$data->user->email}}">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-600">Nomor HP</label>
                    <input name="phone" type="text" class="w-full border p-3 rounded bg-gray-50 focus:ring-2 focus:ring-green-500" value="{{$data->phone}}">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-600">Alamat Pengiriman</label>
                    <div class="flex">
                        <textarea name="address" class="w-3/4 border p-3 rounded bg-gray-50 focus:ring-2 focus:ring-green-500">{{{$data->address}}}</textarea>
                        <input type="text" name="lat" id="latitude" value="{{{$data->lat}}}" class="w-3/4 border p-3 rounded bg-gray-50 focus:ring-2 focus:ring-green-500" hidden>
                        <input type="text" name="lng" id="longitude" value="{{{$data->lng}}}" class="w-3/4 border p-3 rounded bg-gray-50 focus:ring-2 focus:ring-green-500" hidden>
                        <button type="button" @click="open = true; $nextTick(() => initMap())" class="btn-maps ml-3 w-1/4">
                            <i class="fas fa-map-marker-alt mr-2 group-hover:animate-bounce"></i>
                            Pilih Titik
                        </button>
                    </div>
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

    <div 
        x-show="open" 
         x-transition 
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        
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
    <!-- Script untuk Preview Foto -->
    <script>

        function initMap() {
        setTimeout(() => {
            let valueLatitude = document.getElementById('latitude').value
            let valueLongitude = document.getElementById('longitude').value
            if (!window._leafletMap) {

                if (valueLatitude && valueLongitude) {
                    window._leafletMap = L.map('map').setView([valueLatitude, valueLongitude], 13);
                    L.marker([valueLatitude, valueLongitude]).addTo(window._leafletMap);
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
                }

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
