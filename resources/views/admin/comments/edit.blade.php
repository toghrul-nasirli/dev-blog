@extends('layouts.app')

@section('title', '| Edit Comment')

@section('content')
<div class="container">
    {!! Form::model($comment, ['route' => ['admin.comments.update', $comment->id], 'method' => 'PATCH']) !!}
        <div class="form-group">
            {{ Form::label('body', 'Body') }}
            {{ Form::text('body', null, ['class' => 'form-control']) }}
        </div>

        <label>Status</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="radio" id="1" name="is_approved" value="1">
                </div>
            </div>
            <label for="1" class="form-control">Approve</label>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="radio" id="0" name="is_approved" value="0">
                </div>
            </div>
            <label for="0" class="form-control">Refuse</label>
        </div>

        {{ Form::submit('Save', ['class' => 'btn btn-success']) }}
        <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
    {!! Form::close() !!}
</div>
@endsection