@extends('layouts.app')
@section('title','System')
@section('content')
<div class="container-fluid">
    <div class="col-12 m-1 p-4 card">
        <x-auth-session-status :status="session('status')" :type="session('type')" />
        <h5 class="fw-bold p-2 border-bottom">Edit System Information, this will apply to all reports</h5>
        <form action="{{route('system.update',$system->id)}}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3 col-12 col-sm-8 col-md-6">
                <x-input-label for="system_name" :value="__('System Name')" />
                <x-text-input id="system_name" type="text" name="system_name" :value="old('system_name', $system->system_name)" required autofocus autocomplete="system_name" />
                <x-input-error :messages="$errors->get('system_name')" class="mt-2" />
            </div>

            <div class="mb-3 col-12 col-sm-8 col-md-6">
                <x-input-label for="email" :value="__('System Email')" />
                <x-text-input id="email" type="email" name="email" :value="old('email', $system->email)" required autofocus autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mb-3 col-12 col-sm-8 col-md-6">
                <x-input-label for="phone" :value="__('System Phone')" />
                <x-text-input id="phone" type="phone" name="phone" :value="old('phone', $system->phone)" required autofocus autocomplete="phone" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <button type="submit" class="btn btn-primary">Update</button>

        </form>
    </div>
</div>

@endsection