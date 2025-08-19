@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Edit User</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                   class="w-full px-3 py-2 border rounded">
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                   class="w-full px-3 py-2 border rounded">
            @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">New Password (optional)</label>
            <input type="password" name="password" class="w-full px-3 py-2 border rounded">
            @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full px-3 py-2 border rounded">
        </div>

        <!-- Roles -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Roles</label>
            <div class="flex flex-wrap gap-2">
                @foreach($roles as $role)
                    <label class="inline-flex items-center gap-2 px-3 py-1 border rounded cursor-pointer">
                        <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                            {{ $user->hasRole($role->name) ? 'checked' : '' }}
                            class="form-checkbox">
                        {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                    </label>
                @endforeach
            </div>
            @error('roles') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Active -->
        <div class="mb-4">
            <label class="inline-flex items-center gap-2">
                <input type="checkbox" name="active" value="1" {{ $user->active ? 'checked' : '' }}>
                Active
            </label>
        </div>

        <!-- Submit -->
        <div class="mt-6">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500 shadow">
                Update User
            </button>
            <a href="{{ route('users.index') }}" class="ml-4 px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-200">Cancel</a
