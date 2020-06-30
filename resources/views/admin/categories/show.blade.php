@extends('layouts.app')

@section('title', "| $category->name")

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="row align-items-baseline">
                <div class="col-9">
                    @if ($category->posts->count() > 0)
                        <h1 class="my-4">{{ $category->name }} <span class="text-secondary">category</span></h1>
                    @else
                        <h3 class="my-4">There are no posts in this category yet :(</h3>
                    @endif
                </div>
                @if (Auth::check())
                    <div class="col-3">
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New</a>
                    </div>
                @endif
            </div>
            
            @foreach ($category->posts as $post)
                @if ($post->is_approved == true)
                    <div class="card mb-4">
                        <img class="card-img-top" src="{{ asset('storage/' . $post->image) }}">
                        <div class="card-body">
                            <h2 class="card-title">{{ $post->title }}</h2>
                            <p class="card-text">{{ substr($post->body, 0, 250) }}{{ strlen($post->body) > 250 ? '...' : '' }}</p>
                            <p>    
                                @foreach ($post->tags as $tag)
                                    <span class="badge badge-pill badge-secondary pt-1">{{ $tag->name }}</span>
                                @endforeach
                            </p>

                            <a href="{{ route('slug', $post->slug) }}" class="btn btn-primary">Read More &rarr;</a>
                        </div>
                        <div class="card-footer">Category: {{ $post->category->name }} <span class="text-muted">| Posted on {{ date_format($post->created_at, 'F j, Y') }}</span></div>
                    </div>
                @endif
            @endforeach
        </div>

        @include('partials._aside')
    </div>
</div>
@endsection