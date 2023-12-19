<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>History</title>
</head>

<body>
    <div>
        <ul>
            <li>Member : {{ $package_user->user->name }}</li>
            <li>Active day : {{ $package_user->activity_day }}</li>
            <li>Expiration day : {{ $package_user->expiration_date }}</li>
        </ul>
    </div>
    @if($package_user->package_id !== 4)
    <h1 class="text-center">OutSide</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Balls</th>
            </tr>
        </thead>
        <tbody>
            @php $total_balls = 0; @endphp
            @foreach($items as $item)
            @if($item->balls)
            <tr>
                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                <td>{{ $item->balls }}</td>
            </tr>
            @php $total_balls += $item->balls; @endphp
            @endif
            @endforeach
        </tbody>
    </table>
    <ul>
        <li>Total Balls: {{ $total_balls }}</li>
    </ul>
    @endif
    @if($package_user->package_id === 4 || $package_user->package_id === 2)
    <h1 class="text-center">InSide</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>From</th>
                <th>To</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $total_hours = 0; @endphp
            @foreach($items as $item)
            @if(isset($item->total_hour) && $item->total_hour > 0)
            <tr>
                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                <td>{{ $item->hour_to }}</td>
                <td>{{ $item->to_hour }}</td>
                <td>{{ $item->total_hour }}</td>
            </tr>
            @endif
            @php $total_hours += $item->total_hour; @endphp
            @endforeach
        </tbody>
    </table>
    <ul>
        <li>Total Hours: {{ $total_hours }}</li>
    </ul>
    @endif
    @if($package_user->expiration_count)
    <h1 class="text-center">Expiration</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Expiration Date</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($package_user->expiration as $item)
            <tr>
                <td>{{ date('d-m-Y', strtotime($item->expiration_date)) }}</td>
                <td>{{ $item->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</body>

</html>