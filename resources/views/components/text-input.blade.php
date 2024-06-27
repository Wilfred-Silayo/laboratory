@props(['type' => 'text', 'id' => '', 'name' => '', 'value' => '', 'autocomplete' => ''])

@php
    $classes = 'form-control';
    if ($errors->has($name)) {
        $classes .= ' is-invalid';
    }
@endphp

<input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" autocomplete="{{$autocomplete}}" class="{{ $classes }}" autofocus>
