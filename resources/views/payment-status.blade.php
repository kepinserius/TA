<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-2xl">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Status Pembayaran</h2>
    
        <div class="flex items-center space-x-4 mb-6">
            <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M17 9V7a4 4 0 00-8 0v2H5v12h14V9h-2z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Metode Pembayaran</p>
                <p class="font-semibold text-gray-800">E-Wallet ({{ $payment['payment_method'] === 'ID_DANA' ? 'DANA' : 'SHOPEEPAY'}})</p>
            </div>
        </div>
    
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
            <p class="text-sm text-gray-500">ID Pembayaran</p>
            <p class="text-lg font-semibold text-gray-800">{{ formatId($payment['xendit_reference_id']) }}</p>
    
            <p class="text-sm text-gray-500 mt-4">Status</p>
            <span class="inline-block px-3 py-1 mt-1 text-sm font-semibold rounded-full 
                {{ $payment['status'] === 'pending' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'}}"
                >
                {{ ucfirst(strtolower($payment['status'] == 'payment' ? 'PENDING' : 'SUCCEDED')) }}
            </span>
        </div>
    
        <div class="mt-6">
            <p class="text-sm text-gray-500">Total Dibayar</p>
            <p class="text-2xl font-bold text-gray-800">Rp{{ number_format($payment['total'], 0, ',', '.') }}</p>
        </div>
    
        <div class="mt-8 text-center">
            @if ($payment['status'] === 'SUCCEEDED')
                {{-- <a href="{{ route('orders.show', $orderId) }}" class="px-5 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Lihat Pesanan</a> --}}
            @elseif ($payment['status'] === 'pending')
                <div id="statusText" class="text-xl font-bold text-gray-700">Menunggu pembayaran...</div>
                <div id="loader" class="mt-4 text-gray-500">⏳ Memeriksa status pembayaran...</div>
            @else
                {{-- <a href="{{ route('checkout.retry', $orderId) }}" class="px-5 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Coba Lagi</a> --}}
            @endif
        </div>
    </div>
    <script>
        const referenceId = "{{ $payment['id'] }}";
    
        const checkStatus = async () => {
            try {
                const res = await fetch(`/payment/check/${referenceId}`);
                const data = await res.json();

                if (data.status === 'pending') {
                    document.getElementById('statusText').textContent = 'Pembayaran Berhasil';
                    document.getElementById('loader').style.display = 'none';
                    clearInterval(intervalId);
                }

            } catch (error) {
                console.error(error);
            }
        }
    
        const intervalId = setInterval(checkStatus, 3000);
    </script>
</body>
</html>