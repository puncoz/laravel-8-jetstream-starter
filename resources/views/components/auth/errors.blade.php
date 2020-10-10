@props(['name' => 'error'])

@if($errors->has($name))
    <div class="bg-danger-100 border border-danger-400 text-danger-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"> {{ $errors->first($name) }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3"/>
    </div>
@endif



