@props(['href', 'active'])

@php
$classes = ($active ?? false)
            ? 'block px-4 py-2 text-gray-900 font-medium bg-gray-100 rounded'
            : 'block px-4 py-2 text-gray-700 hover:bg-gray-50 rounded';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
