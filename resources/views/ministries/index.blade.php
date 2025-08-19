@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">All Ministries</h1>

    <a href="{{ route('ministries.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-500">Add Ministry</a>

    @if(session('success'))
        <div class="mt-2 p-2 bg-green-200 rounded">{{ session('success') }}</div>
    @endif

    <table class="mt-4 w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ministries as $ministry)
            <tr>
                <td class="border px-4 py-2">{{ $ministry->id }}</td>
                <td class="border px-4 py-2">{{ $ministry->name }}</td>
                <td class="border px-4 py-2">{{ $ministry->description }}</td>
                <td class="border px-4 py-2">
                    <a href="{{ route('ministries.edit', $ministry->id) }}" class="text-blue-600">Edit</a>
                    <form action="{{ route('ministries.destroy', $ministry->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="border px-4 py-2 text-center text-gray-500">No ministries found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $ministries->links() }}
    </div>
</div>
@endsection
