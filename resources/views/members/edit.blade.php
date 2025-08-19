@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">{{ isset($member) ? 'Edit Member' : 'Add Member' }}</h1>

    <form action="{{ isset($member) ? route('members.update', $member->id) : route('members.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($member))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $member->name ?? '') }}" class="mt-1 block w-full border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Surname</label>
                <input type="text" name="surname" value="{{ old('surname', $member->surname ?? '') }}" class="mt-1 block w-full border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Date of Birth</label>
                <input type="date" name="dob" value="{{ old('dob', $member->dob ?? '') }}" class="mt-1 block w-full border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $member->phone ?? '') }}" class="mt-1 block w-full border-gray-300 rounded">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Homecell</label>
                <select name="homecell_id" class="mt-1 block w-full border-gray-300 rounded" required>
                    <option value="">Select Homecell</option>
                    @foreach($homecells as $hc)
                        <option value="{{ $hc->id }}" {{ (old('homecell_id', $member->homecell_id ?? '') == $hc->id) ? 'selected' : '' }}>{{ $hc->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Ministry</label>
                <select name="ministry_id" class="mt-1 block w-full border-gray-300 rounded" required>
                    <option value="">Select Ministry</option>
                    @foreach($ministries as $min)
                        <option value="{{ $min->id }}" {{ (old('ministry_id', $member->ministry_id ?? '') == $min->id) ? 'selected' : '' }}>{{ $min->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Picture</label>
                <input type="file" name="picture" class="mt-1 block w-full">
                @if(isset($member) && $member->picture)
                    <img src="{{ asset('storage/'.$member->picture) }}" class="mt-2 h-20 w-20 object-cover rounded">
                @endif
            </div>
            <div>
                <label class="block font-medium text-gray-700">Marital Status</label>
                <input type="text" name="marital_status" value="{{ old('marital_status', $member->marital_status ?? '') }}" class="mt-1 block w-full border-gray-300 rounded">
            </div>
            <div>
                <label class="block font-medium text-gray-700">Employment Status</label>
                <input type="text" name="employment_status" value="{{ old('employment_status', $member->employment_status ?? '') }}" class="mt-1 block w-full border-gray-300 rounded">
            </div>

            <!-- Status Radio Buttons -->
            <div class="col-span-2 mt-4">
                <label class="block font-medium text-gray-700 mb-2">Status</label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-1">
                        <input type="radio" name="status" value="active" 
                            {{ old('status', isset($member) ? ($member->active ? 'active' : ($member->transferred ? 'transferred' : ($member->deceased ? 'deceased' : ''))) : '') === 'active' ? 'checked' : '' }}>
                        Active
                    </label>
                    <label class="flex items-center gap-1">
                        <input type="radio" name="status" value="transferred" 
                            {{ old('status', isset($member) ? ($member->active ? 'active' : ($member->transferred ? 'transferred' : ($member->deceased ? 'deceased' : ''))) : '') === 'transferred' ? 'checked' : '' }}>
                        Transferred
                    </label>
                    <label class="flex items-center gap-1">
                        <input type="radio" name="status" value="deceased" 
                            {{ old('status', isset($member) ? ($member->active ? 'active' : ($member->transferred ? 'transferred' : ($member->deceased ? 'deceased' : ''))) : '') === 'deceased' ? 'checked' : '' }}>
                        Deceased
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-500">
                {{ isset($member) ? 'Update Member' : 'Add Member' }}
            </button>
        </div>
    </form>
</div>
@endsection
