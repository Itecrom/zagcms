@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <!-- Top Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="p-4 bg-yellow-500 text-white rounded">Total Users: {{ $totalUsers }}</div>
    <div class="p-4 bg-blue-900 text-white rounded">Total Members: {{ $totalMembers }}</div>
    <div class="p-4 bg-yellow-500 text-white rounded">Total Homecells: {{ $totalHomecells }}</div>
    <div class="p-4 bg-blue-900 text-white rounded">Total Ministries: {{ $totalMinistries }}</div>
</div>

<h2 class="mt-6 text-lg font-bold">Members by Ministry</h2>
<ul>
    @foreach($membersByMinistry as $ministry)
        <li>{{ $ministry->name }}: {{ $ministry->members_count }}</li>
    @endforeach
</ul>

<h2 class="mt-6 text-lg font-bold">Members by Homecell</h2>
<ul>
    @foreach($membersByHomecell as $homecell)
        <li>{{ $homecell->name }}: {{ $homecell->members_count }}</li>
    @endforeach
</ul>

<h2 class="mt-6 text-lg font-bold">Members by Age Group</h2>
<ul>
    @foreach($ageGroups as $group => $count)
        <li>{{ $group }}: {{ $count }}</li>
    @endforeach
</ul>

</div>
@endsection
