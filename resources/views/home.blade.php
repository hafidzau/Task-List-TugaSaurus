@extends('layout') {{-- atau sesuai nama layout kamu --}}

@section('title', 'Welcome to Tugasaurus')

@section('content')
    {{-- tempel kode landing page dari sebelumnya di sini --}}
    <!-- resources/views/landing.blade.php -->
<section class="mt-24 px-6 py-12 text-center bg-green-50">
    <h1 class="text-4xl md:text-5xl font-bold text-green-700 mb-4" data-aos="fade-down">
        Manage Your Tasks with Dino-mite Style! 🦕
    </h1>
    <p class="text-lg text-green-600 mb-8" data-aos="fade-up">
        Tugasaurus makes task management fun and efficient with our friendly dinosaur companions
    </p>
</section>

<section class="grid md:grid-cols-3 gap-6 px-6 py-12 max-w-7xl mx-auto">
    <div class="bg-white rounded-2xl shadow-md p-6 text-center hover:shadow-lg transition duration-300" data-aos="fade-up">
        <h3 class="text-xl font-semibold text-green-700 mb-2">Smart Task Organization</h3>
        <p class="text-green-600">Organize your tasks efficiently with our intuitive dinosaur-themed interface</p>
    </div>
    <div class="bg-white rounded-2xl shadow-md p-6 text-center hover:shadow-lg transition duration-300" data-aos="fade-up" data-aos-delay="100">
        <h3 class="text-xl font-semibold text-green-700 mb-2">Dino Productivity</h3>
        <p class="text-green-600">Boost your task power and stay focused like a T-Rex chasing a goal!</p>
    </div>
    
    <div class="bg-white rounded-2xl shadow-md p-6 text-center hover:shadow-lg transition duration-300" data-aos="fade-up" data-aos-delay="200">
        <h3 class="text-xl font-semibold text-green-700 mb-2">Smart Reminders</h3>
        <p class="text-green-600">Never miss a deadline with our T-Rex reminder system that roars when tasks are due</p>
    </div>
</section>

<section class="bg-green-600 text-white text-center py-16 px-6" data-aos="fade-up">
    <h2 class="text-3xl font-bold mb-4">Ready to Start Your Prehistoric Adventure?</h2>
    <p class="text-lg mb-8">Join thousands of users who are already managing their tasks with Tugasaurus</p>
    <a href="{{ route('register') }}">
        <button
            class="text-green-600 bg-white hover:bg-green-100 font-bold py-3 px-6 rounded-full shadow-lg transition duration-300"
            data-ripple-light="true">
            Start for Free
        </button>
    </a>
</section>

@endsection
@section('scripts')
    {{-- taruh <script> AOS, Flowbite, dll di sini --}}
    <!-- Script AOS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
        easing: 'ease-in-out'
    });
</script>

<!-- Flowbite (pastikan sudah di-include di layout Blade kamu) -->
<script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
@endsection
