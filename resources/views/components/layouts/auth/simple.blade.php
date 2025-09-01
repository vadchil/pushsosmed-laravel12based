<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center antialiased">
    <div class="w-full max-w-md px-6 py-10">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <span class="inline-flex items-center justify-center h-10 w-10 rounded-md">
                    <x-app-logo-icon class="w-8 h-8 fill-current text-indigo-600" />
                </span>
                <span class="text-lg font-semibold text-gray-900">PushSosmed</span>
            </a>
        </div>

        <!-- Slot (form/content akan dimasukkan di sini) -->
        <div>
            {{ $slot }}
        </div>
    </div>

    @fluxScripts
</body>
</html>
