<!DOCTYPE html>
<html>
<head>
    <title>Members PDF</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Members List</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th><th>Email</th><th>Phone</th><th>Ministry</th><th>Homecell</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->phone }}</td>
                    <td>{{ $member->ministry->name ?? 'N/A' }}</td>
                    <td>{{ $member->homecell->name ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
