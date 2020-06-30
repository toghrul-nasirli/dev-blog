@extends('layouts.app')

@section('title', '| Post Managment')

@section('content')
<div class="container">
    @if ($posts->count() > 0)
        <h1 class="my-4">Post Managment</h1>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Body</th>
                    <th scope="col">Slug</th>
                    <th scope="col">User</th>
                    <th scope="col">Category</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ substr($post->body, 0, 15) }}{{ strlen($post->body) > 15 ? '...' : '' }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>{{ $post->is_approved == true ? 'Approved' : 'Waiting Approve' }}</td>
                        <td class="row align-items-center">
                            <a href="{{ route('admin.posts.edit', ['post' => $post]) }}" class="btn btn-warning mr-2">Edit</a>
                            {!! Form::open(['route' => ['admin.posts.destroy', $post->id], 'method' => 'DELETE']) !!}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h3 class="my-4">There isn't a user yet :(</h3>
    @endif

    <div class="d-flex justify-content-center">{{ $posts->links() }}</div>
</div>
@endsection