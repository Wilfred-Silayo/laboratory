@extends('layouts.app')

@section('title', 'Edit Password')

@section('content')
<div class="container-fluid bg-white">
    <div class="card p-3">
        <x-auth-session-status :status="session('status')" :type="session('type')" />

        <p class="fw-bold">Edit your password</p>
        <p class="fw-bold text-danger">Please make sure you use strong passwords to stay secure.</p>
        <p class="fw-bold text-sm text-danger">Strong password contains symbols, uppercase, lowercase and numbers</p>
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Current Password -->
            <div class="mt-2 col-12 col-sm-8 col-md-6">
                <x-input-label for="current_password" :value="__('Current Password')" />
                <x-text-input id="current_password" type="password" name="current_password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
            </div>

            <!-- New Password -->
            <div class="mt-4 col-12 col-sm-8 col-md-6">
                <x-input-label for="password" :value="__('New Password')" />
                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm New Password -->
            <div class="mt-4 col-12 col-sm-8 col-md-6">
                <x-input-label for="password_confirmation" :value="__('Confirm New Password')" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="mt-4">
                <button class="btn btn-primary" type="submit">{{ __('Update Password') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
