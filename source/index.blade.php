@extends('_layouts.master')

@push('meta')
    <meta property="og:title" content="{{ $page->siteName }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $page->getUrl() }}"/>
    <meta property="og:description" content="{{ $page->blogDescription }}" />
@endpush

@section('body')
    @foreach ($featuredPosts = $posts->where('featured', true) as $featuredPost)
        <div class="w-full mb-6">
            @if ($featuredPost->cover_image)
                <img src="{{ $featuredPost->cover_image }}" alt="{{ $featuredPost->title }} cover image">
            @endif

            <h2 class="text-3xl">
                <a href="{{ $page->url($featuredPost->getPath()) }}" title="Read {{ $featuredPost->title }}" class="text-black font-extrabold">
                    {{ $featuredPost->title }}
                </a>
            </h2>

            <p class="mt-0 mb-4">{!! $featuredPost->excerpt() !!}</p>

            <a href="{{ $page->url($featuredPost->getPath()) }}" title="Read - {{ $featuredPost->title }}"class="uppercase tracking-wide mb-4">
                Read
            </a>
        </div>

        @if ($featuredPost != $featuredPosts->last())
            <hr class="border-b my-6">
        @endif
    @endforeach

    @include('_components.newsletter-signup')

    @foreach ($posts->where('featured', false)->take(6)->chunk(2) as $row)
        <div class="flex flex-col md:flex-row md:-mx-6">
            @foreach ($row as $post)
                <div class="w-full md:w-1/2 md:mx-6">
                    @include('_components.post-preview-inline')
                </div>
            @endforeach
        </div>

        <hr class="border-b my-6">
    @endforeach
@stop
