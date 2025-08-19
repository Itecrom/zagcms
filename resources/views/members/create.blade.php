@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Add New Member</h1>

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">First Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">Surname</label>
                <input type="text" name="surname" value="{{ old('surname') }}" class="w-full border rounded px-3 py-2" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Date of Birth</label>
                <input type="date" name="dob" value="{{ old('dob') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Home of Origin</label>
                <input type="text" name="home_of_origin" value="{{ old('home_of_origin') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-semibold mb-1">Residential Home</label>
                <input type="text" name="residential_home" value="{{ old('residential_home') }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Homecell</label>
                <select name="homecell_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Select Homecell</option>
                    @foreach($homecells as $hc)
                        <option value="{{ $hc->id }}" {{ old('homecell_id') == $hc->id ? 'selected' : '' }}>
                            {{ $hc->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-semibold mb-1">Ministry</label>
                <select name="ministry_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Select Ministry</option>
                    @foreach($ministries as $m)
                        <option value="{{ $m->id }}" {{ old('ministry_id') == $m->id ? 'selected' : '' }}>
                            {{ $m->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Marital Status</label>
                <input type="text" name="marital_status" value="{{ old('marital_status') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-semibold mb-1">Employment Status</label>
                <input type="text" name="employment_status" value="{{ old('employment_status') }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div>
            <label class="block font-semibold mb-1">Profile Picture</label>
            <input type="file" name="picture" class="w-full">
        </div>

        {{-- Status radio buttons --}}
        <div class="flex gap-6 mt-4 items-center">
            <label>
                <input type="radio" name="status" value="active" {{ old('status') == 'active' ? 'checked' : '' }}>
                Active
            </label>
            <label>
                <input type="radio" name="status" value="transferred" {{ old('status') == 'transferred' ? 'checked' : '' }}>
                Transferred
            </label>
            <label>
                <input type="radio" name="status" value="deceased" {{ old('status') == 'deceased' ? 'checked' : '' }}>
                Deceased
            </label>
        </div>

        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-500 mt-6">
            Add Member
        </button>
    </form>
</div>
@endsection
