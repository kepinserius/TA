<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <div class="max-w-6xl mx-auto py-10">
        <h2 class="text-xl font-semibold mb-4">Pesanan Saya</h2>
    
        @forelse ($orders as $order)
            <div class="mb-4 border rounded-lg shadow-sm bg-white overflow-hidden">
                <!-- Header -->
                <div class="flex justify-between items-center bg-gray-100 px-4 py-2 text-sm">
                    <div>
                        <span class="font-medium text-gray-700">Status:</span>
                        <span class="text-{{ $order->status === 'delivered' ? 'green' : 'yellow' }}-600">
                            {{ ucfirst(strtolower($order->status)) }}
                        </span>
                    </div>
                    <div class="text-gray-500">
                        {{ $order->created_at->format('d M Y H:i') }}
                    </div>
                </div>
    
                <!-- Toko -->
                <div class="px-4 pt-3">
                    <p class="text-sm text-gray-700 font-semibold">Toko: {{ $order->merchants->umkm_name ?? 'Toko Default' }}</p>
                </div>
    
                <!-- Produk -->
                <div class="divide-y px-4">
                    @foreach($order->orderItems as $item)
                        <div class="flex py-3">
                            <img src="{{ asset('uploads/products/'.$item->orderProducts->image) }}" alt="Product" class="w-14 h-14 object-cover rounded mr-4">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800">{{ $item->orderProducts->product_name }}</p>
                                <p class="text-xs text-gray-500">Qty: {{ $item->qty }}</p>
                            </div>
                            <div class="text-sm text-right text-gray-700">
                                Rp{{ number_format(($item->orderProducts->price - ($item->orderProducts->price * $item->orderProducts->discount)) * $item->qty, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>
    
                <!-- Footer -->
                <div class="px-4 py-3 bg-gray-50 flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        <p>Total Belanja: Rp{{ number_format($order->total, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-400">Termasuk Ongkir</p>
                    </div>
                    <a href="/order/{{$order->id}}" class="text-sm px-4 py-1 rounded bg-orange-500 text-white hover:bg-orange-600">
                        Lihat Detail
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center text-gray-500 mt-10">
                Belum ada pesanan.
            </div>
        @endforelse
    </div>
</body>
</html>