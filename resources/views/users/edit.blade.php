@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit User</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label>Password (leave blank if unchanged)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                <option value="homecell_pastor" {{ $user->role == 'homecell_pastor' ? 'selected' : '' }}>Homecell Pastor</option>
                <option value="ministry_leader" {{ $user->role == 'ministry_leader' ? 'selected' : '' }}>Ministry Leader</option>
            </select>
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
