@extends('layouts.app')
@section('title','Reports')

@section('content')
<div class="container-fluid card m-1 pb-3">
    <h2>Financial Report for {{ request('month') }}</h2>

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
                    <td>{{ $consultation->visit_date }}</td>
                    <td>
                        <ul>
                            @foreach($consultation->orders as $order)
                                <li>{{ $order->test_code }} - ${{ $order->test_price }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>${{ $consultation->account->total_amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
