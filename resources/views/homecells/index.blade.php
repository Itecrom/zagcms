@extends('layouts.app')

@section('content')
<div class="p-6 max-w-5xl mx-auto bg-white rounded shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">All Homecells</h1>

        <a href="{{ route('homecells.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-500">
            Add Homecell
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2 text-left">ID</th>
                    <th class="border px-4 py-2 text-left">Name</th>
                    <th class="border px-4 py-2 text-left">Leader</th>
                    <th class="border px-4 py-2 text-left">Description</th>
                    <th class="border px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($homecells as $homecell)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $homecell->id }}</td>
                        <td class="border px-4 py-2 font-medium">{{ $homecell->name }}</td>
                        <td class="border px-4 py-2">{{ $homecell->leader }}</td>
                        <td class="border px-4 py-2">{{ $homecell->description }}</td>
                        <td class="border px-4 py-2 space-x-2">
                            <a href="{{ route('homecells.edit', $homecell->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('homecells.destroy', $homecell->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border px-4 py-2 text-center text-gray-500">
                            No homecells found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $homecells->links() }}
    </div>
</div>
@endsection
