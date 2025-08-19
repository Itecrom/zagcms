@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <!-- Filters -->
    <div class="bg-white p-4 rounded shadow mb-6 flex flex-wrap gap-4 items-end print:hidden">
        <form method="GET" action="{{ route('members.index') }}" class="flex flex-wrap gap-4 items-end w-full">
            <div>
                <label class="block text-sm font-medium text-gray-700">Homecell</label>
                <select name="homecell_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">All</option>
                    @foreach($homecells as $hc)
                        <option value="{{ $hc->id }}" @selected(request('homecell_id') == $hc->id)>{{ $hc->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Ministry</label>
                <select name="ministry_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">All</option>
                    @foreach($ministries as $m)
                        <option value="{{ $m->id }}" @selected(request('ministry_id') == $m->id)>{{ $m->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">All</option>
                    <option value="active" @selected(request('status') == 'active')>Active</option>
                    <option value="transferred" @selected(request('status') == 'transferred')>Transferred</option>
                    <option value="deceased" @selected(request('status') == 'deceased')>Deceased</option>
                </select>
            </div>

            <div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700">
                    Filter
                </button>
            </div>

            <div>
                <a href="{{ route('members.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md shadow hover:bg-gray-400">Reset</a>
            </div>
        </form>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6 print:hidden">
        <div class="bg-white shadow rounded-lg p-4 text-center">
            <div class="text-gray-500 text-sm">Total Members</div>
            <div class="text-2xl font-bold text-gray-800">{{ $totalMembers }}</div>
        </div>
        <div class="bg-green-100 shadow rounded-lg p-4 text-center">
            <div class="text-green-800 text-sm">Active Members</div>
            <div class="text-2xl font-bold text-green-900">{{ $activeMembers }}</div>
        </div>
        <div class="bg-yellow-100 shadow rounded-lg p-4 text-center">
            <div class="text-yellow-800 text-sm">Transferred Members</div>
            <div class="text-2xl font-bold text-yellow-900">{{ $transferredMembers }}</div>
        </div>
        <div class="bg-red-100 shadow rounded-lg p-4 text-center">
            <div class="text-red-800 text-sm">Deceased Members</div>
            <div class="text-2xl font-bold text-red-900">{{ $deceasedMembers }}</div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-end mb-4 gap-2 flex-wrap print:hidden">
        <a href="{{ route('members.create') }}" class="px-4 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700">Add Member</a>
        <a href="{{ route('members.exportExcel', request()->all()) }}" class="px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700">Export Excel</a>
        <a href="{{ route('members.exportPDF', request()->all()) }}" class="px-4 py-2 bg-red-600 text-white rounded shadow hover:bg-red-700">Export PDF</a>
        <button onclick="window.print();" class="px-4 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700">Print</button>
    </div>

    <!-- Members Table -->
    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                <tr>
                    <th class="px-4 py-2 text-left">#</th>
                    <th class="px-4 py-2 text-left">Full Name</th>
                    <th class="px-4 py-2 text-left">Phone</th>
                    <th class="px-4 py-2 text-left">Homecell</th>
                    <th class="px-4 py-2 text-left">Ministry</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left print:hidden">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm">
                @forelse($members as $member)
                    <tr>
                        <td class="px-4 py-2">{{ $loop->iteration + ($members->currentPage() - 1) * $members->perPage() }}</td>
                        <td class="px-4 py-2">{{ $member->name }} {{ $member->surname }}</td>
                        <td class="px-4 py-2">{{ $member->phone ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $member->homecell->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $member->ministry->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2">
                            @if($member->active)
                                <span class="text-green-700 font-semibold">Active</span>
                            @elseif($member->transferred)
                                <span class="text-yellow-700 font-semibold">Transferred</span>
                            @elseif($member->deceased)
                                <span class="text-red-700 font-semibold">Deceased</span>
                            @else
                                <span class="text-gray-500">Unknown</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 flex gap-2 print:hidden">
                            <a href="{{ route('members.edit', $member) }}" class="px-2 py-1 bg-blue-600 text-white rounded shadow hover:bg-blue-700 text-xs">Edit</a>
                            <form action="{{ route('members.destroy', $member) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded shadow hover:bg-red-700 text-xs">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-2 text-center text-gray-500">No members found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $members->links() }}
    </div>
</div>
@endsection
