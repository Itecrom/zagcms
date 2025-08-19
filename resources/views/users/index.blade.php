@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">User Management</h1>
        <a href="{{ route('users.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-500">Add User</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse($users as $user)
        <div class="flex items-center justify-between p-4 bg-white rounded shadow hover:shadow-lg transition">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h2>
                <p class="text-gray-600 text-sm">{{ $user->email }}</p>
                <span class="px-2 py-1 bg-blue-500 text-white rounded text-xs">{{ $user->roles->pluck('name')->first() }}</span>
            </div>

            <div class="flex space-x-2">
                <a href="{{ route('users.edit', $user->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-400 text-sm">Edit</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-500 text-sm">Delete</button>
                </form>
            </div>
        </div>
        @empty
        <div class="p-4 text-center text-gray-500 bg-white rounded shadow">
            No users found.
        </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection
