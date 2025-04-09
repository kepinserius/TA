<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Supaya Ringkasan Belanja tetap di posisi saat discroll */
        .sticky-summary {
    position: sticky;
    top: 20px; /* Jarak dari atas */
    max-height: 300px; /* Hindari agar tidak terlalu tinggi */
    overflow-y: auto; /* Jika isi terlalu panjang, bisa discroll sendiri */
}

    </style>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-6">
        <!-- Keranjang -->
        <div class="mt-6 grid grid-cols-3 gap-4">
            <!-- Daftar Barang -->
            <div class="col-span-2 bg-white p-6 shadow-lg rounded-lg">
                <form action="/checkout" id="submit" method="post">
                    @csrf
                    <div class="flex items-center justify-between">
                        <label class="flex items-center font-bold text-lg">
                            <input type="checkbox" id="checkAll" class="mr-2"> Pilih Semua
                        </label>
                        <span class="text-green-600 cursor-pointer" id="hapusSemua">Hapus Semua</span>
                    </div>
                    
                    <div id="product-list" class="overflow-auto">
                        <!-- Produk 1 -->
                        @if ($data->items->toArray() == null)
                        <div class="border-t py-4 flex items-center product">
                            <p class="text-center w-full">Keranjang Kosong</p>
                    </div>
                    @else
                    @foreach ($data->items as $cartItems)
                    <div class="border-t py-4 flex items-center product">
                        <input type="checkbox" value="{{$cartItems->id}}" name="check[]" class="mr-4 product-checkbox">
                        <img src="{{asset('uploads/products/'.$cartItems->product->image)}}" class="w-16 h-16 rounded mr-4">
                        <div class="flex-1">
                            <h3 class="font-bold">{{$cartItems->product->product_name}}</h3>
                            <p class="text-gray-500">{{$cartItems->product->umkm->umkm_name}}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold item-price" data-price="{{$cartItems->product->price * $cartItems->qty}}">{{$cartItems->product->price - ($cartItems->product->price * ($cartItems->product->discount / 100))}}</p>
                            <div class="flex items-center space-x-2">
                                <button type="button" class="bg-gray-300 px-2 py-1 rounded decrease" data-id="{{$cartItems->id}}">-</button>
                                <span class="quantity">{{$cartItems->qty}}</span>
                                <button type="button" class="bg-gray-300 px-2 py-1 rounded increase" data-id="{{$cartItems->id}}">+</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </form>
            </div>
            <!-- Ringkasan Belanja -->
            <div class="bg-white p-6 shadow-lg rounded-lg sticky-summary">
                <h2 class="font-bold text-lg">Ringkasan Belanja</h2>
                <div class="border-t pt-4">
                    <p class="flex justify-between"><span>Total</span> <span class="font-bold" id="total-price">Rp0</span></p>
                </div>
                <button id="btn-submit" class="w-full bg-green-500 hover:bg-green-600 text-white p-3 mt-4 rounded-lg transition duration-200">
                    Beli
                </button>
            </div>
        </div>
    </div>

    <!-- Script untuk Mengontrol Checkbox dan Perubahan Jumlah -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        document.getElementById('btn-submit').addEventListener('click', function() {
            document.getElementById('submit').submit();
        })
        function updateTotalPrice() {
            let total = 0;
            document.querySelectorAll(".product").forEach(product => {
                let checkbox = product.querySelector(".product-checkbox");
                if (checkbox.checked) {
                    let quantity = parseInt(product.querySelector(".quantity").textContent);
                    let price = parseInt(product.querySelector(".item-price").getAttribute("data-price"));
                    total += quantity * price;
                    product.querySelector(".item-price").textContent = `Rp${price.toLocaleString()}`;
                }
            });
            document.getElementById("total-price").textContent = `Rp${total.toLocaleString()}`;
        }

        function checkIfEmpty() {
            if (document.querySelectorAll(".product").length === 0) {
                document.getElementById("checkAll").checked = false;
                document.getElementById("total-price").textContent = "Rp0";
            }
        }

        document.getElementById("checkAll").addEventListener("change", function () {
            let checkboxes = document.querySelectorAll(".product-checkbox");
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateTotalPrice();
        });

        document.querySelectorAll(".product-checkbox").forEach(checkbox => {
            checkbox.addEventListener("change", updateTotalPrice);
        });

        document.querySelectorAll(".increase").forEach((button, index) => {
            button.addEventListener("click", function () {
                let product = button.closest(".product");
                let quantityElement = product.querySelector(".quantity");
                let quantity = parseInt(quantityElement.textContent);
                let dataId = this.getAttribute('data-id');
                quantity++;
                $.ajax({
                    url: `/cart/${dataId}`,
                    type: 'PUT',
                    dataType: 'json',
                    cache: false,
                    data: {
                        'qty': quantity,
                        '_token': "{{csrf_token()}}"
                    },
                })
                    quantityElement.textContent = quantity;
                    updateTotalPrice();
                });
        });

        document.querySelectorAll(".decrease").forEach((button, index) => {
            button.addEventListener("click", function () {
                let product = button.closest(".product");
                let quantityElement = product.querySelector(".quantity");
                let quantity = parseInt(quantityElement.textContent);
                let dataId = this.getAttribute('data-id');
                
                if (quantity > 1) {
                    quantity--;
                    $.ajax({
                        url: `/cart/${dataId}`,
                        type: 'PUT',
                        dataType: 'json',
                        cache: false,
                        data: {
                            'qty': quantity,
                            '_token': "{{csrf_token()}}"
                        },
                    })
                    quantityElement.textContent = quantity;
                } else {
                    quantity--;
                    product.remove(); // Hapus produk jika jumlah 0
                    $.ajax({
                    url: `/cart/${dataId}`,
                    type: 'PUT',
                    dataType: 'json',
                    cache: false,
                    data: {
                        'qty': quantity,
                        '_token': "{{csrf_token()}}"
                    },
                })
                    checkIfEmpty();
                }

                updateTotalPrice();
            });
        });

        document.getElementById("hapusSemua").addEventListener("click", function () {
            document.getElementById("product-list").innerHTML = "";
            checkIfEmpty();
        });

        updateTotalPrice();

        // Saat halaman dimuat, checklist otomatis produk yang jumlahnya 1 atau lebih
    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".product").forEach(product => {
        let quantity = parseInt(product.querySelector(".quantity").textContent);
        let checkbox = product.querySelector(".product-checkbox");

        if (quantity >= 1) {
            checkbox.checked = true;
        }
    });

    updateTotalPrice(); // Perbarui total harga setelah checkbox diatur
    });
    </script>

</body>
</html>
