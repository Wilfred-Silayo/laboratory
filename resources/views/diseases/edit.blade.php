@extends('layouts.app')

@section('title', 'Test')

@section('content')

<div class="container-fluid p-4 mt-1 bg-white">
    <x-auth-session-status :status="session('status')" :type="session('type')" />
    <h3 class="mb-4">Edit Test</h3>
    <form method="POST" action="{{ route('tests.update', $test->id) }}">
        @csrf
        @method('PUt')

        <div class="mb-3 col-12 col-sm-8 col-md-6">
            <x-input-label for="test_code" :value="__('Test Code')" />
            <x-text-input id="test_code" type="text" name="test_code" :value="old('test_code',$test->test_code)" placeholder="Eg. MRDT" required autofocus autocomplete="test_code" />
            <x-input-error :messages="$errors->get('test_code')" class="mt-2" />
        </div>

        <div class="mb-3 col-12 col-sm-8 col-md-6">
            <x-input-label for="test_name" :value="__('Test Name')" />
            <x-text-input id="test_name" type="text" name="test_name" :value="old('test_name',$test->test_name)" placeholder="Eg. Malaria Rapid Diagnosis Test" required autofocus autocomplete="test_name" />
            <x-input-error :messages="$errors->get('test_name')" class="mt-2" />
        </div>

        <div class="mb-3 col-12 col-sm-8 col-md-6">
            <x-input-label for="test_for" :value="__('Test For')" />
            <x-text-input id="test_for" type="text" name="test_for" :value="old('test_for',$test->test_for)" placeholder="Eg. Malaria" required autocomplete="test_for" />
            <x-input-error :messages="$errors->get('test_for')" class="mt-2" />
        </div>

        <div class="mb-3 col-12 col-sm-8 col-md-6">
            <x-input-label for="test_price" :value="__('Test For')" />
            <x-text-input id="test_price" type="number" name="test_price" :value="old('test_price',$test->test_price)" placeholder="Eg. 1000" required autocomplete="test_price" />
            <x-input-error :messages="$errors->get('test_price')" class="mt-2" />
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

@endsection