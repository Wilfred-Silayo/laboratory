<!-- resources/views/components/x-radio-input.blade.php -->

@props(['id', 'name', 'value', 'checked' => false])

<input type="radio" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" {{ $checked ? 'checked' : '' }} {{ $attributes->merge(['class' => 'form-radio-control']) }}>
