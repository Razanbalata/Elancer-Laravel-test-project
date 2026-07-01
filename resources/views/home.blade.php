<x-layout title="Home"
    main-class="pt-24 pb-section-gap max-w-container-max mx-auto px-gutter grid grid-cols-1 md:grid-cols-12
    gap-8">

    {{-- @extends('layouts.main')

@section('main-class',
    'pt-24 pb-section-gap max-w-container-max mx-auto px-gutter grid grid-cols-1 md:grid-cols-12
    gap-8') --}}


    {{-- @section('title', 'Home') --}}
    <x-slot:style>
        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
                vertical-align: middle;
            }

            body {
                background-color: #f9f9f9;
                color: #1a1c1c;
            }
        </style>
    </x-slot:style>
    {{-- @push('style')
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        body {
            background-color: #f9f9f9;
            color: #1a1c1c;
        }
    </style>
@endpush --}}

    @php
        $currentCategory = request('category');
        $currentTag = request('tag');
        $currentDiscover = request('discover', 'explore');
    @endphp

    @section('nav')
        @parent
        <a class="text-primary font-bold border-b-2 border-primary pb-1 font-ui-label text-ui-label hover:text-primary transition-colors duration-200"
            href="#">hii</a>
    @endsection

    {{-- @section('content') --}}

    <aside class="hidden md:block md:col-span-2 space-y-8">
        <div class="space-y-4">
            <h3 class="font-ui-label text-ui-label uppercase tracking-widest text-secondary font-bold">Discover</h3>
            <ul class="space-y-2">
                <li><a class="flex items-center gap-3 py-1 font-ui-label text-ui-label
   {{ $currentDiscover === 'explore' ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}"
                        href="{{ route('home', ['discover' => null]) }}"><span
                            class="material-symbols-outlined" data-weight="fill"
                            style="font-variation-settings: 'FILL' 1;">explore</span>Explore</a></li>
                <li><a class="flex items-center gap-3 py-1 font-ui-label text-ui-label
   {{ $currentDiscover === 'popular' ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}"
                        href="{{ route('home', ['discover' => 'popular']) }}"><span
                            class="material-symbols-outlined">trending_up</span>Popular</a></li>
                <li><a class="flex items-center gap-3 py-1 font-ui-label text-ui-label
   {{ $currentDiscover === 'recent' ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}"
                        href="{{ route('home', ['discover' => 'recent']) }}"><span
                            class="material-symbols-outlined">history</span>Recent</a></li>
            </ul>
        </div>
        <div class="space-y-4">
            <h3 class="font-ui-label text-ui-label uppercase tracking-widest text-secondary font-bold">Topics
            </h3>
            <div class="flex flex-wrap gap-2">
                @foreach ($categories as $category)
                    <a class="px-3 py-1 text-sm rounded-full border transition-colors
        {{ $currentCategory === $category->slug
            ? 'bg-primary text-white border-primary'
            : 'bg-surface-container text-on-surface-variant hover:bg-outline-variant' }}"
                        href="{{ route('home', ['category' => $category->slug]) }}">#{{ $category->name }}</a>
                @endforeach
            </div>
        </div>
        <div class="space-y-4">
            <h3 class="font-ui-label text-ui-label uppercase tracking-widest text-secondary font-bold">Your Tags
            </h3>
            <div class="flex flex-wrap gap-2">
                @foreach ($tags as $tag)
                    <a class="px-3 py-1 text-sm rounded-full border transition-colors
        {{ $currentTag === $tag->slug
            ? 'bg-primary text-white border-primary'
            : 'bg-surface-container text-on-surface-variant hover:bg-outline-variant' }}"
                        href="{{ route('home', ['tag' => $tag->slug]) }}">#{{ $tag->name }}</a>
                @endforeach
            </div>
        </div>

        @if (request()->hasAny(['category', 'tag', 'discover']))
            <a href="{{ route('home') }}"
                class="flex items-center gap-3 text-red-500 hover:text-red-600 font-ui-label text-ui-label py-1">
                <span class="material-symbols-outlined">close</span>
                Clear Filters
            </a>
        @endif
    </aside>
    {{-- @if ($featuredPost)
    <h1>FEATURED: {{ $featuredPost->title }}</h1>
@endif

@foreach ($posts as $post)
    <p>{{ $post->title }}</p>
@endforeach --}}
    <!-- Center Feed -->
    <section class="col-span-1 md:col-span-7 space-y-12">
        <!-- Featured Article (Bento Style) -->

        @if ($featuredPost)
            <x-featured-post :post="$featuredPost" />
        @endif

        <div class="grid grid-cols-1 gap-12">

            @foreach ($posts as $post)
                <x-post-card :post="$post" />
            @endforeach

        </div>
        <div class="pt-8 flex justify-center">
            {{-- <button
                class="px-8 py-3 border border-primary text-primary font-ui-button text-ui-button rounded-lg hover:bg-primary-container/5 transition-all">
                Load More Stories
            </button> --}}
            {{ $posts->links() }}
        </div>
    </section>
    <!-- Right Sidebar: Trending & Who to Follow -->
    <aside class="hidden lg:block lg:col-span-3 space-y-12">
        <!-- Trending Section -->
        @include('asides.trending', ['test' => 'Test'])
        <!-- Who to Follow -->
        <x-recommended-authors title="Follow Authors" count="2" />
        <!-- Newsletter Sign Up -->
        <x-widgets.newsletter>

            <x-slot:helper>
                <p>Hii</p>
            </x-slot:helper>

            <button
                class="w-full py-2 bg-white text-primary font-ui-button text-ui-button rounded hover:bg-opacity-90 transition-all">Subscribe</button>
        </x-widgets.newsletter>
    </aside>

    <!-- Footer -->
    {{-- @endsection --}}
</x-layout>
