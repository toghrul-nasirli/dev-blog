@extends('layouts.app')

@section('title', '| Edit Post')

@section('styles')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PATCH', 'files' => true]) !!}
        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', null, ['class' => 'form-control form-control-lg']) }}
        </div>
        <div class="form-group">
            {{ Form::label('category_id', 'Category') }}
            {{ Form::select('category_id', $categoryOptions, null, ['class' => 'custom-select']) }}
        </div>
        <div class="form-group">
            {{ Form::label('tags', 'Tags') }}
            {{ Form::select('tags[]', $tagOptions, null, ['class' => 'custom-select select2-tags', 'multiple' => 'multiple']) }}
        </div>
        <div class="custom-file">
            {{ Form::file('image', ['class' => 'custom-file-input', 'id' => 'image']) }}
            {{ Form::label('image', 'Choose file', ['class' => 'custom-file-label']) }}
        </div>
        <div class="form-group">
            {{ Form::label('body', 'Body') }}
            {{ Form::textarea('body', null, ['class' => 'form-control', 'style'=> 'resize: none;', 'rows'=> '5']) }}
        </div>

        {{ Form::submit('Save', ['class' => 'btn btn-success']) }}
        <a class="btn btn-danger" href="{{ url()->previous() }}">Cancel</a>
    {!! Form::close() !!}
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>

    <script>
        $('#image').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });

        $(document).ready(function() {
            $('.select2-tags').select2();
        });

        ClassicEditor
            .create(document.querySelector('#body'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection