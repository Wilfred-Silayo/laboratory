<!DOCTYPE html>
<html>
<head>
    <title>Financial Report</title>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1>Financial Report for {{ $month }}</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>PID</th>
                    <th>Full Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Visit Date</th>
                    <th>Lab Tests</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($consultations as $consultation)
                    <tr>
                        <td>{{ $consultation->patient->id }}</td>
                        <td>{{ $consultation->patient->full_name }}</td>
                        <td>{{ $consultation->patient->age }}</td>
                        <td>{{ $consultation->patient->gender }}</td>
                        <td>{{ $consultation->created_at->format('Y-m-d') }}</td>
                        <td>
                            @foreach($consultation->orders as $order)
                                {{ $order->test->name }} ({{ $order->test->price }})<br>
                            @endforeach
                        </td>
                        <td>
                            {{ $consultation->orders->sum(function($order) {
                                return $order->test->price;
                            }) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
