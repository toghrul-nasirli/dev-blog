@extends('layouts.app')

@section('title', '| Comment Managment')

@section('content')
<div class="container">
    @if ($comments->count() > 0)
        <h1 class="my-4">Comment Managment</h1>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Body</th>
                    <th scope="col">User</th>
                    <th scope="col">Post</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <th scope="row">{{ $comment->id }}</th>
                        <td>{{ substr($comment->body, 0, 50) }}{{ strlen($comment->body) > 50 ? '...' : '' }}</td>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ $comment->post->title }}</td>
                        <td>{{ $comment->is_approved == true ? 'Approved' : 'Waiting Approve' }}</td>
                        <td class="row align-items-center">
                            <a href="{{ route('admin.comments.edit', ['comment' => $comment]) }}" class="btn btn-warning mr-2">Edit</a>
                            {!! Form::open(['route' => ['admin.comments.destroy', $comment->id], 'method' => 'DELETE']) !!}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h3 class="my-4">There isn't a comment yet :(</h3>
    @endif

    <div class="d-flex justify-content-center">{{ $comments->links() }}</div>
</div>
@endsection
