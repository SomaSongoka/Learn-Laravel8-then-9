{{-- Extend the Layout --}}
@extends('layout')

{{-- Declare the section --}}
@section('content')
    <div class="row mb-2">
        <div class="col align-self-center">
            <div class="card mb-3">
                <h1 class="card-title">{{ $post->title }}</h1>
                <h6 class="card-title">Category: <a href="/category/{{ $post->category->slug }}">{{ $post->category->name }}</a> </h6>

                {!! $post->body !!}
                <p class="card-text">
                    <small class="text-muted">Last updated {{ $post->date }}</small>
                </p>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <a href="/home" class="">Go Back Home</a>
        </div>
    </div>
@endsection

{{-- Section banner --}}
@section('banner')
    <div class="row">
        <div class="col-12">
            <h1>My Blog Post</h1>
        </div>
    </div>
@endsection


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
</body>

</html>
