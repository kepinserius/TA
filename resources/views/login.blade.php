<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100 bg-gradient-to-r from-[#42b549] to-[#ffff]">

<div class="w-full max-w-4xl bg-white shadow-lg rounded-lg flex">
    <div class="w-1/2 p-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Sign In</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Username</label>
                <input type="text" name="username" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#42b549]" placeholder="Enter username" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-[#42b549]" placeholder="Enter password" required>
            </div>

            <div class="flex justify-between items-center">
                <div>
                    <input type="checkbox" id="remember" class="mr-1">
                    <label for="remember" class="text-gray-700">Remember Me</label>
                </div>
                <a href="#" class="text-[#42b549]">Forgot Password?</a>
            </div>

            <button type="submit" class="w-full mt-4 bg-[#42b549] text-white py-2 rounded hover:bg-green-600">Sign In</button>
        </form>
    </div>

    <div class="w-1/2 bg-[#42b549] text-white flex flex-col items-center justify-center p-8 rounded-r-lg">
        <h2 class="text-2xl font-semibold mb-3">Welcome to Login</h2>
        <p class="mb-4">Don't have an account?</p>
        <a href="{{ route('signup') }}" class="px-6 py-2 border border-white rounded hover:bg-white hover:text-[#42b549]">Sign Up</a>
    </div>
</div>

</body>
</html>
