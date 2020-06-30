@extends('layouts.app')

@section('title', '| Edit Post')

@section('styles')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    {!! Form::model($post, ['route' => ['admin.posts.update', $post->id], 'method' => 'PATCH', 'files' => true]) !!}
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