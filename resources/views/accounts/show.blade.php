@extends('layouts.app')
@section('title','Invoice')
@section('content')
<div class="container-fluid mt-1">
    <div class="card">
        <x-auth-session-status :status="session('status')" :type="session('type')" />

        <div class="card-header">
            <h1 class="mb-1">Invoice</h1>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-6">
                    <h5>Patient Information</h5>
                    <p><strong>ID:</strong> {{ $consultation->patient->id }}</p>
                    <p><strong>Full Name:</strong> {{ $consultation->patient->name }}</p>
                    <p><strong>Occupation:</strong> {{ $consultation->patient->occupation }}</p>

                </div>
                <div class="col-md-6 text-left">
                    <p><strong>Age:</strong> {{ \Carbon\Carbon::parse($consultation->patient->dob)->age }}</p>
                    <p><strong>Gender:</strong> {{ $consultation->patient->sex }}</p>
                    <p><strong>Address:</strong> {{ $consultation->patient->address }}</p>
                    <p><strong>Visit Date:</strong> {{ $consultation->created_at->format('Y-m-d') }}</p>
                </div>
            </div>

            <h5 class="mb-3">Tests</h5>
            <table class="table table-bordered">
                <thead>
                    <tr class="table-primary">
                        <th>Test</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->test_code }}</td>
                        <td>{{ number_format($order->test_price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <h4 class="text-right mt-4">Total Amount: {{ number_format($totalAmount, 2) }}</h4>
        </div>
        <div class="card-footer text-right">
            @if($consultation->account_status)
            <a href="{{ route('accounts.show', $consultation->id) }}" class="btn btn-primary">Download PDF</a>
            @else
            <form action="{{route('accounts.store')}}" method="POST">
                @csrf
                <input type="hidden" name="consultation_id" value="{{$consultation->id}}">
                <input type="hidden" name="status" value="Paid">
                <input type="hidden" name="total_amount" value="{{$totalAmount}}">
                <button type="submit" class="btn btn-primary">Mark As Paid</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection