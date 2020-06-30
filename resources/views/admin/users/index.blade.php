@extends('layouts.app')

@section('title', '| User Managment')

@section('content')
<div class="container">
    @if ($users->count() > 0)
        <h1 class="my-4">User Managment</h1>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ implode($user->roles()->get()->pluck('name')->toArray()) }}</td>
                        @if (implode($user->roles()->get()->pluck('name')->toArray()) != 'admin')                    
                            <td class="row align-items-center">
                                <a href="{{ route('admin.users.edit', ['user' => $user]) }}" class="btn btn-warning mr-2">Edit</a>
                                {!! Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'DELETE']) !!}
                                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                {!! Form::close() !!}
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h3 class="my-4">There isn't a user yet :(</h3>
    @endif

    <div class="d-flex justify-content-center">{{ $users->links() }}</div>
</div>
@endsection