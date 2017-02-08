@section('contentheader_title')
    {{ strtoupper($message) }} -
    <span class="pull-right-container">
        <small class="label bg-blue text-sm">{{ $model->toArray()['total'] }}</small>
    </span>
@endsection