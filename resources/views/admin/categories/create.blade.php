@extends('layouts.app')

@section('title', '| Create New Category')

@section('content')
<div class="container">
    {!! Form::open(['route' => 'admin.categories.store']) !!}
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Create New Category', ['class' => 'btn btn-primary']) }}
        <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
    {!! Form::close() !!}
</div>
@endsection