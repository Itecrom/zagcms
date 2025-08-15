@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Add Homecell</h1>

    <form action="{{ route('homecells.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded" required>
            </div>
            <div>
                <label class="block font-medium text-gray-700">Leader</label>
                <input type="text" name="leader" value="{{ old('leader') }}" class="mt-1 block w-full border-gray-300 rounded">
            </div>
            <div class="col-span-2">
                <label class="block font-medium text-gray-700">Description</label>
                <textarea name="description" class="mt-1 block w-full border-gray-300 rounded" rows="4">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-500">Add Homecell</button>
        </div>
    </form>
</div>
@endsection
