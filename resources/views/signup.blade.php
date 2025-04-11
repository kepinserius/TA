<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Etalase UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css" integrity="sha512-riZwnB8ebhwOVAUlYoILfran/fH0deyunXyJZ+yJGDyU0Y8gsDGtPHn1eh276aNADKgFERecHecJgkzcE9J3Lg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }
        
        .animated-gradient {
            background: linear-gradient(-45deg, #FF7F27, #FFA15F, #FF7F27, #E66C1E);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        
        .float-element {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
            100% {
                transform: translateY(0px);
            }
        }
        
        .input-focus-effect {
            transition: all 0.3s ease;
        }
        
        .input-focus-effect:focus {
            transform: translateY(-2px);
        }
        
        .btn-hover-effect {
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }
        
        .btn-hover-effect::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 0;
            background-color: rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            z-index: -1;
        }
        
        .btn-hover-effect:hover::after {
            height: 100%;
        }
        
        .signup-card {
            transition: all 0.5s ease;
            box-shadow: 0 10px 50px rgba(0,0,0,0.1);
        }
        
        .signup-card:hover {
            box-shadow: 0 20px 70px rgba(0,0,0,0.2);
            transform: translateY(-5px);
        }
        
        .animated-shapes:before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255,127,39,0.1);
            border-radius: 50%;
            top: -50px;
            right: -50px;
            z-index: 0;
            animation: pulse 5s infinite alternate;
        }
        
        .animated-shapes:after {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            background: rgba(255,127,39,0.1);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
            z-index: 0;
            animation: pulse 7s infinite alternate-reverse;
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(1.5);
            }
        }
        
        /* Particle animation */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        
        .particle {
            position: absolute;
            background-color: rgba(255, 127, 39, 0.2);
            border-radius: 50%;
            animation: particleAnimation linear infinite;
        }
        
        @keyframes particleAnimation {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
            }
        }
        
        /* Animated input labels */
        .input-animation .input-field:focus + .input-label,
        .input-animation .input-field:not(:placeholder-shown) + .input-label {
            transform: translateY(-25px) scale(0.85);
            color: #FF7F27;
        }
        
        .input-label {
            transition: all 0.3s ease;
            transform-origin: 0 0;
        }
        
        /* Typing animation for heading */
        .typing-animation {
            border-right: 2px solid #FF7F27;
            white-space: nowrap;
            overflow: hidden;
            animation: typing 3.5s steps(30, end), blink-caret 0.75s step-end infinite;
        }

        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: #FF7F27 }
        }
    </style>
