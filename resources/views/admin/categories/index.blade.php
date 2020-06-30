@extends('layouts.app')

@section('title', '| Category Managment')

@section('content')
<div class="container">
    @if ($categories->count() > 0)
        <h1 class="my-4">Category Managment</h1>
    @else
        <h3 class="my-4">There isn't a category yet :(</h3>
    @endif

    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-lg btn-block text-white mb-1">Add Category</a>
    
    @if ($categories->count() > 0)
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td class="row align-items-center">
                            <a href="{{ route('admin.categories.edit', ['category' => $category]) }}" class="btn btn-warning mr-2">Edit</a>
                            {!! Form::open(['route' => ['admin.categories.destroy', $category->id], 'method' => 'DELETE']) !!}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="d-flex justify-content-center">{{ $categories->links() }}</div>
</div>
@endsection