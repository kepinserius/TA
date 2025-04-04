<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css" integrity="sha512-riZwnB8ebhwOVAUlYoILfran/fH0deyunXyJZ+yJGDyU0Y8gsDGtPHn1eh276aNADKgFERecHecJgkzcE9J3Lg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="flex items-center justify-center h-screen bg-gray-100 bg-gradient-to-r from-[#42b549] to-[#ffff]">

<div class="w-full max-w-4xl bg-white shadow-lg rounded-lg flex">
    <div class="w-full p-10">
        <img src="{{$status === 'pending' ? asset('images/pending.svg') : asset('images/cancel.svg')}}" class="m-auto" alt="">
        <p class="text-center text-lg font-bold mt-5">{{$status === 'pending' ? 'Menunggu konfirmasi Admin' : 'Pengajuan anda ditolak'}}</p>
        <p class="text-center">Kembali Ke Beranda Dalam <span id="count"></span></p>
    </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js" integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/index.js')}}"></script>
    <script>
        function timer(duration, display) {
            let timer = duration, seconds
            let interval = setInterval(() => {
                seconds = parseInt(timer % 60, 10)
                seconds = seconds < 10 ? "0" + seconds : seconds

                display.textContent = seconds + '...'

                if (--timer < 0) {
                    clearInterval(interval)
                    window.location.replace('/')
                }
            }, 1000);
        }

        window.onload = function () {
            var countdown = 3, display = document.querySelector('#count')
            timer(countdown, display)
        }
    </script>
</body>
</html>
