@extends('layouts.app')

@section('title', "| $post->title")

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 mt-4">
            <div class="row">
                <div class="col-9">
                    <h1>{{ $post->title }}</h1>
                    <h6 class="text-muted">by <strong>{{ $post->user->name }}</strong></h6>
                </div>
                @if (auth()->check() && auth()->user()->id == $post->user_id)
                    <div class="col-3 d-flex align-items-center justify-content-center">
                        <a class="btn btn-warning btn-sm pl-4 pr-4 mr-2" href="{{ route('posts.edit', ['post' => $post]) }}">Edit</a>
                        {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}
                            {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm pl-3 pr-3']) }}
                        {!! Form::close() !!}
                    </div>
                @endif
            </div>

            <small>Posted on {{ date_format($post->created_at, 'M j, Y H:i') }}</small> |
            <small>Updated on {{ date_format($post->updated_at, 'M j, Y H:i') }}</small>
            <hr>

            @if ($post->image != null)
                <img class="img-fluid rounded" src="{{ asset('storage/' . $post->image) }}">
                <hr>
            @endif

            <div class="lead">{!! $post->body !!}</div>
            <br>
            
            @foreach ($post->tags as $tag)
                <span class="badge badge-pill badge-secondary pt-1">{{ $tag->name }}</span>
            @endforeach
            <hr>
            
            <div><strong>Category:</strong> {{ $post->category->name }}</div>
            <hr>
            
            @if (auth()->check() && auth()->user()->id != $post->user->id)    
                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        {!! Form::open(['route' => ['comments.store', $post->id]]) !!}
                            <div class="form-group">
                                {{ Form::textarea('body', null, ['class' => 'form-control', 'style'=> 'resize: none;', 'rows'=> '3']) }}
                            </div>

                            {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            @endif

            @foreach ($comments as $comment)
                @if ($post->id == $comment->post_id && $comment->is_approved == true)
                    <div class="media mb-4">
                        <img class="d-flex mr-3 rounded-circle" src="{{ asset('img/avatar.png') }}">
                        <div class="media-body">
                            <div class="mb-2">
                                <h5 class="my-0">{{ $comment->user->name }}</h5>
                                <small class="text-muted">{{ date_format($comment->created_at, 'M j, Y H:i') }}</small>
                            </div>
                            
                            @if (auth()->check() && auth()->user()->id == $comment->user_id)
                                {!! Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) !!}
                                    <a href="{{ route('comments.edit', ['comment' => $comment]) }}" class="text-secondary"><small>Edit</small> |</a>
                                    {{ Form::submit('Delete', ['class' => 'btn btn-link btn-sm text-secondary m-0 px-0']) }}
                                {!! Form::close() !!}
                            @endif
                            <div>{{ $comment->body }}</div>                                
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        @include('partials._aside')
    </div>
</div>
@endsection