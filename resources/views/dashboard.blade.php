@extends('layouts.app')

@section('content')
<div class="p-6 space-y-8">

    <!-- Clock Display 
    <div class="flex justify-end">
        <div class="bg-white shadow-lg rounded-xl p-4 text-center w-40">
            <div class="text-gray-500 text-xs">Current Time</div>
            <div id="clock" class="text-2xl font-bold text-blue-700"></div>
        </div>
    </div>-->

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

    <!-- Export Buttons -->
<div class="flex flex-wrap justify-end gap-3">
    <a href="{{ route('export.members.excel', ['filter' => request('filter'), 'value' => request('value')]) }}" 
       class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow">
       <i class="fas fa-file-excel"></i> Export Excel
    </a>
    <a href="{{ route('export.members.pdf', ['filter' => request('filter'), 'value' => request('value')]) }}" 
       class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow">
       <i class="fas fa-file-pdf"></i> Export PDF
    </a>
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

</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        document.getElementById('clock').textContent = timeString;
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Data for charts
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
                backgroundColor: '#3b82f6'
            }]
        }
    });

    // Homecell Chart
    new Chart(document.getElementById('homecellChart'), {
        type: 'bar',
        data: {
            labels: homecellLabels,
            datasets: [{
                label: 'Members',
                data: homecellData,
                backgroundColor: '#8b5cf6'
            }]
        }
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
        }
    });
</script>
@endsection
