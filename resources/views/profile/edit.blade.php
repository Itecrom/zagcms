@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Profile</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label class="block mb-1 font-medium">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                class="w-full border px-3 py-2 rounded" required>
            @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                class="w-full border px-3 py-2 rounded" required>
            @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </div>
    </form>

    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-secondary"
            onclick="return confirm('Are you sure you want to delete your account?')">
            Delete Account
        </button>
    </form>
</div>
@endsection
