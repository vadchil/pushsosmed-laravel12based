<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
    <style>
        /* Overlay fade */
        .overlay-enter { opacity: 0; transition: opacity 0.25s ease-in-out; }
        .overlay-enter-active { opacity: 1; }
        .overlay-leave { opacity: 1; transition: opacity 0.25s ease-in-out; }
        .overlay-leave-active { opacity: 0; }

        /* Sidebar slide */
        .sidebar-enter { transform: translateX(-100%); transition: transform 0.25s ease-in-out; }
        .sidebar-enter-active { transform: translateX(0); }
        .sidebar-leave { transform: translateX(0); transition: transform 0.25s ease-in-out; }
        .sidebar-leave-active { transform: translateX(-100%); }
    </style>
</head>
<body class="bg-gray-50 min-h-screen text-gray-800">

<!-- Sidebar -->
<aside id="sidebar"
       class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 shadow-lg 
              transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out z-50 flex flex-col">

    <!-- Logo -->
    <div class="p-6">
        <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-indigo-600">
            PushSosmed
        </a>
    </div>

    <!-- Nav -->
    <nav class="flex-1 px-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('*.dashboard') ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">🏠 Dashboard</a>
        <a href="{{ route('user.order.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('*.order.*') ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">📦 Pesanan</a>
        <a href="{{ route('user.balance.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('*.balance.*') ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">💰 Saldo</a>
        <a href="{{ route('user.services.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('*.services.*') ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">🛠 Layanan</a>
        <a href="{{ route('user.topup.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('*.topup.index') ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">💳 Top Up</a>
        <a href="{{ route('user.topup.history') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('*.topup.history') ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">📜 Riwayat</a>
        <a href="{{ route('user.support.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('*.support.*') ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">🆘 Support</a>
        <a href="{{ route('settings.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('settings.*') ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">⚙ Settings</a>
    </nav>

    <!-- User Info & Logout -->
    <div class="border-t border-gray-200 p-4 mt-auto">
        <div class="flex items-center space-x-3 mb-3">
            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-indigo-100 text-indigo-600 font-bold">
                {{ auth()->user()->initials() }}
            </div>
            <div>
                <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700 transition">
            Log Out
            </button>
        </form>
    </div>
</aside>

<!-- Overlay -->
<div id="overlay" class="fixed inset-0 hidden lg:hidden z-40"></div>

<!-- Main Content -->
<div class="lg:ml-64 flex flex-col min-h-screen">

    <!-- Mobile Header -->
    <header class="lg:hidden flex items-center justify-between px-4 py-3 bg-white border-b shadow">
        <a href="{{ route('dashboard') }}" class="text-xl font-bold text-indigo-600">PushSosmed</a>
        <button id="sidebar-toggle" class="p-2 rounded-md border border-gray-300">
            <span id="sidebar-icon">☰</span>
        </button>
    </header>

    <!-- Page content -->
    <main class="flex-1 p-6">
        <div class="max-w-7xl mx-auto">
            {{ $slot }}
        </div>
    </main>
</div>

<script>
    const toggleBtn = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const icon = document.getElementById('sidebar-icon');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
        icon.textContent = sidebar.classList.contains('-translate-x-full') ? '☰' : '✕';
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        icon.textContent = '☰';
    });
</script>

</body>
</html>
