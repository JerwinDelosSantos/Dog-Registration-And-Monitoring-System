@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'fs-5 badge bg-success']) }}>
        {{ $status }}
    </div>
@endif