</head>
<body class="flex items-center justify-center h-screen overflow-hidden">
    <!-- Animated Gradient Background -->
    <div class="absolute inset-0 animated-gradient opacity-90"></div>
    
    <!-- Particles -->
    <div class="particles" id="particles"></div>

    <div class="w-full max-w-4xl relative z-10 animate__animated animate__fadeIn animate__slow">
        <div class="signup-card bg-white shadow-lg rounded-lg flex overflow-hidden animated-shapes">
            <div class="w-1/2 p-8 bg-white">
                <div class="animate__animated animate__fadeInUp">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2 typing-animation overflow-hidden">Daftar Akun</h2>
                    <p class="text-gray-600 mb-6 animate__animated animate__fadeIn animate__delay-1s">Daftar dan mulai berbelanja di Etalase UMKM</p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 mb-4 rounded-lg animate__animated animate__shakeX">
                        @foreach ($errors->all() as $error)
                            <p><i class="fas fa-exclamation-circle mr-2"></i>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('signup') }}" class="space-y-5 animate__animated animate__fadeInUp animate__delay-1s">
                    @csrf
                    <div class="mb-4 transform transition duration-500 hover:scale-105">
                        <label for="username" class="block text-gray-700 font-medium mb-2">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                <i class="fas fa-user"></i>
                            </div>
                            <input type="text" id="username" name="username" class="w-full pl-10 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FF7F27] focus:border-[#FF7F27] input-focus-effect" placeholder="Masukkan username" required>
                        </div>
                    </div>
                    
                    <div class="mb-4 transform transition duration-500 hover:scale-105">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <input type="email" id="email" name="email" class="w-full pl-10 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FF7F27] focus:border-[#FF7F27] input-focus-effect" placeholder="Masukkan email" required>
                            <span class="text-xs text-gray-500 mt-1 block animate__animated animate__fadeIn animate__delay-2s">Akan digunakan untuk verifikasi dan pemulihan akun</span>
                        </div>
                    </div>
                    
                    <div class="mb-4 transform transition duration-500 hover:scale-105">
                        <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                <i class="fas fa-lock"></i>
                            </div>
                            <input type="password" name="password" id="password" class="w-full pl-10 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FF7F27] focus:border-[#FF7F27] input-focus-effect" placeholder="Masukkan password" required>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full bg-[#FF7F27] text-white py-3 rounded-lg hover:bg-[#E66C1E] transition-all duration-300 font-medium shadow-md hover:shadow-lg transform hover:-translate-y-1 btn-hover-effect">
                            <i class="fas fa-user-plus mr-2"></i>Buat Akun
                        </button>
                    </div>
                </form>
                
                <p class="text-center text-gray-600 mt-6 animate__animated animate__fadeIn animate__delay-2s">Dengan mendaftar, Anda menyetujui <a href="#" class="text-[#FF7F27] hover:underline transition-all duration-300">Syarat dan Ketentuan</a> kami</p>
            </div>

            <div class="w-1/2 bg-[#FF7F27] text-white flex flex-col items-center justify-center p-8 rounded-r-lg relative">
                <div class="float-element animate__animated animate__fadeIn animate__delay-1s">
                    <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_rbtawnwz.json" background="transparent" speed="1" style="width: 250px; height: 250px;" loop autoplay></lottie-player>
                </div>
                <div class="mb-6 text-center animate__animated animate__fadeInUp animate__delay-1s">
                    <i class="fas fa-store text-5xl mb-4"></i>
                    <h2 class="text-2xl font-semibold mb-3">Etalase UMKM</h2>
                    <p class="mb-4 opacity-90">Temukan berbagai produk UMKM berkualitas dengan harga terbaik</p>
                </div>
                <div class="relative animate__animated animate__fadeInUp animate__delay-2s">
                    <p class="mb-4">Sudah punya akun?</p>
                    <a href="{{ route('login') }}" class="px-6 py-3 border border-white rounded-lg hover:bg-white hover:text-[#FF7F27] transition-all duration-300 font-medium animate__animated animate__pulse animate__infinite animate__slow transform hover:scale-105">
                        <i class="fas fa-sign-in-alt mr-2"></i>Masuk Sekarang
                    </a>
                </div>
                <div class="mt-8 animate__animated animate__fadeInUp animate__delay-3s">
                    <a href="/" class="text-white hover:underline transition-all duration-300 flex items-center group">
                        <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-2 transition-transform"></i>Kembali ke Beranda
                    </a>
                </div>
                
                <!-- Decorative Elements -->
                <div class="absolute top-10 left-10 w-8 h-8 rounded-full bg-white opacity-20 animate__animated animate__pulse animate__infinite"></div>
                <div class="absolute bottom-10 right-10 w-8 h-8 rounded-full bg-white opacity-20 animate__animated animate__pulse animate__infinite animate__delay-1s"></div>
                <div class="absolute top-40 right-20 w-4 h-4 rounded-full bg-white opacity-20 animate__animated animate__pulse animate__infinite animate__delay-2s"></div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js" integrity="sha512-mBSqtiBr4vcvTb6BCuIAgVx4uF3EVlVvJ2j+Z9USL0VwgL9liZ638rTANn5m1br7iupcjjg/LIl5cCYcNae7Yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/index.js')}}"></script>
    <script>
        // Create floating particles
        document.addEventListener('DOMContentLoaded', function() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 20;
            
            for (let i = 0; i < particleCount; i++) {
                createParticle(particlesContainer);
            }
            
            // Form animation on focus
            const inputs = document.querySelectorAll('input');
            inputs.forEach((input, index) => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('scale-105');
                });
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('scale-105');
                });
                
                // Add a slight delay to each input's appearance
                setTimeout(() => {
                    input.parentElement.classList.add('animate__animated', 'animate__fadeInLeft');
                    input.parentElement.style.opacity = '1';
                }, (index + 1) * 200);
            });
            
            // Password strength indicator (simple example)
            const passwordInput = document.getElementById('password');
            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    const value = this.value;
                    let strength = 0;
                    
                    if (value.length >= 8) strength += 1;
                    if (value.match(/[A-Z]/)) strength += 1;
                    if (value.match(/[0-9]/)) strength += 1;
                    if (value.match(/[^A-Za-z0-9]/)) strength += 1;
                    
                    let strengthIndicator = this.parentElement.querySelector('.strength-indicator');
                    if (!strengthIndicator) {
                        strengthIndicator = document.createElement('div');
                        strengthIndicator.className = 'strength-indicator flex mt-2 space-x-1';
                        
                        for (let i = 0; i < 4; i++) {
                            const bar = document.createElement('div');
                            bar.className = 'h-1 flex-1 rounded-full bg-gray-200 transition-all duration-300';
                            strengthIndicator.appendChild(bar);
                        }
                        
                        this.parentElement.appendChild(strengthIndicator);
                    }
                    
                    const bars = strengthIndicator.querySelectorAll('div');
                    for (let i = 0; i < 4; i++) {
                        if (i < strength) {
                            bars[i].className = `h-1 flex-1 rounded-full transition-all duration-300 ${getStrengthColor(strength)}`;
                        } else {
                            bars[i].className = 'h-1 flex-1 rounded-full bg-gray-200 transition-all duration-300';
                        }
                    }
                });
            }
        });
        
        function getStrengthColor(strength) {
            switch (strength) {
                case 1: return 'bg-red-500';
                case 2: return 'bg-orange-500';
                case 3: return 'bg-yellow-500';
                case 4: return 'bg-green-500';
                default: return 'bg-gray-200';
            }
        }
        
        function createParticle(container) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            // Random size between 5 and 20px
            const size = Math.random() * 15 + 5;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            
            // Random position
            const posX = Math.random() * 100;
            const posY = Math.random() * 100 + 100;
            particle.style.left = `${posX}%`;
            particle.style.bottom = `${-posY}px`;
            
            // Random animation duration between 15 and 30 seconds
            const duration = Math.random() * 15 + 15;
            particle.style.animationDuration = `${duration}s`;
            
            // Random delay
            const delay = Math.random() * 5;
            particle.style.animationDelay = `${delay}s`;
            
            container.appendChild(particle);
            
            // Remove and recreate particle when animation ends
            setTimeout(() => {
                particle.remove();
                createParticle(container);
            }, (duration + delay) * 1000);
        }
    </script>
</body>
</html>
