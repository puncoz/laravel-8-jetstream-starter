@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-primary-shades-400']) }}>
    {{ $value ?? $slot }}
</label>
