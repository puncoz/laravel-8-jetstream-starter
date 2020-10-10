@props([
'disabled' => false,
'labelClass' => ''
])

<label class="{{ $labelClass }}">
    <input
        {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge(['class' => 'form-checkbox text-primary-shades-400', 'type' => 'checkbox']) !!} >
    {{ $slot }}
</label>
