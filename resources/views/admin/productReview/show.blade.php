@extends('admin.layouts.app')

@section('content')
    <div class="content-hero">
        <img class="content-hero-embed" src="{{asset('app/images/dummy/people2.jpg')}}" alt="cover">
        <div class="content-hero-overlay bg-grd-blue"></div>
        <div class="content-hero-body">
            <div class="content-bar">
                <h2 class="text-warning">Feedbacks</h2>
            </div>
            <!-- /.content-bar -->
        </div>
        <!-- /.content-hero-body -->
    </div><!-- /.content-hero -->
    <div class="content-body">
        <div class="inbox-wrapper">
            <div class="inbox-control">
                <div class="p-2x"><a href="{{route('web::admin::indexFeedback')}}" class="btn btn-block btn-info">Clear reasons</a></div>
                <ul class="nav nav-tabs nav-stacked nav-contrast-red" role="tablist">
                    <?php $counter = 0; $colors = ['text-blue','text-teal', 'text-orange', 'text-red']?>
                    @foreach(config('reasons') as $key => $reason)
                        <?php $counter++ ?>
                        <li>
                            <a href="{{route('web::admin::indexFeedback')}}?search={{$key}}"
                               aria-controls="inbox">
                                <span class="pull-right label label-default"></span>
                                <i class="fa fa-circle-o @if(count($colors) == $counter){!! $counter = 0 !!}@else {!! $colors[$counter] !!} @endif  mr-2x"></i> {{$key}}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <!-- /nav-inbox -->

                <!-- /nav-label -->
            </div>
            <!-- /.inbox-control -->

            <div class="inbox-paper">
                <div class="inbox-paper-heading">
                    <div class="btn-toolbar">
                        <div class="dropdown pull-right">
                            <button type="button" class="btn btn-default btn-icon dropdown-toggle"
                                    data-toggle="dropdown" rel="tooltip" title="More" data-container="body"><i
                                        class="icon-options"></i></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="#">Add Label</a></li>
                                <li><a href="#">Add Contact</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Appearances</a></li>
                                <li><a href="#">Setups</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <div class="nice-checkbox no-margin mt-1x help-inline" data-toggle="tooltip" title="Select"
                                 data-container="body">
                                <input type="checkbox" id="select-all"/>
                                <label for="select-all">&nbsp;</label>
                            </div>
                        </div>
                        <!-- /.btn-group -->
                        <div class="btn-group">
                            <a type="button" class="btn btn-default btn-icon" href="{{url()->current()}}"
                               onclick="window.reload" data-toggle="tooltip" title="Reload"
                               data-container="body"><i class="icon-refresh"></i></a>
                            <button type="button" class="btn btn-default btn-icon" data-toggle="tooltip" title="Mark as"
                                    data-container="body"><i class="icon-envelope-open"></i></button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                    <!-- /.btn-toolbar -->
                </div>
                <!-- /.inbox-paper-heading -->


                <div class="inbox-paper-body">
                    <div class="inbox-list">
                            <div class="panel inbox-list-item fade in panel-default panel-fill panel-expanded" data-fill-color="true" style="opacity: 1; display: block; transform: scaleX(1) scaleY(1); transform-origin: 50% 50% 0px;" data-init-panel="true" data-fill-color="true">
                               @include('admin.productReview.productReview-message')
                            </div><!-- /.panel.inbox-list-item -->

                    </div>
                    <!-- /.inbox-list -->


                </div>
                <!-- /.inbox-paper-body -->


                <div class="inbox-paper-footer">
                    <div class="btn-toolbar">
                        <div class="dropup pull-right">
                            <button type="button" class="btn btn-default btn-icon dropdown-toggle"
                                    data-toggle="dropdown" rel="tooltip" data-placement="bottom" title="More"
                                    data-container="body"><i class="icon-options"></i></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="#">Add Label</a></li>
                                <li><a href="#">Add Contact</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Appearances</a></li>
                                <li><a href="#">Setups</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <div class="nice-checkbox no-margin mt-1x help-inline" data-toggle="tooltip"
                                 data-placement="bottom" title="Select" data-container="body">
                                <input type="checkbox" id="select-all-b"/>
                                <label for="select-all-b">&nbsp;</label>
                            </div>
                        </div>
                        <!-- /.btn-group -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-icon" data-toggle="tooltip"
                                    data-placement="bottom" title="Reload" data-container="body"><i
                                        class="icon-refresh"></i></button>
                            <button type="button" class="btn btn-default btn-icon" data-toggle="tooltip"
                                    data-placement="bottom" title="Mark as" data-container="body"><i
                                        class="icon-envelope-open"></i></button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                    <!-- /.btn-toolbar -->
                </div>
                <!-- /.inbox-paper-footer -->
            </div>
            <!-- /.inbox-paper -->
        </div>
        <!-- /.inbox-wrapper -->

    </div><!-- /.content-body -->


@endsection

@section('scripts-add')
    <script src="{{asset('app/scripts/demo/page-inbox-demo.js')}}"></script>
@endsection