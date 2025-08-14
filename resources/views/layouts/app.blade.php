<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-[#160285] text-white flex flex-col">
        <div class="flex items-center gap-2 px-4 py-4 border-b border-[#D1A300]">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto">
            <span class="text-lg font-bold">ZAG CMS</span>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-[#D1A300] hover:text-black">Dashboard</a>
            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded hover:bg-[#D1A300] hover:text-black">Profile</a>
        </nav>

        <div class="px-4 py-4 border-t border-[#D1A300] text-sm text-center">
            &copy; {{ date('Y') }} ZAG MEDIA TEAM<br>
            <span class="text-xs">Version 1.0</span>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col">
        {{-- Top Navigation --}}
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">@yield('page-title', 'Dashboard')</h1>
            <div class="flex items-center gap-4">
                <span>{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline">Logout</button>
                </form>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

</div>
</body>
</html>
