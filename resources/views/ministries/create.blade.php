@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Add Ministry</h1>

    <form action="{{ route('ministries.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block font-medium">Name</label>
            <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block font-medium">Description</label>
            <textarea name="description" class="mt-1 block w-full border-gray-300 rounded"></textarea>
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500">Add Ministry</button>
    </form>
</div>
@endsection
