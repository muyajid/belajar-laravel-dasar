@props(['active' => false, 'href' => '#'])

@php
$classes = $active
    ? 'flex items-center p-2 text-gray-900 bg-gray-200 dark:bg-gray-700 rounded-lg dark:text-white group'
    : 'flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{-- Icon slot opsional --}}
    @if (isset($icon))
        <span class="w-6 h-6 text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white">
            {{ $icon }}
        </span>
    @endif

    <span class="flex-1 ms-3 whitespace-nowrap">
        {{ $slot }}
    </span>
</a>