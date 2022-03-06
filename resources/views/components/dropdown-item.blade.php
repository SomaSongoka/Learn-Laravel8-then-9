@props(['active' => false])
{{--<a href="{{ $href }}" {{$attributes->class("block text-left px-3 text-sm leading-6 hover:bg-blue-300 focus:bg-blue-300 hover:text-white focus:text-white")}}>--}}
{{--    {{$slot}}--}}
{{--</a>--}}

{{-- Check If Active --}}
@php
    $classes = "block text-left px-3 text-sm leading-6 hover:bg-blue-300 focus:bg-blue-300 hover:text-white focus:text-white";
    ($active) ? $classes .= " bg-blue-300 text-white" : '';
@endphp

{{-- OR --}}
<a {{$attributes(['class' => $classes])}}>
    {{$slot}}
</a>
