@extends('layouts.app')
@section('title','Reports')

@section('content')
<div class="container-fluid p-3 card m-1">
    <div class="row mb-2">
        <div class="col-md-8">
            <h3>Financial Report for {{ request('month') }}</h3>
        </div>
        @if(!$consultations->isEmpty())
        <div class="col">
            <a href="{{ route('reports.show', ['month' => request('month')]) }}" class="btn btn-primary">Download Pdf</a>
        </div>
        @endif
    </div>

    @if($consultations->isEmpty())
    <div class="alert alert-info mb-2 pb-2">No Report Information Found</div>
    @else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>PID</th>
                <th>Full Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Visit Date</th>
                <th>Lab Tests</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($consultations as $consultation)
            @if($consultation->completed)
            <tr>
                <td>{{ $consultation->patient->id }}</td>
                <td>{{ $consultation->patient->name }}</td>
                <td>{{ $consultation->patient->dob }}</td>
                <td>{{ $consultation->patient->sex }}</td>
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
            @endif
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection