@extends('admin/app')
<h1>
    @section('breadcrumb')
        {!! Breadcrumbs::render('media', 'media') !!}
    @endsection
    @section('contentheader_title')
        All Product Reviews
        {{--&middot; {{$count}}--}}
    @endsection

    @section('contentheader_description')
            <p>Product Reviews
            </p>
    @endsection
</h1>
@section('main-content')
    @include('admin.productReview.review_body')
    <div class="btn-group pull-right">
        {!! $fbs->links() !!}
    </div>
@endsection

@section('scripts-add')
    <script src="{{asset('js/page-inbox-demo.js')}}"></script>
    <script>
        $('.review-list .review-list-item').on({
            "click": function (event) {
                var feedId = $(this).data('feed-id'),
                    feedStatus = $(this).data('feed-status');
                console.log(feedStatus);

                if (feedStatus === false) {
                    $.ajax({
                        type: 'GET',
                        url: APP_URL + "/admin/reviews/markasread/productReview/" + feedId,
//                        data: {
//                            'class_name': _this.o.class_name,
//                            'object_id': _this.o.object_id
//                        },
                        success: function (data) {
                            if (data['error']) {

                                console.log(data);
                            }
                            console.log(data);
                            if (data['message']) {
                                var navButton = $("li.productReview");
                                var itemLabelStatus = $('.review-list-item[data-feed-id=' + feedId + '] .productReview-item-status');
                                navButton.find('span').text(data['messages_count']);
                                var sidebarstatus = $('.sidebar .productReview-item-status');
                                sidebarstatus.text(data['messages_count']);
                                itemLabelStatus.text('read');
                                if (data['messages_count'] == 0) {
                                    navButton.find('span').removeClass('label-danger').addClass('label-default');
                                    sidebarstatus.removeClass('label-warning').addClass('label-default');
                                }
                                itemLabelStatus.removeClass('label-warning').addClass('label-default');
                            }
                        },
                        error: function (data) {
                            console.log('error' + '   ' + data);
                        }
                    }, 'html');
                }
            }
        });
    </script>
@endsection