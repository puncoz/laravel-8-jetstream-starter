@props(['name' => null])

@if ($errors->has($name))
    <span class="font-medium text-danger-600 text-xs">
        {{ $errors->first($name) }}
    </span>
@endif
