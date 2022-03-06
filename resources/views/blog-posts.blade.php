{{-- Extend the Layout --}}
{{--@extends('components.layout')--}}

{{-- Declare the section --}}
{{--@section('content')--}}

{{--    --}}{{-- Or we can just add values inside this area and it will be assign to variable slot inside our component --}}
{{--    @foreach ($posts as $post)--}}
{{--        <div class="col-md-4 col-sm-12 mb-5 {{ $loop->even ? 'foobar' : 'foo' }}">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <a href="/blog/{{ $post->slug }}">--}}
{{--                        <h1 class="card-title">{{ $post->title }} </h1>--}}
{{--                    </a>--}}

{{--                    <h6 class="card-title">--}}
{{--                        Category: <a href="/blog/category/{{ $post->category->slug }}">{{ $post->category->name }}</a>--}}
{{--                    </h6>--}}


{{--                    {!! $post->excerpt !!}--}}
{{--                    <p class="card-text">--}}
{{--                        <small class="text-muted">Last updated {{ $post->date }}</small>--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endforeach--}}
{{--@endsection--}}

<x-layout>

{{-- We can load a partial section eg header here and name the file using underscore but that is not a must --}}
    @include('_posts-header')

<main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
    {{-- Now we can load our post-featured-card component --}}
    @if($posts->count())

    <x-post-featured-card :post="$posts[0]" />

    <div class="lg:grid lg:grid-cols-6">
        @if($posts->count() > 1)
            {{-- load our post-card component twice --}}
            @foreach ($posts->skip(1) as $post)
                <x-post-card :post="$post" class="col-span-2" />
            @endforeach
        @endif
    </div>
    @endif

    <div class="lg:grid lg:grid-cols-3">
        {{-- load our post-card component 3 times --}}
{{--        <x-post-card />--}}
{{--        <x-post-card />--}}
{{--        <x-post-card />--}}
        {{-- Now we can load our post-card component --}}
    </div>
</main>

</x-layout>
