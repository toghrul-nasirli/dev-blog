@extends('layouts.app')

@section('title', '| Edit Tag')

@section('content')
<div class="container">
    {!! Form::model($tag, ['route' => ['admin.tags.update', $tag->id], 'method' => 'PATCH']) !!}
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Save', ['class' => 'btn btn-success']) }}
        <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
    {!! Form::close() !!}
</div>
@endsection