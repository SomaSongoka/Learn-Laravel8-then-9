
<x-layout>

{{-- We can load a partial section eg header here and name the file using underscore but that is not a must --}}
    @include('_posts-header')

<main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
    {{-- Now we can load our post-featured-card component --}}
    @if($posts->count())
        <x-post-grid :posts="$posts" />
    @else
        <div class="flex justify-center">
            <div class="text-center">
                <h1 class="text-3xl font-bold">!! No posts found !!</h1>
            </div>
        </div>
    @endif

</main>

</x-layout>
