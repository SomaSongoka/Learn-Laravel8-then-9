{{-- Since we are using Balde components we should declaire the component slot--}}

{{--We can pass variable to our components as attribute eg--}}
<?php $description = 'This is a description'; ?>
<x-app title="This value will be assigned to variable title" description="{{$description}}">

    {{--   Or we can declaire our variable as slot eg: our variable will be full_name --}}
    <x-slot name="full_name">
        John Doe
    </x-slot>

{{-- Or we can just add values inside this area and it will be assign to variable slot inside our component --}}
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
</x-app>






