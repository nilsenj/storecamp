<div class="content-body">
    <div class="review-wrapper">
        <div class="review-control">
            <div class="p-2x"><a href="{{route('admin::reviews::index')}}" class="btn btn-block btn-info">Clear review marks</a></div>
            <ul class="nav nav-tabs nav-stacked nav-contrast-red" role="tablist">
                <?php $colors = ['','text-red', 'text-orange','text-teal','text-blue']?>
                @foreach(config('rating') as $key => $rating)
                    <li>
                        <a href="{{route('admin::reviews::index')}}?search={{$key}}"
                           aria-controls="review">
                            <span class="pull-right label label-default"></span>
                            <i class="fa fa-circle-o {!! $colors[$key-1] !!} mr-2x"></i> {{$rating}}
                        </a>
                    </li>
                @endforeach
            </ul>
            <!-- /nav-review -->

            <!-- /nav-label -->
        </div>
        <!-- /.review-control -->

        <div class="review-paper" >
            <div class="review-paper-heading">
                <div class="btn-toolbar">
                    <div class="dropdown pull-right">
                        <button type="button" class="btn btn-default btn-icon dropdown-toggle"
                                data-toggle="dropdown" rel="tooltip" title="More" data-container="body"><i
                                    class="fa fa-cogs"></i></button>
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
                           data-container="body"><i class="fa fa-refresh"></i></a>
                    </div>
                    <!-- /.btn-group -->
                </div>
                <!-- /.btn-toolbar -->
            </div>
            <!-- /.review-paper-heading -->


            <div class="review-paper-body">
                <div class="review-list">
                    @foreach($fbs as $fb)
                        <div class="panel review-list-item" data-fill-color="true" data-feed-id="{{$fb->id}}" data-feed-status="{{$fb->getThread()->isUnread($fb->user->id) ? "false" : "true"}}">
                            @include('admin.productReview.productReview-message')
                        </div><!-- /.panel.review-list-item -->
                    @endforeach
                </div>
                <!-- /.review-list -->
            </div>
            <!-- /.review-paper-body -->
            <div class="review-paper-footer">
                <div class="btn-toolbar">
                    <div class="dropup pull-right">
                        <button type="button" class="btn btn-default btn-icon dropdown-toggle"
                                data-toggle="dropdown" rel="tooltip" data-placement="bottom" title="More"
                                data-container="body"><i class="fa fa-cogs"></i></button>
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
                    <!-- /.dropdown -->

                    <!-- /.btn-group -->
                    <div class="btn-group">
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
                               data-container="body"><i class="fa fa-refresh"></i></a>
                        </div>
                    </div>
                    <!-- /.btn-group -->
                </div>
                <!-- /.btn-toolbar -->
            </div>
            <!-- /.review-paper-footer -->
        </div>
        <!-- /.review-paper -->
    </div>
    <!-- /.review-wrapper -->
</div><!-- /.content-body -->
