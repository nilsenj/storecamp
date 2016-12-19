<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control description']) !!}
    {!! $errors->first('description', '<div class="text-danger">:message</div>') !!}
    </div>
@section('scripts_add')
    <!-- include summernote css/js-->
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote.css')}}">
    <script src="{{asset('plugins/summernote/summernote.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.description').summernote({
                height: 300,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
            });
        });
    </script>
@endsection