<aside class="w-64 bg-white border-r border-gray-200 min-h-screen hidden md:block">
    <div class="p-6">
        <a href="{{ route('dashboard') }}" class="text-xl font-semibold text-gray-800">
            {{ config('app.name', 'Laravel') }}
        </a>
    </div>

    <nav class="mt-6">
        <ul class="space-y-2">
            <li>
                <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    Dashboard
                </x-sidebar-link>
            </li>

            @if(Auth::user()->role === 'super_admin')
            <li>
                <x-sidebar-link :href="route('homecells.index')" :active="request()->routeIs('homecells.*')">
                    Homecells
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link :href="route('ministries.index')" :active="request()->routeIs('ministries.*')">
                    Ministries
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link :href="route('members.index')" :active="request()->routeIs('members.*')">
                    Members
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link :href="route('families.index')" :active="request()->routeIs('families.*')">
                    Families
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link :href="route('reports.index')" :active="request()->routeIs('reports.*')">
                    Reports
                </x-sidebar-link>
            </li>
            @endif

            @if(Auth::user()->role === 'homecell_pastor' || Auth::user()->role === 'ministry_leader')
            <li>
                <x-sidebar-link :href="route('members.index')" :active="request()->routeIs('members.*')">
                    Members
                </x-sidebar-link>
            </li>
            @endif
        </ul>
    </nav>
</aside>
