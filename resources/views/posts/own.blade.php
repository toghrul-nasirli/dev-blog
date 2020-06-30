@extends('layouts.app')

@section('title', '| My Posts')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="row align-items-baseline">
                <div class="col-9">
                    @if ($posts->count() > 0)
                        <h1 class="my-4">Posts</h1>
                    @else
                        <h3 class="my-4">You haven't any posts yet :(</h3>
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Your First Post</a>
                    @endif
                </div>
            </div>
            
            @foreach ($posts as $post)
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

                            <div class="col-2 d-flex justify-content-center">
                                <a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-warning">Edit</a>
                                {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}
                                    {{ Form::submit('Delete', ['class' => 'btn btn-danger ml-2 mr-4']) }}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p class="mb-0">Category: {{ $post->category->name }} <span class="text-muted">| Posted on {{ date_format($post->created_at, 'F j, Y') }}</span></p>
                        @if ($post->is_approved == false) 
                            <p class="mt-1 mb-0 text-info">Waiting Approve</p>
                        @endif
                    </div>
                </div>
            @endforeach
            
            <div class="d-flex justify-content-center">{{ $posts->links() }}</div>
        </div>

        @include('partials._aside')
    </div>
</div>
@endsection