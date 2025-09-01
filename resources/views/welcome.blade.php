<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Panel SMM Termurah & Terpercaya untuk Instagram, TikTok, YouTube, dan Sosial Media lainnya. Tingkatkan followers, like, dan view secara instan.">
    <meta name="keywords"
        content="panel smm, panel sosmed murah, jual followers, jual like, jual view, smm panel indonesia">
    <meta name="author" content="PushSosmed">
    <title>Panel SMM Murah & Terpercaya | PushSosmed</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
</head>

<body class="antialiased bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <header class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-600">PushSosmed</a>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex space-x-6">
                <a href="#layanan" class="hover:text-indigo-600">Layanan</a>
                <a href="#tentang" class="hover:text-indigo-600">Tentang</a>
                <a href="#harga" class="hover:text-indigo-600">Harga</a>
                <a href="#kontak" class="hover:text-indigo-600">Kontak</a>
            </nav>

            <!-- Auth Button -->
            <div class="hidden md:block">
                @guest
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                        Login
                    </a>
                @endguest

                @auth
                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                        Dashboard
                    </a>
                @endauth
            </div>

            <!-- Mobile Hamburger -->
            <button id="mobile-menu-btn" class="md:hidden text-gray-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
            <nav class="flex flex-col space-y-2 px-6 py-4">
                <a href="#layanan" class="hover:text-indigo-600">Layanan</a>
                <a href="#tentang" class="hover:text-indigo-600">Tentang</a>
                <a href="#harga" class="hover:text-indigo-600">Harga</a>
                <a href="#kontak" class="hover:text-indigo-600">Kontak</a>

                @guest
                    <a href="{{ route('login') }}"
                        class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 text-center">
                        Login
                    </a>
                @endguest

                @auth
                    <a href="{{ route('dashboard') }}"
                        class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 text-center">
                        Dashboard
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-24 text-center">
        <div class="max-w-3xl mx-auto px-6">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                Panel SMM Murah & Terpercaya di Indonesia
            </h1>
            <p class="mt-6 text-lg">
                Tingkatkan followers, like, dan view sosial media Anda hanya dengan beberapa klik. Cepat, aman, dan terpercaya.
            </p>
            <div class="mt-8">
                <a href="{{ route('register') }}"
                    class="px-6 py-3 bg-white text-indigo-600 font-semibold rounded-lg shadow hover:bg-gray-100">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Layanan -->
    <section id="layanan" class="py-20 max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-12">Layanan Kami</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold">Instagram</h3>
                <p class="mt-3 text-gray-600">Followers, Likes, Views, dan Komentar dengan kualitas terbaik.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold">TikTok</h3>
                <p class="mt-3 text-gray-600">Naikkan views dan followers TikTok dengan mudah.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold">YouTube</h3>
                <p class="mt-3 text-gray-600">Tingkatkan subscribers dan views channel Anda.</p>
            </div>
        </div>
    </section>

    <!-- Tentang -->
    <section id="tentang" class="bg-gray-100 py-20">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold">Mengapa Memilih PushSosmed?</h2>
            <p class="mt-6 text-lg text-gray-700">
                Kami menyediakan layanan sosial media marketing tercepat dan termurah di Indonesia. Dengan sistem otomatis, transaksi Anda akan diproses secara instan.
            </p>
        </div>
    </section>

    <!-- Harga -->
    <section id="harga" class="py-20 max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-12">Paket Harga</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-2xl shadow text-center">
                <h3 class="text-xl font-semibold">Basic</h3>
                <p class="mt-3 text-gray-600">Mulai dari Rp 50.000</p>
                <a href="{{ route('register') }}"
                    class="mt-6 inline-block px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Pilih Paket</a>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow text-center border-2 border-indigo-600">
                <h3 class="text-xl font-semibold">Pro</h3>
                <p class="mt-3 text-gray-600">Mulai dari Rp 100.000</p>
                <a href="{{ route('register') }}"
                    class="mt-6 inline-block px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Pilih Paket</a>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow text-center">
                <h3 class="text-xl font-semibold">Premium</h3>
                <p class="mt-3 text-gray-600">Mulai dari Rp 200.000</p>
                <a href="{{ route('register') }}"
                    class="mt-6 inline-block px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Pilih Paket</a>
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="bg-indigo-600 text-white py-20">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold">Hubungi Kami</h2>
            <p class="mt-4">Butuh bantuan? Hubungi support kami melalui WhatsApp atau Email.</p>
            <div class="mt-6 space-x-4">
                <a href="https://wa.me/628xxxxxx"
                    class="px-6 py-2 bg-white text-indigo-600 rounded-lg shadow hover:bg-gray-100">WhatsApp</a>
                <a href="mailto:support@namabrand.com"
                    class="px-6 py-2 bg-white text-indigo-600 rounded-lg shadow hover:bg-gray-100">Email</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-6 text-center">
        <p>&copy; {{ date('Y') }} PushSosmed. All rights reserved.</p>
    </footer>

    <!-- Script Mobile Menu -->
    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>
