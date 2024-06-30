@props(['name', 'label'])

<div class="form-check">
    <input class="form-check-input" type="checkbox" name="{{ $name }}" id="{{ $name }}" {{ $attributes }}>
    <label class="form-check-label" for="{{ $name }}">
        {{ $label }}
    </label>
</div>
