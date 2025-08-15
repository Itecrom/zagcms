<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
<div class="flex min-h-screen">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

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

<script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
