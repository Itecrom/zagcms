@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">Add New Member</h2>

    @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="name" placeholder="First Name" class="border p-2 rounded" required>
            <input type="text" name="surname" placeholder="Surname" class="border p-2 rounded" required>
            <input type="date" name="dob" class="border p-2 rounded" required>
            <input type="text" name="home_of_origin" placeholder="Home of Origin" class="border p-2 rounded">
            <input type="text" name="residential_home" placeholder="Residential Home" class="border p-2 rounded">
            <select name="homecell_id" class="border p-2 rounded" required>
                @foreach($homecells as $homecell)
                    <option value="{{ $homecell->id }}">{{ $homecell->name }}</option>
                @endforeach
            </select>
            <select name="ministry_id" class="border p-2 rounded" required>
                @foreach($ministries as $ministry)
                    <option value="{{ $ministry->id }}">{{ $ministry->name }}</option>
                @endforeach
            </select>
            <input type="file" name="picture" class="border p-2 rounded">
        </div>

        <button type="submit" class="mt-4 bg-[#D1A300] text-white px-4 py-2 rounded hover:bg-[#160285]">
            Save Member
        </button>
    </form>
</div>
@endsection
