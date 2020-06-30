@extends('layouts.app')

@section('title', '| Tag Managment')

@section('content')
<div class="container">
    @if ($tags->count() > 0)
        <h1 class="my-4">Tag Managment</h1>
    @else
        <h3 class="my-4">There isn't a tag yet :(</h3>
    @endif

    <a href="{{ route('admin.tags.create') }}" class="btn btn-primary btn-lg btn-block text-white mb-1">Add Tag</a>

    @if ($tags->count() > 0)
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <th scope="row">{{ $tag->id }}</th>
                        <td>{{ $tag->name }}</td>
                        <td class="row align-items-center">
                            <a href="{{ route('admin.tags.edit', ['tag' => $tag]) }}" class="btn btn-warning mr-2">Edit</a>
                            {!! Form::open(['route' => ['admin.tags.destroy', $tag->id], 'method' => 'DELETE']) !!}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="d-flex justify-content-center">{{ $tags->links() }}</div>
</div>
@endsection