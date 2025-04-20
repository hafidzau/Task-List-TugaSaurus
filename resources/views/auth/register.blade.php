<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Tugasaurus - Your Prehistoric Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <style>
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .floating { 
            animation: float 6s ease-in-out infinite; 
        }
        .dino-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='52' height='26' viewBox='0 0 52 26' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.05'%3E%3Cpath d='M10 10c0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6h2c0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4 3.314 0 6 2.686 6 6 0 2.21 1.79 4 4 4v2c-3.314 0-6-2.686-6-6 0-2.21-1.79-4-4-4-3.314 0-6-2.686-6-6zm25.464-1.95l8.486 8.486-1.414 1.414-8.486-8.486 1.414-1.414z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-green-50 via-white to-yellow-50 dino-pattern">
    <div class="flex min-h-screen">
        <!-- Left side - Dinosaur Theme -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-green-600 to-yellow-500 p-12 text-white flex-col justify-center items-center relative overflow-hidden">
            <svg class="absolute opacity-10 right-0 top-0 w-96 h-96" viewBox="0 0 24 24" fill="currentColor">
                <path d="M13 2v1.5h-1.5v1h-1v1H9v1H8v1H7v1H6v1H5v1H4v1H3v1H2v1h6v-1h1v-1h1v-1h1v-1h1v-1h7v-1h1V5h-1V4h-1V3h-1V2h-4zm6 11v1h-1v1h-1v1h-1v1h-1v1h-1v1h-1v1h-1v1h-1v1H9v1H7v-1H6v-1H5v-1H4v-1H3v-1H2v3h1v1h1v1h16v-1h1v-7h-2z"/>
            </svg>
            
            <div class="max-w-xl relative">
                <h1 class="text-5xl font-bold mb-8 floating">Welcome to Tugasaurus</h1>
                <p class="text-xl mb-8 opacity-90">Evolve your productivity with the most prehistoric task manager!</p>
                
                <div class="grid grid-cols-2 gap-6 text-sm">
                    <div class="flex items-center space-x-2 bg-white/20 p-3 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Jurassic Efficiency</span>
                    </div>
                    <div class="flex items-center space-x-2 bg-white/20 p-3 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>Pack Collaboration</span>
                    </div>
                    <div class="flex items-center space-x-2 bg-white/20 p-3 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span>T-Rex Tracking</span>
                    </div>
                    <div class="flex items-center space-x-2 bg-white/20 p-3 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Raptor-Fast Tasks</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Right side - Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Join the Pack</h2>
                    <p class="text-gray-600 mt-2">Start your prehistoric productivity journey</p>
                </div>

                <form action="{{ route('register') }}" method="POST" class="space-y-6">
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <p class="text-sm">{{ $errors->first() }}</p>
                        </div>
                    @endif

                
                    @csrf
                    <div class="space-y-4">
                        <div class="relative">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" required placeholder="Rex Smith" autocomplete="name">
                        </div>
                
                        <div class="relative">
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                            <input type="text" name="username" id="username" value="{{ old('username') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" required placeholder="clever_raptor" autocomplete="username">
                        </div>
                
                        <div class="relative">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" required placeholder="rex@example.com" autocomplete="email">
                        </div>
                
                        <div class="relative">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200" required placeholder="••••••••" autocomplete="new-password">
                                <button type="button" id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                    <!-- Eye icon (Show) -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" id="showPasswordIcon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <!-- Eye-off icon (Hide) -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" id="hidePasswordIcon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                
                    <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-yellow-500 text-white rounded-lg py-3 font-medium hover:opacity-90 transform hover:scale-[1.02] transition-all duration-200">
                        Begin Your Evolution
                    </button>
                </form>
                
                <p class="mt-8 text-center text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-green-600 font-medium hover:text-green-700 transition-colors duration-200">
                        GASSS LOGIN
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Initialize GSAP animations
        gsap.from(".floating", {
            y: 20,
            rotation: 5,
            duration: 2,
            repeat: -1,
            yoyo: true,
            ease: "power1.inOut"
        });

        // Password visibility toggle
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('togglePassword');
            const showIcon = document.getElementById('showPasswordIcon');
            const hideIcon = document.getElementById('hidePasswordIcon');

            toggleButton.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    showIcon.classList.add('hidden');
                    hideIcon.classList.remove('hidden');
                } else {
                    passwordInput.type = 'password';
                    showIcon.classList.remove('hidden');
                    hideIcon.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>