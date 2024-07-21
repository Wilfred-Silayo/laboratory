@extends('layouts.app')

@section('title', 'Patients')

@section('content')
<div class="card p-4 col-12 mt-1 bg-white">
    <h3 class="fw-bold text-start text-md-center mt-2">Register a new patient</h3>
    <form method="POST" action="{{ route('patients.store') }}">
        @csrf
        <div class="row">
            <div class="col-12 col-sm-6">
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
            </div>

            <div class="col-12 col-sm-6 mt-4">
                <x-input-label :value="__('Gender')" />
                <div>
                    <x-radio-input id="male" name="sex" value="Male" :checked="old('sex') === 'Male'" class="ms-0" required />
                    <x-input-label :value="'Male'" for="male" />

                    <x-radio-input id="female" name="sex" value="Female" :checked="old('sex') === 'Female'" class="ms-2" />
                    <x-input-label :value="'Female'" for="female" />
                </div>
            </div>

        </div>
        <div class="row">
            <!-- Address -->
            <div class="col-12 col-sm-6">
                <div class="mt-4">
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input id="address" type="text" name="address" :value="old('address')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
            </div>

            <!-- Phone -->
            <div class="col-12 col-sm-6">
                <div class="mt-4">
                    <x-input-label for="phone" :value="__('Phone')" />
                    <x-text-input id="phone" type="phone" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-6">
                <!-- Date of Birth-->
                <div class="mt-4">
                    <x-input-label for="dob" :value="__('Date of Birth')" />
                    <x-text-input id="dob" type="date" name="dob" :value="old('dob')" required autofocus autocomplete="dob" />
                    <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                </div>
            </div>

            <!-- Occupation -->
            <div class="col-12 col-sm-6">
                <div class="mt-4">
                    <x-input-label for="occupation" :value="__('Occupation')" />
                    <x-text-input id="occupation" type="text" name="occupation" :value="old('occupation')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center bg-white justify-content-end my-4">
            <button type="submit" class="btn btn-dark ms-3">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</div>
@endsection