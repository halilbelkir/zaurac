@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-red-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none hover:text-red-700 focus:border-red-700 transition'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-red-700 hover:border-red-300 focus:outline-none focus:text-red-700 focus:border-red-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

