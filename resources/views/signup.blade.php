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
    <div class="w-1/2 p-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Sign Up</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('signup') }}">
            @csrf
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username</label>
                <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#42b549]" placeholder="Enter username" required>
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#42b549]" placeholder="Enter email" required>
            </div>
            

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#42b549]" placeholder="Enter password" required>
            </div>

            <button type="submit" class="w-full mt-4 bg-[#42b549] text-white py-2 rounded hover:bg-green-600">Sign Up</button>
        </form>
    </div>

    <div class="w-1/2 bg-[#42b549] text-white flex flex-col items-center justify-center p-8 rounded-r-lg">
        <h2 class="text-2xl font-semibold mb-3">Welcome to Signup</h2>
        <p class="mb-4">Already have an account?</p>
        <a href="{{ route('login') }}" class="px-6 py-2 border border-white rounded hover:bg-white hover:text-[#42b549]">Login</a>
    </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js" integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/index.js')}}"></script>
</body>
</html>
