@extends('layouts.app')
@section('title','Reports')
@section('content')

<div class="container-fluid card m-1 pb-3">
    <h4 class="mt-3">Select Month for Financial Report</h4>

    <form action="{{ route('reports.create') }}" method="GET">
        <div class="form-group">
            <label for="month" class="form-label">Month</label>
            <input type="month" name="month" id="month" class="form-control col-12 col-sm-5 col-md-4" required>
        </div>
        <button type="submit" class="btn btn-primary">Generate Report</button>
    </form>
</div>
    
@endsection
