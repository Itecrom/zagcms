<!-- resources/views/layouts/sidebar.blade.php -->
<div class="w-64 min-h-screen bg-[#160285] text-white flex flex-col">
    <!-- Logo -->
    <div class="p-4 flex items-center gap-2">
        <img src="{{ asset('images/logo.png') }}" alt="ZAG Logo" class="h-12 w-auto">
        <span class="font-bold text-lg">ZAG MEMBERS APP</span>
    </div>

    <!-- Navigation -->
    <nav class="mt-6 flex-1">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}" class="block py-2 px-4 hover:bg-[#D1A300] hover:text-[#160285] rounded">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('members.index') }}" class="block py-2 px-4 hover:bg-[#D1A300] hover:text-[#160285] rounded">
                    Members
                </a>
            </li>
            <li>
                <a href="{{ route('homecells.index') }}" class="block py-2 px-4 hover:bg-[#D1A300] hover:text-[#160285] rounded">
                    Homecells
                </a>
            </li>
            <li>
                <a href="{{ route('ministries.index') }}" class="block py-2 px-4 hover:bg-[#D1A300] hover:text-[#160285] rounded">
                    Ministries
                </a>
            </li>
        </ul>
    </nav>

    <!-- Footer -->
    <div class="p-4 text-center text-sm mt-auto">
        &copy; {{ date('Y') }} ZAG MEDIA TEAM <br>
        Version 1.0
    </div>
</div>
