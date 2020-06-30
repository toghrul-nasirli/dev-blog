@extends('layouts.app')

@section('title', '| Edit Comment')

@section('content')
<div class="container">
    {!! Form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => 'PATCH']) !!}
        <div class="form-group">
            {{ Form::label('body', 'Comment') }}
            {{ Form::textarea('body', null, ['class' => 'form-control', 'style'=> 'resize: none;', 'rows'=> '3']) }}
        </div>

        {{ Form::submit('Save', ['class' => 'btn btn-success']) }}
        <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
    {!! Form::close() !!}
</div>
@endsection