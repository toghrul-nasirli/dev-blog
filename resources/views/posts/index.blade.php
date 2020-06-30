@extends('layouts.app')

@section('title', '| All Posts')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="row align-items-baseline">
                <div class="col-9">
                    @if ($posts->count() > 0)
                        <h1 class="my-4">Posts</h1>
                    @else
                        <h3 class="my-4">There isn't a post yet :(</h3>
                    @endif
                </div>
                @if (auth()->check())
                    <div class="col-3">
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New</a>
                    </div>
                @endif
            </div>
            
            @foreach ($posts as $post)
                @if ($post->is_approved == true)                    
                    <div class="card mb-4">
                        @if ($post->image != null)
                            <img class="card-img-top" src="{{ asset('storage/' . $post->image) }}">
                        @endif
                        <div class="card-body">
                            <h2 class="card-title">{{ $post->title }}</h2>
                            <h6 class="card-subtitle mb-2 text-muted">by <strong>{{ $post->user->name }}</strong></h6>
                            <p class="card-text">{{ substr(strip_tags(html_entity_decode($post->body)), 0, 250) }} {{ strlen(strip_tags(html_entity_decode($post->body)))> 250 ? '...' : '' }}</p>
                            <p>    
                                @foreach ($post->tags as $tag)
                                    <span class="badge badge-pill badge-secondary pt-1">{{ $tag->name }}</span>
                                @endforeach
                            </p>
                            
                            <div class="row">
                                <div class="col-10">
                                    <a href="{{ route('slug', $post->slug) }}" class="btn btn-primary">Read More &rarr;</a>
                                </div>

                                @if (auth()->check() && auth()->user()->id == $post->user_id)    
                                    <div class="col-2 d-flex justify-content-center">
                                        <a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-warning">Edit</a>
                                        {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}
                                            {{ Form::submit('Delete', ['class' => 'btn btn-danger ml-2 mr-4']) }}
                                        {!! Form::close() !!}
                                    </div> 
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">Category: {{ $post->category->name }} <span class="text-muted">| Posted on {{ date_format($post->created_at, 'F j, Y') }}</span></div>
                    </div>
                @endif
            @endforeach
            
            <div class="d-flex justify-content-center">{{ $posts->links() }}</div>
        </div>

        @include('partials._aside')
    </div>
</div>
@endsection