@extends('layouts.app')

@section('title', 'Patient History')

@section('content')
<div class="container-fluid card p-4">
    <h5>Patient name: <span class="text-primary fw-bold">{{ $patient->name }}</span></h5>
    <h6>Consultation History</h6>

    @if($consultations->isEmpty())
    <div class="alert alert-info">
        No consultations found for this patient.
    </div>
    @else
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Consultation Date</th>
                    <th>Consultation Notes</th>
                    <th>Plan</th>
                    <th>Test</th>
                    <th>Lab Result</th>
                    <th>Lab Comment</th>
                </tr>
            </thead>
            <tbody>
                @foreach($consultations as $consultation)
                <tr>
                    <td>{{ $consultation->created_at->format('Y-m-d') }}</td>
                    <td>{{ $consultation->symptoms }}</td>
                    <td>{{ $consultation->clinical_comment }}</td>
                    <td>
                        @foreach($consultation->tests as $test)
                        <span>{{ $test->test_code }}</span><br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($consultation->orders as $test)
                        <span>{{ $test->comment }}</span><br>
                        @endforeach
                    </td>
                    <td>{{ $consultation->result_comment }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection