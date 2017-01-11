<div class="tab-pane active" id="general">
    @if(isset($model))
        {!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin::attributes::update', $model->id]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'admin::attributes::store']) !!}
    @endif
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
    </div>
    <div class="form-group">
        <label for="attributes_group">Attribute Group</label>
        {!! Form::select('attributes_group_id',  $model ? [$model->attributesGroup->id, $model->attributesGroup->name] : [], $model ? [$model->attributesGroup->id, $model->attributesGroup->name] : null, ["class" => "form-control select2", "id"=>"attributes_group", 'placeholder' => 'Select Group Attribute ...']) !!}
        {{--{!! Form::select('attributes_group_id', $model ? ["id" => $model->id, "text" => $model->name] : [], $model ? ["id" => $model->id, "text" => $model->name] : null, ["class" => "form-control select2", "id"=>"attributes_group", 'placeholder' => 'Select Group Attribute ...']) !!}--}}

    </div>
    {!! $errors->first('product', '<div class="text-danger">:message</div>') !!}
    <div class="form-group">
        {!! Form::label('sort_order', 'Sort Order:') !!}
        {!! Form::number('sort_order', null, ['class' => 'form-control']) !!}
        {!! $errors->first('sort_order', '<div class="text-danger">:message</div>') !!}
    </div>
    <div class="form-group">
        {!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>

@section('scripts-add')

    <script>
        var selectedProduct = undefined;

        $('.select2-search__field').on({
            "change": function () {
                selectedProduct = $("select.select2-search__field").val();
            }
        });

        $('.select2').select2({
            ajax: {
                url: APP_URL + '/admin/attribute_groups/groups/json ',
                delay: 250,
                data: function (params) {
                    var query = {
                        search: params.term, // search term
                        page: params.page
                    };
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        });
//        $(".select2").select2({
//            ajax: {
//                url:  APP_URL + '/attributes_group/json',
//                dataType: 'json',
//                delay: 250,
//                data: function (params) {
//                    return {
//                        q: params.term, // search term
//                        page: params.page
//                    };
//                },
//                processResults: function (data, params) {
//                    // parse the results into the format expected by Select2
//                    // since we are using custom formatting functions we do not need to
//                    // alter the remote JSON data, except to indicate that infinite
//                    // scrolling can be used
//                    params.page = params.page || 1;
//
//                    return {
//                        results: data.items,
//                        pagination: {
//                            more: (params.page * 30) < data.total_count
//                        }
//                    };
//                },
//                cache: true
//            },
//            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
//            minimumInputLength: 1,
//            templateResult: formatRepo, // omitted for brevity, see the source of this page
//            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
//        });
    </script>
@endsection