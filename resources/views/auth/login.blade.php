<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tugasaurus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <style>
        @keyframes float {
            0% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }

            100% {
                transform: translateY(0px) rotate(0deg);
            }
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
                <path d="M13 2v1.5h-1.5v1h-1v1H9v1H8v1H7v1H6v1H5v1H4v1H3v1h6v-1h1v-1h1v-1h1v-1h7v-1h1V5h-1V4h-1V3h-1V2h-4zm6 11v1h-1v1h-1v1h-1v1h-1v1h-1v1h-1v1h-1v1H9v1H7v-1H6v-1H5v-1H4v-1H3v-1H2v3h1v1h1v1h16v-1h1v-7h-2z"/>
            </svg>

            <div class="max-w-xl relative">
                <h1 class="text-5xl font-bold mb-8 floating">Welcome Back to Tugasaurus</h1>
                <p class="text-xl mb-8 opacity-90">Time to wrangle those tasks!</p>

                <div class="bg-white/20 p-6 rounded-xl backdrop-blur-sm">
                    <h3 class="text-lg font-semibold mb-4">Did you know?</h3>
                    <p class="text-sm opacity-90">
                        Just like the mighty T-Rex, Tugasaurus helps you tackle the biggest tasks first.
                        Our prehistoric task manager ensures nothing escapes your notice!
                    </p>
                </div>
            </div>
        </div>

        <!-- Right side - Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Welcome Back</h2>
                    <p class="text-gray-600 mt-2">Resume your prehistoric productivity journey</p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email or Username</label>
                            <input type="text" name="email" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200"
                                placeholder="rex@example.com" value="{{ old('email') }}">
                
                            {{-- @error('username')
                                <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                            @enderror --}}
                        </div>
                
                        <div class="relative">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative">
                                <input type="password" name="password" required id="password"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200"
                                    placeholder="••••••••">
                                <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 focus:outline-none transition-colors" onclick="togglePasswordVisibility()">
                                    <!-- Eye Icon (Closed by default) -->
                                    <svg xmlns="http://www.w3.org/2000/svg" id="eyeIcon" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <!-- Eye Icon (Open - hidden by default) -->
                                    <svg xmlns="http://www.w3.org/2000/svg" id="eyeSlashIcon" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                
                            {{-- @error('password')
                                <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                            @enderror --}}
                        </div>
                    </div>
                
                    {{-- <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                                Remember me
                            </label>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:underline">
                            Forgot password?
                        </a>
                    </div> --}}
                
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-green-600 to-yellow-500 text-white rounded-lg py-3 font-medium hover:opacity-90 transform hover:scale-[1.02] transition-all duration-200 mt-6">
                        Enter the Jurassic Park
                    </button>
                
                    <div class="relative flex items-center justify-center mt-8">
                        <div class="absolute inset-x-0 h-px bg-gray-200"></div>
                        <div class="relative bg-white px-4 text-xl text-gray-500">or</div>
                    </div>
                
                    <div class="grid grid-cols-1 gap-3 mt-4">
                        <button type="button"
                            class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 w-full">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                                <path fill="#4285F4"
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                <path fill="#34A853"
                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.1v2.85C3.91 20.91 7.66 23 12 23z" />
                                <path fill="#FBBC05"
                                    d="M5.84 14.1a7.56 7.56 0 0 1 0-4.2V7.05H2.1a11.97 11.97 0 0 0 0 10.9l3.74-2.85z" />
                                <path fill="#EA4335"
                                    d="M12 4.5c1.62 0 3.08.56 4.23 1.66l3.15-3.15A11.91 11.91 0 0 0 12 1c-4.34 0-8.09 2.09-10.08 5.45L5.84 9.3c.87-2.6 3.3-4.53 6.16-4.8z" />
                            </svg>
                            Continue with Google
                        </button>
                    </div>
                
                    <p class="text-center text-sm text-gray-600 mt-6">
                        Don't have an account yet?
                        <a href="{{ route('register') }}" class="text-green-600 hover:underline">Join the herd!</a>
                    </p>
                </form>
                
                <script>
                    function togglePasswordVisibility() {
                        const passwordInput = document.getElementById('password');
                        const eyeIcon = document.getElementById('eyeIcon');
                        const eyeSlashIcon = document.getElementById('eyeSlashIcon');
                
                        // Toggle the input type between password and text
                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            eyeIcon.classList.add('hidden');
                            eyeSlashIcon.classList.remove('hidden');
                        } else {
                            passwordInput.type = 'password';
                            eyeIcon.classList.remove('hidden');
                            eyeSlashIcon.classList.add('hidden');
                        }
                    }
                </script>
                
            </div>
        </div>
    </div>
</body>

</html>