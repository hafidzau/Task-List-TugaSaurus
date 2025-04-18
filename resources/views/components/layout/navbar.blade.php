@php
    $isLoggedIn = Auth::check();
    $currentRoute = request()->route()->getName() ?? '';
@endphp

<nav x-data="{ open: false, userDropdown: false }" class="bg-gradient-to-r from-green-600 to-green-800 border-b border-green-800 shadow-xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo and Brand -->
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="overflow-hidden rounded-lg transition-all duration-300 transform group-hover:scale-105 shadow-lg">
                        <img src="{{ asset('images/logo.jpg') }}" class="h-10 w-auto" alt="Tugasaurus Logo">
                    </div>
                    <span class="text-xl font-extrabold text-white tracking-wider group-hover:text-green-200 transition-colors duration-200">
                        Tugasaurus
                    </span>
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden lg:flex lg:items-center lg:space-x-8 text-lg font-medium">
                <a href="/dashboard"
                   class="group flex items-center px-4 py-2 rounded-xl transition-all duration-300
                   {{ $currentRoute == 'dashboard' ? 'bg-green-500 text-white' : 'text-gray-200 hover:bg-green-100 hover:text-gray-700' }}">
                    <svg class="w-6 h-6 mr-3 transition-colors duration-300
                        {{ $currentRoute == 'dashboard' ? 'text-white' : 'group-hover:text-green-500' }}"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                </a>
            
                <a href="/tasks"
                   class="group flex items-center px-4 py-2 rounded-xl transition-all duration-300
                   {{ $currentRoute == 'tasks' ? 'bg-green-500 text-white' : 'text-gray-200 hover:bg-green-100 hover:text-gray-700' }}">
                    <svg class="w-6 h-6 mr-3 transition-colors duration-300
                        {{ $currentRoute == 'tasks' ? 'text-white' : 'group-hover:text-green-500' }}"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2
                                 M9 5a2 2 0 002 2h2a2 2 0 002-2
                                 M9 5a2 2 0 012-2h2a2 2 0 012 2
                                 m-6 9l2 2 4-4"/>
                    </svg>
                    <span>Tasks</span>
                </a>
            
                <a href="/today"
                   class="group flex items-center px-4 py-2 rounded-xl transition-all duration-300
                   {{ $currentRoute == 'today' ? 'bg-green-500 text-white' : 'text-gray-200 hover:bg-green-100 hover:text-gray-700' }}">
                    <svg class="w-6 h-6 mr-3 transition-colors duration-300
                        {{ $currentRoute == 'today' ? 'text-white' : 'group-hover:text-green-500' }}"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 8h14
                                 M5 8a2 2 0 110-4h14a2 2 0 110 4
                                 M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8
                                 m-9 4h4"/>
                    </svg>
                    <span>Today</span>
                </a>
            </div>
            
            
            

            <!-- User Menu - Desktop -->
            <div class="hidden lg:flex lg:items-center">
                @if($isLoggedIn)
                <a href="/logout" class="group relative inline-flex items-center justify-center px-5 py-2.5 font-medium overflow-hidden rounded-lg transition-all duration-300">
                    <span class="absolute inset-0 border-2 border-green-500 rounded-lg group-hover:border-white transition-colors duration-300"></span>
                    <span class="absolute inset-0 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300 origin-center bg-gradient-to-r from-green-600 to-green-500 opacity-20"></span>
                    <span class="relative flex items-center text-white group-hover:text-green-100 transition-colors duration-300">
                        <svg class="w-5 h-5 mr-2 transition-all duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H3m14 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="font-semibold">Logout</span>
                    </span>
                </a>
                
                @else
                <div class="flex items-center space-x-4">
                    <a href="/login" class="group relative inline-flex items-center justify-center px-5 py-2.5 font-medium overflow-hidden rounded-lg transition-all duration-300">
                        <span class="absolute inset-0 border-2 border-green-500 rounded-lg group-hover:border-white transition-colors duration-300"></span>
                        <span class="absolute inset-0 rounded-lg scale-0 group-hover:scale-100 transition-transform duration-300 origin-center bg-gradient-to-r from-green-600 to-green-500 opacity-20"></span>
                        <span class="relative flex items-center text-white group-hover:text-green-100 transition-colors duration-300">
                            <svg class="w-5 h-5 mr-2 transition-all duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="font-semibold">Login</span>
                        </span>
                    </a>
                    
                    <a href="/register" class="group relative inline-flex items-center justify-center px-5 py-2.5 font-medium overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-all duration-300">
                        <span class="absolute inset-0 bg-white rounded-lg"></span>
                        <span class="absolute inset-0 bg-gradient-to-r from-green-50 to-green-100 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        <span class="absolute inset-0 rounded-lg border border-green-100 group-hover:border-green-200 transition-colors duration-300"></span>
                        <span class="relative flex items-center text-green-700 group-hover:text-green-800 transition-colors duration-300">
                            <svg class="w-5 h-5 mr-2 transition-all duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            <span class="font-semibold">Register</span>
                        </span>
                    </a>
                </div>
                @endif
            </div>
            

            <!-- Mobile menu button -->
            <div class="flex items-center lg:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-green-200 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" :class="{'hidden': open, 'block': !open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="h-6 w-6" :class="{'block': open, 'hidden': !open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200" 
         x-transition:enter-start="opacity-0 transform -translate-y-2" 
         x-transition:enter-end="opacity-100 transform translate-y-0" 
         x-transition:leave="transition ease-in duration-150" 
         x-transition:leave-start="opacity-100 transform translate-y-0" 
         x-transition:leave-end="opacity-0 transform -translate-y-2" 
         class="lg:hidden bg-green-700">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="/dashboard" class="mobile-nav-link {{ $currentRoute == 'dashboard' ? 'active-mobile-nav' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Dashboard
            </a>
            <a href="/tasks" class="mobile-nav-link {{ $currentRoute == 'tasks' ? 'active-mobile-nav' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                Tasks
            </a>
            <a href="/today" class="mobile-nav-link {{ $currentRoute == 'calendar' ? 'active-mobile-nav' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Today
            </a>
            
        @if($isLoggedIn)
        <div class="border-t border-green-600 pt-4 pb-3 px-2 sm:px-3 space-y-2">
            <a href="/logout" class="mobile-nav-link bg-red-600 hover:bg-red-500 block w-full py-2 px-3 rounded-md text-base font-medium transition duration-150 ease-in-out flex items-center justify-center text-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H3m14 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                Logout
            </a>
        </div>
        @else
            <div class="border-t border-green-600 pt-4 pb-3 px-2 sm:px-3 space-y-2">
                <a href="/login" class="mobile-nav-link bg-green-600 hover:bg-green-500 block w-full py-2 px-3 rounded-md text-base font-medium transition duration-150 ease-in-out flex items-center justify-center text-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Login
                </a>
                <a href="/register" class="text-green-800 bg-white hover:bg-green-100 block w-full py-2 px-3 rounded-md text-base font-medium transition duration-150 ease-in-out flex items-center justify-center text-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Register
                </a>
            </div>
        @endif        
        </div>
    </div>
</nav>

<style>
    /* Custom classes for navigation */
    .nav-link {
        @apply text-white font-medium flex items-center px-3 py-2 rounded-lg hover:bg-green-700 hover:text-white transition duration-200 ease-in-out;
    }
    
    .active-nav-link {
        @apply bg-green-700 text-white shadow-inner;
    }
    
    .mobile-nav-link {
        @apply block rounded-md px-3 py-2 text-base font-medium text-white hover:text-white hover:bg-green-600 transition duration-150 ease-in-out flex items-center;
    }
    
    .active-mobile-nav {
        @apply bg-green-600 text-white shadow-inner;
    }
</style>