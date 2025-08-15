<!-- resources/views/layouts/sidebar.blade.php -->
<aside class="w-64 bg-[#160285] text-white flex flex-col">
    <div class="flex items-center gap-2 px-4 py-4 border-b border-[#D1A300]">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto">
        <span class="text-lg font-bold">ZAG CMS</span>
    </div>

    <nav class="flex-1 px-2 py-6 space-y-2">
        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-[#D1A300] hover:text-black">Dashboard</a>
        <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded hover:bg-[#D1A300] hover:text-black">Profile</a>

        {{-- Super Admin CRUDs --}}
        @if(auth()->user()->isSuperAdmin())
            <li x-data="{ open: false }" class="list-none">
                <button @click="open = !open"
                        class="w-full flex justify-between items-center px-3 py-2 rounded hover:bg-[#D1A300] hover:text-black">
                    <span>Members</span>
                    <svg :class="open ? 'rotate-90' : ''" class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <ul x-show="open" class="pl-4 space-y-1 mt-1">
                    <li><a href="{{ route('members.index') }}" class="block py-1 hover:text-[#D1A300]">View All</a></li>
                    <li><a href="{{ route('members.create') }}" class="block py-1 hover:text-[#D1A300]">Add Member</a></li>
                </ul>
            </li>

            <li x-data="{ open: false }" class="list-none">
                <button @click="open = !open"
                        class="w-full flex justify-between items-center px-3 py-2 rounded hover:bg-[#D1A300] hover:text-black">
                    <span>Ministries</span>
                    <svg :class="open ? 'rotate-90' : ''" class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <ul x-show="open" class="pl-4 space-y-1 mt-1">
                    <li><a href="{{ route('ministries.index') }}" class="block py-1 hover:text-[#D1A300]">View All</a></li>
                    <li><a href="{{ route('ministries.create') }}" class="block py-1 hover:text-[#D1A300]">Add Ministry</a></li>
                </ul>
            </li>
            @endif

            @if(auth()->user()->isSuperAdmin())
<li x-data="{ open: false }">
    <button @click="open = !open" ...>
        <span>Homecells</span>
    </button>
    <ul x-show="open">
        <li><a href="{{ route('homecells.index') }}">View All</a></li>
        <li><a href="{{ route('homecells.create') }}">Add Homecell</a></li>
    </ul>
</li>
@endif

@if(Auth::check() && Auth::user()->role === 'super_admin')
<li class="nav-item">
    <a class="nav-link" href="{{ route('users.index') }}">
        <i class="fas fa-users"></i> User Management
    </a>
</li>
@endif

    </nav>

    <div class="px-4 py-4 border-t border-[#D1A300] text-sm text-center">
        &copy; {{ date('Y') }} ZAG MEDIA TEAM<br>
        <span class="text-xs">Version 1.0</span>
    </div>
</aside>
