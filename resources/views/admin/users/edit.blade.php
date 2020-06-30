@extends('layouts.app')

@section('title', '| Edit User')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Edit User's role</div>
        <div class="card-body">
            {!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PATCH']) !!}
                <div class="form-group">
                    @foreach ($roles as $role)
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="roles[]" id="{{ $role->id }}" value="{{ $role->id }}"
                                    {{ $user->roles->pluck('id')->contains($role->id) ? 'checked' : ''}}>
                                </div>
                            </div>
                            <label for="{{ $role->id }}" class="form-control">{{ $role->name }}</label>
                        </div>
                    @endforeach
                </div>

                {{ Form::submit('Save', ['class' => 'btn btn-success']) }}
                <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection