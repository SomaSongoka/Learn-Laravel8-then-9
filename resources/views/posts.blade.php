
{{--Extend the Layout--}}
@extends('layout')

{{--Declare the section --}}
@section('content')
    @foreach ($posts as $post)
    <div class="col-md-4 col-sm-12 mb-5 {{ $loop->even ? 'foobar' : 'foo' }}">
        <div class="card">
            <div class="card-body">
                <a href="/posts/{{$post->slug}}">
                    <h1 class="card-title">{{ $post->title }} </h1>
                </a>
                {{ $post->excerpt }}
                <p class="card-text">
                    <small class="text-muted">Last updated {{ $post->date }}</small>
                </p>
            </div>
        </div>
    </div>
    @endforeach
@endsection
