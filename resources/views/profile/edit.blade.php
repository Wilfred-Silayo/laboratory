@extends('layouts.app')

@section('title', 'Edit-User')

@section('content')

<div class="container-fluid p-4 mt-1 bg-white">
    <x-auth-session-status :status="session('status')" :type="session('type')" />
    <h3 class="mb-4">Edit Profile</h3>
    <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3 col-12 col-sm-8 col-md-6">
            <x-input-label for="profile_pic" :value="__('Profile Picture')" />
            <x-text-input id="profile_pic" type="file" name="profile_pic" :value="old('profile_pic', $user->profile_pic)" required autofocus autocomplete="profile_pic" />
            <x-input-error :messages="$errors->get('profile_pic')" class="mt-2" />
        </div>

        <div class="mb-3 col-12 col-sm-8 col-md-6">
            <x-input-label for="title" :value="__('Title')" />
            <div>
                <x-radio-input id="title_mr" name="title" value="Mr" :checked="$user->title === 'Mr'" required />
                <x-input-label :value="'Mr'" for="title_mr" />

                <x-radio-input id="title_mrs" name="title" value="Mrs" :checked="$user->title === 'Mrs'" />
                <x-input-label :value="'Mrs'" for="title_mrs" />

                <x-radio-input id="title_miss" name="title" value="Miss" :checked="$user->title === 'Miss'" />
                <x-input-label :value="'Miss'" for="title_miss" />

                <x-radio-input id="title_prof" name="title" value="Prof" :checked="$user->title === 'Prof'" />
                <x-input-label :value="'Prof'" for="title_prof" />

                <x-radio-input id="title_dr" name="title" value="Dr" :checked="$user->title === 'Dr'" />
                <x-input-label :value="'Dr'" for="title_dr" />
            </div>
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div class="mb-3 col-12 col-sm-8 col-md-6">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" type="text" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mb-3 col-12 col-sm-8 col-md-6">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" type="tel" name="phone" :value="old('phone', $user->phone)" required autofocus autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div class="mb-3 col-12 col-sm-8 col-md-6">
            <x-input-label for="email" :value="__('Email')" />
            <p class="text-danger fw-bold">Please use valid email address only that you have access to it to avoid losing access to your account. You will be sent verification email to that new email address to verify.</p>
            <x-text-input id="email" type="email" name="email" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

@endsection