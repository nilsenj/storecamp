@extends('admin/app')
<h1>
    @section('breadcrumb')
        {!! Breadcrumbs::render('products', 'Products') !!}
    @endsection
    @include('admin.partial._contentheader_title', [$model = $products, $message = "All Products"])
    @section('contentheader_description')
        <b>{!! link_to_route('admin::products::create', 'Add new product') !!}</b>
    @endsection
</h1>
@section('styles-add')
    <style>
        .sidebar a {
            color: #48CFAD !important;
            text-decoration: none !important;
        }

        .sidebar .nav > li > a {
            position: relative;
            display: block;
            padding: 12px !important;
            font-size: 14px !important;
        }

        .sidebar .h4, .sidebar .subhead, .sidebar h4 {
            font-size: 16px !important;
            font-weight: 400 !important;
            line-height: 24px !important;
        }

        .sidebar img {
            max-width: inherit !important;
        }
        #wrapper >.navbar-default {
            background-color: #fff !important;
            border-color: transparent;
        }
        #wrapper > .header .container {
            background: #fff!important;
            padding-top: 0!important;
            padding-bottom: 0!important;
        }
    </style>
@endsection
@section('main-content')
    @include('admin.subscribers.subscriber_buttons', $lists)
    <div class="content-body">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">
                <div class="panel-heading p-2x" role="button" data-toggle="collapse" data-parent="#campaign"
                     data-target="#campaign1" aria-expanded="true" aria-controls="collapseOne">
                    <h3 class="panel-title">Generate Email Campaigns <strong>click</strong></h3>
                </div>
                <div id="campaign1" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                        @foreach($lists as $list)
                            <a href="{!! route('web::admin::newsletter::subscribe::showGenerate', [$list->unique_id]) !!}"
                               type="button"
                               class="btn btn-default btn-nofill mb-1x mr-1x"
                               style="word-break: break-all">
                                Compaign for
                                <strong>{!! $list->listName !!}</strong></a>
                            <div class="clearfix"></div>
                        @endforeach
                    </div><!-- /.panel-body -->
                </div><!-- /#getStarted1 -->
            </div>
            <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">
                <div class="panel-heading p-2x" role="button" data-toggle="collapse" data-parent="#template"
                     data-target="#template1" aria-expanded="true" aria-controls="collapseOne">
                    <h3 class="panel-title">Email Templates <strong>click</strong></h3>
                </div>
                <div id="template1" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                        @foreach($mails as $mail)
                            <a href="{!! route('web::admin::newsletter::subscribe::tmp_mail', [$mail['filename']]) !!}"
                               type="button"
                               class="btn btn-default btn-nofill mb-1x mr-1x tmp_mail"
                               style="word-break: break-all">
                                mail template
                                <strong>{!! $mail['filename'] !!}</strong></a>
                            <div class="clearfix"></div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="panel fade in panel-default panel-fill" data-fill-color="true" data-init-panel="true">
                <div class="panel-heading p-2x" role="button" data-toggle="collapse" data-parent="#history_template"
                     data-target="#history_template1" aria-expanded="true" aria-controls="collapseOne">
                    <h3 class="panel-title">Campaign History <strong>click</strong></h3>
                </div>
                <div id="history_template1" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                        @forelse($mailHistory as $key => $mail)
                            <a href="{!! route('web::admin::newsletter::subscribe::history_mail', [$folder = $list->unique_id, $mail['filename']]) !!}"
                               type="button"
                               class="btn btn-default btn-nofill mb-1x mr-1x history_mail"
                               style="word-break: break-all" data-scripts="_includes/modal-remote.js" data-toggle="modal"
                               data-target="#history-{{$list->unique_id}}-{!! $key  !!}">
                                mail template
                                <strong>{!! $mail['filename'] !!}</strong></a>
                            <div class="clearfix"></div>
                            <div class="modal bg-light" data-transition="shrinkIn" id="history-{{$list->unique_id}}-{!! $key  !!}" tabindex="-1" role="dialog"
                                 aria-labelledby="#history-{{$list->unique_id}}-{!! $key  !!}Label" aria-hidden="true">
                                <div class="modal-dialog modal-full">
                                    <div class="modal-content" style="min-height: 100%"></div>
                                </div>
                            </div><!-- /.modal -->
                            @empty
                            <a href="#"
                               type="button"
                               class="btn btn-warning btn-icon history_mail"
                               style="word-break: break-all" >
                                mail template
                                <strong>no campaign emails found</strong></a>
                            <div class="clearfix"></div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <h3><strong>{!! $newslist->listName !!}</strong> - email campaign generation</h3>
            {!! Form::open(["route" => ["web::admin::newsletter::subscribe::generate", $newslist->unique_id, $newslist->listName], "method" => "POST", "class" => "form", "id" => "generateForm", "files" => true]) !!}
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group has-feedback">
                    <div id="summernote-panel" class="panel" data-fill-color="true">
                        <div class="panel-body">
                            @if(old('mail'))
                                <div id="summernote" style="font-family:'Open Sans';">{!! old('mail') !!}</div>
                            @else
                                <div id="summernote" style="font-family:'Open Sans';"></div>
                            @endif
                        </div><!-- /.panel-body -->
                    </div><!-- /.panel -->
                    <div class="panel" id="result" style="padding: 10px"></div>
                    <div class="input-group input-group-in hidden">
                        <span class="input-group-addon"><i class="icon-tag"></i></span>
                        {!! Form::textarea('mail', null, ['class' => 'form-control autogrow', 'id' => 'mail', 'value' => old('mail'), 'rows'=>'4   ', 'placeholder' => 'Email for campaign'])!!}
                        <span class="form-control-feedback"></span>
                    </div>
                    <div class="text-center">
                        {!! $errors->first('mail', '<div class="text-danger">:message</div>') !!}
                    </div>
                </div>
                <div class="form-group">
                    <button onclick="save(event)" type="submit" class="btn btn-default click2save">Create Email and
                        start {!! $newslist->listName !!} campaign
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="clearfix"></div>
        </div>
    </div><!-- /.content-body -->
    <div class="clearfix"></div>

