<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Members PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
        .filters { margin-bottom: 15px; }
    </style>
</head>
<body>
    <h2>Church Members List</h2>

    @if($homecellName || $ministryName)
        <div class="filters">
            @if($homecellName)
                <strong>Homecell:</strong> {{ $homecellName }}<br>
            @endif
            @if($ministryName)
                <strong>Ministry:</strong> {{ $ministryName }}
            @endif
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Date of Birth</th>
                <th>Phone</th>
                <th>Home of Origin</th>
                <th>Residential Home</th>
                <th>Homecell</th>
                <th>Ministry</th>
                <th>Marital Status</th>
                <th>Employment Status</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td>{{ $member->name }}</td>
                <td>{{ $member->surname }}</td>
                <td>{{ $member->dob->format('Y-m-d') }}</td>
                <td>{{ $member->phone }}</td>
                <td>{{ $member->home_of_origin }}</td>
                <td>{{ $member->residential_home }}</td>
                <td>{{ $member->homecell->name ?? '' }}</td>
                <td>{{ $member->ministry->name ?? '' }}</td>
                <td>{{ $member->marital_status }}</td>
                <td>{{ $member->employment_status }}</td>
                <td>{{ $member->active ? 'Active' : ($member->transferred ? 'Transferred' : 'Deceased') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p>Total Members: {{ $members->count() }}</p>
</body>
</html>
