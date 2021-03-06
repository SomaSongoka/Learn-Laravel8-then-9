<header class="max-w-xl mx-auto mt-20 text-center">
    <h1 class="text-4xl">
        Latest <span class="text-blue-500">Laravel From Scratch</span> News
    </h1>

    <h2 class="inline-flex mt-2">Assembled By Josh Minga <img src="/images/lary-head.svg"
                                                       alt="Head of Lary the mascot"></h2>

    <p class="text-sm mt-14">You look like a good fit for this blog. <strong>Start By Searching</strong> </p>

    <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-4">
        <!--  Category -->
        <div class="relative lg:inline-flex bg-gray-100 rounded-xl">
            <x-dropdown-categories>
                <x-slot name="trigger">
                    <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex">
                        {{ isset($currentCategory) ? $currentCategory->name : 'Categories' }}

                        {{-- Add SVG Icon--}}
                        <x-icon-dropdown class="absolute pointer-events-none" style="right: 12px;" width="22" height="22"  />
                    </button>
                </x-slot>

            {{-- Links --}}
                {{-- We can use routeIs to check if route name matches | this will match the named route name--}}
                <x-dropdown-item href="/blog" :active="request()->routeIs('home')">All</x-dropdown-item>
                @if($categories->count())
                    @foreach($categories as $category)
                        <x-dropdown-item
                            :active="isset($currentCategory) && $currentCategory->is($category)"
                            href="/blog/category/{{ $category->slug }}"
                        >
                            {{ ucwords($category->name) }}
                        </x-dropdown-item>
                        {{-- Another way to check if is active is by compairing the URL using request() collection --}}
{{--                         <x-dropdown-item href="/blog/category/{{ $category->slug }}" :active="request()->is('blog/category/'.$category->slug)">{{ ucwords($category->name) }}</x-dropdown-item>--}}
                    @endforeach
                @endif

            </x-dropdown-categories>
        </div>

        <!-- Other Filters -->
        <div style="display: none" class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl">
            <select class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold">
                <option value="category" disabled selected>Other Filters
                </option>
                <option value="foo">Foo
                </option>
                <option value="bar">Bar
                </option>
            </select>

            <svg class="transform -rotate-90 absolute pointer-events-none" style="right: 12px;" width="22"
                 height="22" viewBox="0 0 22 22">
                <g fill="none" fill-rule="evenodd">
                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                    </path>
                    <path fill="#222"
                          d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                </g>
            </svg>
        </div>

        <!-- Search -->
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
            <form method="GET" action="#">
                <input
                    type="text"
                    name="search"
                    placeholder="Find something"
                   class="bg-transparent placeholder-black font-semibold text-sm"
{{-- To maintain the searched text after page load we can attach the getvalue back --}}
                    value="{{ request('search') }}"
                    >
            </form>
        </div>
    </div>

</header>
