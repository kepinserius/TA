<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css" integrity="sha512-riZwnB8ebhwOVAUlYoILfran/fH0deyunXyJZ+yJGDyU0Y8gsDGtPHn1eh276aNADKgFERecHecJgkzcE9J3Lg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Profil Toko</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="content-header">
        <div id="flash-data-success" data-flash-success="{{ Session('success') }}"></div>
        <div id="flash-data-error" data-flash-error="{{ session('error') }}"></div>
    </div>

    <div class="flex justify-center items-center h-screen w-screen">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-5xl flex flex-col">
            <h1 class="text-2xl font-bold border-b pb-3">Profil Toko</h1>

            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 flex-grow">
                <!-- Foto Profil -->
                <div class="flex flex-col items-center p-3">
                    <img src="{{$data->image ? asset('uploads/profile_umkm/'.$data->image) : asset('img/online-shop_586604.png')}}" alt="Foto Profil" class="w-36 h-36 rounded-full border">
                </div>

                <!-- Informasi Profile -->
                <div class="flex-1 w-full p-3">
                    <div class="mb-4">
                        <label class="block text-gray-600">Nama Umkm</label>
                        <input type="text" class="w-full border p-3 rounded bg-gray-50" value="{{$data->umkm_name}}" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-600">Email Umkm</label>
                        <input type="email" class="w-full border p-3 rounded bg-gray-50" value="{{$data->umkm_email}}" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">Virtual Account</label>
                        <div class="flex space-x-4">
                            <!-- Select Bank -->
                            <div class="w-1/2">
                                <select name="bank_code" id="bank_channel" class="w-full px-2 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#42b549]" readonly>
                                    <option value="">Pilih Bank</option>
                                    <option value="BCA" {{$data->bank_code == 'BCA' ? 'selected' : ''}}>BCA</option>
                                    <option value="BNI" {{$data->bank_code == 'BNI' ? 'selected' : ''}}>BNI</option>
                                    <option value="BRI" {{$data->bank_code == 'BRI' ? 'selected' : ''}}>BRI</option>
                                    <option value="MANDIRI" {{$data->bank_code == 'MANDIRI' ? 'selected' : ''}}>Mandiri</option>
                                    <option value="PERMATA" {{$data->bank_code == 'PERMATA' ? 'selected' : ''}}>Permata</option>
                                    <option value="SAHABAT_SAMPOERNA" {{$data->bank_code == 'SAHABAT_SAMPOERNA' ? 'selected' : ''}}>Sahabat Sampoerna</option>
                                </select>
                            </div>
                    
                            <!-- Input VA -->
                            <div class="w-1/2">
                                <input type="text" id="va_code" name="va_code" value="{{$data->bank_number}}" class="w-full px-2 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#42b549]" placeholder="Kode VA" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-600">Nomor HP</label>
                        <input type="text" class="w-full border p-3 rounded bg-gray-50" value="{{$data->contact}}" readonly>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-600">Alamat Toko</label>
                        <input type="text" class="w-full border p-3 rounded bg-gray-50" value="{{$data->address}}" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-600">Deskripsi</label>
                        <textarea class="w-full border p-3 rounded bg-gray-50" readonly>{{{$data->description}}}</textarea>
                    </div>

                    <div class="flex justify-between">
                        <a href="/umkm/product" class="px-6 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 transition">
                            Kembali
                        </a>
                        <a href="/umkm/profile/edit" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                            Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js" integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/index.js')}}"></script>
</body>
</html>
