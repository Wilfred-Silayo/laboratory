@extends('layouts.app')
@section('title', 'Laboratory')

@section('content')
<div class="container-fluid mt-1">
    <div class="card">
        <x-auth-session-status :status="session('status')" :type="session('type')" />
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card-header">
            <h5 class="mb-1">Laboratory Tests</h5>
        </div>

        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-6">
                    <h5>Clinical Comments</h5>
                    <p>{{ $consultation->order_comment }}</p>
                </div>
            </div>

            <form action="{{ route('labreports.store') }}" method="POST">
                @csrf
                <input type="hidden" name="consultation_id" value="{{$consultation->id}}">
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h5>General Lab Comment</h5>
                        <textarea name="lab_comment" class="form-control" rows="3">{{ old('lab_comment', $consultation->lab_comment) }}</textarea>
                    </div>
                </div>

                <h5 class="mb-3">Ordered Tests</h5>
                @foreach($orders as $order)
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>{{ $order->test_code }}</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="test_comments[{{ $order->id }}]" class="form-control" value="{{ old('test_comments.' . $order->id, $order->comment) }}">
                    </div>
                </div>
                @endforeach

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection