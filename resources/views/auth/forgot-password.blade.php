@extends('layouts.app')

@section('title', 'Forgot-Password')

@section('content')
<div class="container-fluid vh-100 bg-light">
    <div class="row justify-content-center">
        <div class="col-12 card col-md-5 m-3 pb-3">
            <h3 class="card-header bg-white ps-0">D2 LABORATORY</h3>
            <div class="mb-4 text-sm fw-bold">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" :type="session('type')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <div class="d-flex align-items-center justify-content-end mt-4">
                        <button class="btn btn-dark" type="submit"> {{ __('Email Password Reset Link') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection