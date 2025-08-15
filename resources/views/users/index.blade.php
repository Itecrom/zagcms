@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">User Management</h1>
        <a href="{{ route('users.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-500 shadow">Add User</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search & Filter Row -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 space-y-2 sm:space-y-0">
        <input type="text" placeholder="Search users..." class="px-3 py-2 border rounded w-full sm:w-1/3">
        <div class="flex space-x-2">
            <select class="px-3 py-2 border rounded">
                <option value="">All Roles</option>
                <option value="admin">Admin</option>
                <option value="moderator">Moderator</option>
            </select>
            <select class="px-3 py-2 border rounded">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
    </div>

    <div class="space-y-4">
        @forelse($users as $user)
        <div class="flex items-center justify-between p-4 bg-white rounded shadow hover:shadow-lg transition duration-300">
            <div class="flex items-center space-x-4">
                <!-- Avatar -->
                @if($user->avatar)
                    <img src="{{ asset('storage/'.$user->avatar) }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-full object-cover">
                @else
                    <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-gray-700 font-bold text-lg">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif

                <div>
                    <h2 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h2>
                    <p class="text-gray-600 text-sm">{{ $user->email }}</p>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Role Badge -->
                <span class="px-3 py-1 rounded text-white text-sm 
                    @switch($user->role)
                        @case('admin') bg-red-500 @break
                        @case('moderator') bg-blue-500 @break
                        @default bg-gray-500
                    @endswitch
                ">
                    {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                </span>

                <!-- Status Badge -->
                <span class="px-3 py-1 rounded text-white text-sm {{ $user->active ? 'bg-green-500' : 'bg-gray-400' }}">
                    {{ $user->active ? 'Active' : 'Inactive' }}
                </span>

                <!-- Actions -->
                <div class="flex space-x-2">
                    <a href="{{ route('users.edit', $user->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-400 text-sm">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-500 text-sm">Delete</button>
                    </form>
                </div>
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
