@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-6">{{ isset($homecell) ? 'Edit Homecell' : 'Add New Homecell' }}</h1>

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($homecell) ? route('homecells.update', $homecell->id) : route('homecells.store') }}" method="POST">
        @csrf
        @if(isset($homecell))
            @method('PUT')
        @endif

        <div class="mb-4">
            <label class="block font-semibold mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $homecell->name ?? '') }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Leader</label>
            <input type="text" name="leader" value="{{ old('leader', $homecell->leader ?? '') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Description</label>
            <textarea name="description" class="w-full border rounded px-3 py-2" rows="4">{{ old('description', $homecell->description ?? '') }}</textarea>
        </div>

        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-500">
            {{ isset($homecell) ? 'Update Homecell' : 'Add Homecell' }}
        </button>
    </form>
</div>
@endsection
