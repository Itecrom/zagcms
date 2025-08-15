@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">

    <div class="flex-1 flex flex-col">

        <!-- Header -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Members Dashboard</h1>
                @can('create', App\Models\Member::class)
                    <a href="{{ route('members.create') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2 px-4 rounded shadow">
                        Add Member
                    </a>
                @endcan
            </div>
        </header>

        <main class="flex-1 p-6">

            <!-- Filters -->
            <div class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                <form action="{{ route('members.index') }}" method="GET" class="flex gap-2 items-center">
                    <select name="homecell_id" class="border rounded px-3 py-2">
                        <option value="">All Homecells</option>
                        @foreach($homecells as $hc)
                            <option value="{{ $hc->id }}" {{ request('homecell_id') == $hc->id ? 'selected' : '' }}>
                                {{ $hc->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="ministry_id" class="border rounded px-3 py-2">
                        <option value="">All Ministries</option>
                        @foreach($ministries as $m)
                            <option value="{{ $m->id }}" {{ request('ministry_id') == $m->id ? 'selected' : '' }}>
                                {{ $m->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="status" class="border rounded px-3 py-2">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="transferred" {{ request('status') == 'transferred' ? 'selected' : '' }}>Transferred</option>
                        <option value="deceased" {{ request('status') == 'deceased' ? 'selected' : '' }}>Deceased</option>
                    </select>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500">Filter</button>
                </form>
            </div>

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-[#160285] text-white rounded-lg p-6 shadow flex flex-col items-center">
                    <div class="text-2xl font-bold">{{ $members->count() }}</div>
                    <div>Total Members</div>
                </div>
                <div class="bg-[#16A34A] text-white rounded-lg p-6 shadow flex flex-col items-center">
                    <div class="text-2xl font-bold">{{ $members->where('active', true)->count() }}</div>
                    <div>Active Members</div>
                </div>
                <div class="bg-[#D97706] text-white rounded-lg p-6 shadow flex flex-col items-center">
                    <div class="text-2xl font-bold">{{ $members->where('transferred', true)->count() }}</div>
                    <div>Transferred Members</div>
                </div>
                <div class="bg-[#DC2626] text-white rounded-lg p-6 shadow flex flex-col items-center">
                    <div class="text-2xl font-bold">{{ $members->where('deceased', true)->count() }}</div>
                    <div>Deceased Members</div>
                </div>
            </div>

            <!-- Members Table -->
            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-[#160285] text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Homecell</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Ministry</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($members as $member)
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $member->name }} {{ $member->surname }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ optional($member->homecell)->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ optional($member->ministry)->name }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if($member->active)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                @elseif($member->transferred)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Transferred</span>
                                @elseif($member->deceased)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Deceased</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Unknown</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm flex gap-2">
                                @can('update', $member)
                                    <a href="{{ route('members.edit', $member) }}" class="text-indigo-600 hover:underline">Edit</a>
                                @endcan
                                @can('delete', $member)
                                    <form action="{{ route('members.destroy', $member) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $members->links() }}
            </div>

        </main>

        <footer class="bg-gray-200 text-center py-4 mt-auto">
            <p class="text-gray-700">&copy; ZAG MEDIA TEAM, Version 1.0</p>
        </footer>

    </div>
</div>
@endsection
