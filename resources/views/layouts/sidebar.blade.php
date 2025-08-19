@php $user = auth()->user(); @endphp

<aside class="w-64 bg-[#160285] text-white flex flex-col">
    <!-- Logo Section -->
    <div class="flex items-center gap-2 px-4 py-4 border-b border-[#D1A300]">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto">
        <span class="text-lg font-bold">ZAG MMS</span>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-2 py-6">
        <ul class="space-y-2">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center px-3 py-2 rounded 
                          {{ request()->routeIs('dashboard') ? 'bg-[#D1A300] text-black font-semibold' : 'hover:bg-[#D1A300] hover:text-black' }}">
                    Dashboard
                </a>
            </li>

            <!-- Profile -->
            <li>
                <a href="{{ route('profile.edit') }}"
                   class="flex items-center px-3 py-2 rounded 
                          {{ request()->routeIs('profile.edit') ? 'bg-[#D1A300] text-black font-semibold' : 'hover:bg-[#D1A300] hover:text-black' }}">
                    Profile
                </a>
            </li>

            <!-- Members -->
            <li x-data="{ open: {{ request()->routeIs('members.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="w-full flex justify-between items-center px-3 py-2 rounded 
                               {{ request()->routeIs('members.*') ? 'bg-[#D1A300] text-black font-semibold' : 'hover:bg-[#D1A300] hover:text-black' }}">
                    <span>Members</span>
                    <svg :class="open ? 'rotate-90' : ''"
                         class="w-4 h-4 transform transition-transform" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                <ul x-show="open" class="pl-6 space-y-1 mt-1 text-sm">
                    <li><a href="{{ route('members.index') }}"
                           class="{{ request()->routeIs('members.index') ? 'text-[#D1A300] font-semibold' : 'hover:text-[#D1A300]' }}">
                           View All Members</a></li>
                    <li><a href="{{ route('members.create') }}"
                           class="{{ request()->routeIs('members.create') ? 'text-[#D1A300] font-semibold' : 'hover:text-[#D1A300]' }}">
                           Add New Member</a></li>
                </ul>
            </li>

            <!-- Ministries -->
            <li x-data="{ open: {{ request()->routeIs('ministries.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="w-full flex justify-between items-center px-3 py-2 rounded 
                               {{ request()->routeIs('ministries.*') ? 'bg-[#D1A300] text-black font-semibold' : 'hover:bg-[#D1A300] hover:text-black' }}">
                    <span>Ministries</span>
                    <svg :class="open ? 'rotate-90' : ''"
                         class="w-4 h-4 transform transition-transform" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                <ul x-show="open" class="pl-6 space-y-1 mt-1 text-sm">
                    <li><a href="{{ route('ministries.index') }}"
                           class="{{ request()->routeIs('ministries.index') ? 'text-[#D1A300] font-semibold' : 'hover:text-[#D1A300]' }}">
                           View All Ministries</a></li>
                    <li><a href="{{ route('ministries.create') }}"
                           class="{{ request()->routeIs('ministries.create') ? 'text-[#D1A300] font-semibold' : 'hover:text-[#D1A300]' }}">
                           Add New Ministry</a></li>
                </ul>
            </li>

            <!-- Homecells -->
            <li x-data="{ open: {{ request()->routeIs('homecells.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                        class="w-full flex justify-between items-center px-3 py-2 rounded 
                               {{ request()->routeIs('homecells.*') ? 'bg-[#D1A300] text-black font-semibold' : 'hover:bg-[#D1A300] hover:text-black' }}">
                    <span>Homecells</span>
                    <svg :class="open ? 'rotate-90' : ''"
                         class="w-4 h-4 transform transition-transform" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                <ul x-show="open" class="pl-6 space-y-1 mt-1 text-sm">
                    <li><a href="{{ route('homecells.index') }}"
                           class="{{ request()->routeIs('homecells.index') ? 'text-[#D1A300] font-semibold' : 'hover:text-[#D1A300]' }}">
                           View All Homecells</a></li>
                    <li><a href="{{ route('homecells.create') }}"
                           class="{{ request()->routeIs('homecells.create') ? 'text-[#D1A300] font-semibold' : 'hover:text-[#D1A300]' }}">
                           Add New Homecell</a></li>
                </ul>
            </li>

            <!-- User Management -->
            <li>
                <a href="{{ route('users.index') }}"
                   class="flex items-center px-3 py-2 rounded
                          {{ request()->routeIs('users.*') ? 'bg-[#D1A300] text-black font-semibold' : 'hover:bg-[#D1A300] hover:text-black' }}">
                    User Management
                </a>
            </li>
        </ul>
    </nav>

    <!-- Footer -->
    <div class="px-4 py-4 border-t border-[#D1A300] text-sm text-center">
        &copy; {{ date('Y') }} ZAG MMS <br> POWERED BY ZAGMEDIA TEAM<br>
        <span class="text-xs">Version 1.0</span>
    </div>
</aside>
