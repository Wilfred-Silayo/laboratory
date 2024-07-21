@extends('layouts.app')

@section('title', 'Lab Results')

@section('content')
<div class="container-fluid card p-4">
    <x-auth-session-status :status="session('status')" :type="session('type')" />

    <h5>Patient name: <span class="text-primary fw-bold">{{ $consultation->patient->name }}</span></h5>
    <h6>Consultation Results</h6>

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
                    <th>General Comment</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $consultation->created_at->format('Y-m-d') }}</td>
                    <td>{{ $consultation->symptoms }}</td>
                    <td>{{ $consultation->clinical_comment }}</td>
                    <td>
                        @foreach($results as $result)
                        <span>{{ $result->test_code }}</span><br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($results as $result)
                        <span>{{ $result->comment }}</span><br>
                        @endforeach
                    </td>
                    <td>{{$consultation->lab_comment}}</td>
                    <td>{{ $consultation->result_comment }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        <form action="{{ route('consultations.saveResult', $consultation->id) }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="result_comment">General Comment</label>
                <textarea class="form-control col-5 @error('result_comment') is-invalid @enderror" id="result_comment"
                    name="result_comment" rows="4"></textarea>
                @error('result_comment')
                <div class="invalid-feedback fw-bold">
                    General comment is required
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Discharge</button>
        </form>
        @if ($consultation->completed)
        <div class="d-flex justify-content-end">
            <a href="{{ route('consultations.print', $consultation->id) }}" class="btn btn-primary">Print</a>
        </div>
        @endif
    </div>
</div>
@endsection