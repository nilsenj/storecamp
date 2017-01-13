@section('contentheader_title')
    {!! strtoupper($message) !!} - ({!! $model->toArray()['total'] !!})
@endsection