@endsection
@section('scripts-add')
    <script src="{{asset('app/scripts/demo/page-inbox-demo.js')}}"></script>
    <script src="{!! asset('bower_components/summernote/dist/summernote.js') !!}"></script>
    <!-- endbuild -->
    <!-- END COMPONENTS -->

    <script>
        $('#summernote').summernote({
            height: 400,
            fontNames: ['Open Sans', 'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Immpact', 'Tahoma', 'Times New Roman', 'Verdana'],
            fontNamesIgnoreCheck: ['Open Sans'],
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']], // Still buggy
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ]
        });
        var save = function (event) {
//            event.preventDefault();
            var markupStr = $('#summernote').code();
            var mailArea = $('#mail');
            mailArea.val(markupStr);
            mailArea.html(markupStr);
            event.preventDefault();
            var link = $("#generateForm").attr("action");
            var request = $.ajax({
                url: link,
                method: "POST",
                data: {mail: mailArea.val()},
                beforeSend: function (jqXHR, s) {
                    var data = "<i class=\"fa fa-spin fa-spin-2x fa-3x fa-spinner fa-fw\" style='margin: 0 auto; padding: 0 auto; width: 25%; height: 25%'></i>" + "<strong class='text-warning'>Please wait</strong>";
                    $('#summernote').summernote({height: 100});
                    $('#result').html(data);
                }
            });

            request.done(function (data) {
                $('#summernote').summernote({height: 100});
                $('#result').html(data);
                $(this).addClass("done");
            });
            request.fail(function (jqXHR, textStatus) {
                $('#summernote').summernote({height: 100});
                $('#result').html("Generation failed: " + textStatus);
                $('#result').addClass("error");
            });
        };

        var tmp_mail = $(".tmp_mail");

        tmp_mail.on({
            "click": function (event) {
                event.preventDefault();
                var link = $(this).attr("href");
                console.log($(this).attr("href"));
                $.ajax({
                    url: link
                }).done(function (data) {
                    $('#summernote').code(data);
                    $('#summernote').summernote('code', data);
                    $(this).addClass("done");
                });
            }
        });
    </script>

@endsection
