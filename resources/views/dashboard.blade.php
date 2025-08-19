@extends('layouts.app')

@section('content')
<div class="p-6 space-y-8">

    <!-- Top Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-xl shadow-lg p-5 flex items-center space-x-4">
            <i class="fas fa-users fa-2x"></i>
            <div>
                <p class="text-sm">Total Users</p>
                <h3 class="text-xl font-bold">{{ $totalUsers }}</h3>
            </div>
        </div>
        <div class="bg-gradient-to-r from-green-500 to-green-700 text-white rounded-xl shadow-lg p-5 flex items-center space-x-4">
            <i class="fas fa-user-friends fa-2x"></i>
            <div>
                <p class="text-sm">Total Members</p>
                <h3 class="text-xl font-bold">{{ $totalMembers }}</h3>
            </div>
        </div>
        <div class="bg-gradient-to-r from-purple-500 to-purple-700 text-white rounded-xl shadow-lg p-5 flex items-center space-x-4">
            <i class="fas fa-home fa-2x"></i>
            <div>
                <p class="text-sm">Total Homecells</p>
                <h3 class="text-xl font-bold">{{ $totalHomecells }}</h3>
            </div>
        </div>
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-700 text-white rounded-xl shadow-lg p-5 flex items-center space-x-4">
            <i class="fas fa-church fa-2x"></i>
            <div>
                <p class="text-sm">Total Ministries</p>
                <h3 class="text-xl font-bold">{{ $totalMinistries }}</h3>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-lg font-semibold mb-4">Members by Ministry</h2>
            <canvas id="ministryChart"></canvas>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-lg font-semibold mb-4">Members by Homecell</h2>
            <canvas id="homecellChart"></canvas>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h2 class="text-lg font-semibold mb-4">Members by Age Group</h2>
            <canvas id="ageGroupChart"></canvas>
        </div>
    </div>

    <!-- Birthday Section -->
    <div class="bg-white p-6 rounded-xl shadow-lg mt-8">
        <h2 class="text-lg font-semibold mb-4">Birthdays This Month</h2>
        @if($birthdaysThisMonth->isEmpty())
            <p class="text-gray-500">No birthdays this month.</p>
        @else
        <ul class="divide-y divide-gray-200">
            @foreach($birthdaysThisMonth as $member)
               <li class="py-2 flex justify-between items-center">
                <span>{{ $member->name }} {{ $member->surname }}</span>
                <span class="text-sm text-gray-400">{{ $member->formatted_dob }}</span>
            </li>
            @endforeach

            </ul>
        @endif
    </div>

</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart data
    const ministryLabels = @json($membersByMinistry->pluck('name'));
    const ministryData = @json($membersByMinistry->pluck('members_count'));

    const homecellLabels = @json($membersByHomecell->pluck('name'));
    const homecellData = @json($membersByHomecell->pluck('members_count'));

    const ageLabels = @json(array_keys($ageGroups));
    const ageData = @json(array_values($ageGroups));

    // Ministry Chart
    new Chart(document.getElementById('ministryChart'), {
        type: 'bar',
        data: {
            labels: ministryLabels,
            datasets: [{
                label: 'Members',
                data: ministryData,
                backgroundColor: ministryLabels.map(() => 'rgba(59, 130, 246, 0.7)'),
                borderColor: ministryLabels.map(() => 'rgba(59, 130, 246, 1)'),
                borderWidth: 1
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false }, tooltip: { enabled: true } }, scales: { y: { beginAtZero: true } } }
    });

    // Homecell Chart
    new Chart(document.getElementById('homecellChart'), {
        type: 'bar',
        data: {
            labels: homecellLabels,
            datasets: [{
                label: 'Members',
                data: homecellData,
                backgroundColor: homecellLabels.map(() => 'rgba(139, 92, 246, 0.7)'),
                borderColor: homecellLabels.map(() => 'rgba(139, 92, 246, 1)'),
                borderWidth: 1
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false }, tooltip: { enabled: true } }, scales: { y: { beginAtZero: true } } }
    });

    // Age Group Chart
    new Chart(document.getElementById('ageGroupChart'), {
        type: 'pie',
        data: {
            labels: ageLabels,
            datasets: [{
                label: 'Members',
                data: ageData,
                backgroundColor: ['#f87171', '#fbbf24', '#34d399', '#60a5fa', '#a78bfa']
            }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' }, tooltip: { enabled: true } } }
    });
</script>
@endsection
