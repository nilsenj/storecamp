<!DOCTYPE html>
<!--
Landing page based on Pratt: http://blacktie.co/demo/pratt/
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="StoreCamp-laravel - {{ trans('message.landingdescription') }} ">
    <meta name="author" content="Sergi Tur Badenas - acacha.org">

    <meta property="og:title" content="StoreCamp-laravel" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="StoreCamp-laravel - {{ trans('message.landingdescription') }}" />
    <meta property="og:url" content="http://demo.adminlte.acacha.org/" />
    <meta property="og:sitename" content="demo.adminlte.acacha.org" />
    <meta property="og:url" content="http://demo.adminlte.acacha.org" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@nilsenj_" />
    <meta name="twitter:creator" content="@nilsenj_" />

    <title>{{ trans('message.landingdescriptionpratt') }}</title>
    <link href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Custom styles for this template -->
    <!-- Theme style -->
    <link href="{{ asset('/css/admin_lte.css') }}" rel="stylesheet" type="text/css" />

    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    {{--<link href="{{ asset('/css/skins/skin-black.css') }}" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset('/css/skins/skin-blue.css') }}" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset('/css/skins/skin-blue-light.css') }}" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset('/css/skins/skin-green.css') }}" rel="stylesheet" type="text/css" />--}}
    {{--<link href="{{ asset('/css/skins/skin-blue.css') }}" rel="stylesheet" type="text/css" />--}}
    <link rel="stylesheet" href="{{ asset('/css/admin_skins.css') }}">
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{ asset('custom_vendors/timepicker/bootstrap-timepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">

    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/iCheck/skins/all.css')}}">
    <link href="{{ asset('/plugins/iCheck/skins/square/blue.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-star-rating/css/star-rating.css') }}">

    <link rel="stylesheet" href="{{ asset('/css/admin_skins.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alt/AdminLTE-select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alt/AdminLTE-fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/alt/AdminLTE-bootstrap-social.min.css') }}">

    <!-- iCheck -->
    <link href="{{ asset('/css/main/app.css') }}" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

</head>

<body data-spy="scroll" data-offset="0" data-target="#navigation">

<div id="app">
    <!-- Fixed navbar -->
    <div id="navigation" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><b>StoreCamp-laravel</b></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#home" class="smoothScroll">{{ trans('message.home') }}</a></li>
                    <li><a href="#desc" class="smoothScroll">{{ trans('message.description') }}</a></li>
                    <li><a href="#intro" class="smoothScroll">{{ trans('message.intro') }}</a></li>
                    <li><a href="#features" class="smoothScroll">{{ trans('message.features') }}</a></li>
                    <li><a href="#showcase" class="smoothScroll">{{ trans('message.showcase') }}</a></li>
                    <li><a href="#contact" class="smoothScroll">{{ trans('message.contact') }}</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">{{ trans('message.login') }}</a></li>
                        <li><a href="{{ url('/register') }}">{{ trans('message.register') }}</a></li>
                    @else
                        <li><a href="/home">{{ Auth::user()->name }}</a></li>
                        <li>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                logout
                            </a>
                        </li>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            <input type="submit" value="logout" style="display: none;">
                        </form>
                    @endif
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>


    <section id="home" name="home"></section>
    <div id="headerwrap">
        <div class="container">
            <div class="row centered">
                <div class="col-lg-12">
                    <h1>Nilsenj <b><a href="https://github.com/nilsenj/storecamp">StoreCamp-laravel</a></b></h1>
                    <h3>A <a href="https://laravel.com/">Laravel</a> {{ trans('message.laravelpackage') }}
                        scaffolding/boilerplate {{ trans('message.to') }} <a href="https://almsaeedstudio.com/preview">StoreCamp</a> {{ trans('message.templatewith') }}
                        <a href="http://getbootstrap.com/">Bootstrap</a> 3.0 {{ trans('message.and') }} <a href="http://blacktie.co/demo/pratt/">Pratt</a> Landing page</h3>
                    <h3><a href="{{ url('/register') }}" class="btn btn-lg btn-success">{{ trans('message.gedstarted') }}</a></h3>
                </div>
                <div class="col-lg-2">
                    <h5>{{ trans('message.amazing') }}</h5>
                    <p>{{ trans('message.basedStoreCamp') }}</p>
                    <img class="hidden-xs hidden-sm hidden-md" src="{{ asset('/img/arrow1.png') }}">
                </div>
                <div class="col-lg-8">
                    <img class="img-responsive" src="{{ asset('/img/app-bg.png') }}" alt="">
                </div>
                <div class="col-lg-2">
                    <br>
                    <img class="hidden-xs hidden-sm hidden-md" src="{{ asset('/img/arrow2.png') }}">
                    <h5>{{ trans('message.awesomepackaged') }}</h5>
                    <p>... {{ trans('message.by') }} <a href="http://acacha.org/sergitur">Sergi Tur Badenas</a> {{ trans('message.at') }} <a href="http://acacha.org">acacha.org</a> {{ trans('message.readytouse') }}</p>
                </div>
            </div>
        </div> <!--/ .container -->
    </div><!--/ #headerwrap -->


    <section id="desc" name="desc">

    </section>
    <!-- INTRO WRAP -->
    <div id="intro">
        <div class="container">
            <div class="row centered">
                <h1>{{ trans('message.designed') }}</h1>
                <br>
                <br>
                <div class="col-lg-4">
                    <img src="{{ asset('/img/intro01.png') }}" alt="">
                    <h3>{{ trans('message.community') }}</h3>
                    <p>{{ trans('message.see') }} <a href="https://github.com/nilsenj/storecamp">{{ trans('message.githubproject') }}</a>, {{ trans('message.post') }} <a href="https://github.com/nilsenj/storecamp/issues">{{ trans('message.issues') }}</a> {{ trans('message.and') }} <a href="https://github.com/acacha/StoreCamp-laravel/pulls">{{ trans('message.pullrequests') }}</a></p>
                </div>
                <div class="col-lg-4">
                    <img src="{{ asset('/img/intro02.png') }}" alt="">
                    <h3>{{ trans('message.schedule') }}</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
                <div class="col-lg-4">
                    <img src="{{ asset('/img/intro03.png') }}" alt="">
                    <h3>{{ trans('message.monitoring') }}</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </div>
            <br>
            <hr>
        </div> <!--/ .container -->
    </div><!--/ #introwrap -->

    <!-- FEATURES WRAP -->
    <div id="features">
        <div class="container">
            <div class="row">
                <h1 class="centered">{{ trans('message.whatnew') }}</h1>
                <br>
                <br>
                <div class="col-lg-6 centered">
                    <img class="centered" src="{{ asset('/img/mobile.png') }}" alt="">
                </div>

                <div class="col-lg-6">
                    <h3>{{ trans('message.features') }}</h3>
                    <br>
                    <!-- ACCORDION -->
                    <div class="accordion ac" id="accordion2">
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                    {{ trans('message.design') }}
                                </a>
                            </div><!-- /accordion-heading -->
                            <div id="collapseOne" class="accordion-body collapse in">
                                <div class="accordion-inner">
                                    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                </div><!-- /accordion-inner -->
                            </div><!-- /collapse -->
                        </div><!-- /accordion-group -->
                        <br>

                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                                    {{ trans('message.retina') }}
                                </a>
                            </div>
                            <div id="collapseTwo" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                </div><!-- /accordion-inner -->
                            </div><!-- /collapse -->
                        </div><!-- /accordion-group -->
                        <br>

                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                                    {{ trans('message.support') }}
                                </a>
                            </div>
                            <div id="collapseThree" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                </div><!-- /accordion-inner -->
                            </div><!-- /collapse -->
                        </div><!-- /accordion-group -->
                        <br>

                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                                    {{ trans('message.responsive') }}
                                </a>
                            </div>
                            <div id="collapseFour" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                </div><!-- /accordion-inner -->
                            </div><!-- /collapse -->
                        </div><!-- /accordion-group -->
                        <br>
                    </div><!-- Accordion -->
                </div>
            </div>
        </div><!--/ .container -->
    </div><!--/ #features -->


    <section id="showcase" name="showcase"></section>
    <div id="showcase">
        <div class="container">
            <div class="row">
                <h1 class="centered">{{ trans('message.screenshots') }}</h1>
                <br>
                <div class="col-lg-8 col-lg-offset-2">
                    <div id="carousel-example-generic" class="carousel slide">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="{{ asset('/img/item-01.png') }}" alt="">
                            </div>
                            <div class="item">
                                <img src="{{ asset('/img/item-02.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
        </div><!-- /container -->
    </div>


    <section id="contact" name="contact"></section>
    <div id="footerwrap">
        <div class="container">
            <div class="col-lg-5">
                <h3>{{ trans('message.address') }}</h3>
                <p>
                    Av. Greenville 987,<br/>
                    New York,<br/>
                    90873<br/>
                    United States
                </p>
            </div>

            <div class="col-lg-7">
                <h3>{{ trans('message.dropus') }}</h3>
                <br>
                <form role="form" action="#" method="post" enctype="plain">
                    <div class="form-group">
                        <label for="name1">{{ trans('message.yourname') }}</label>
                        <input type="name" name="Name" class="form-control" id="name1" placeholder="{{ trans('message.yourname') }}">
                    </div>
                    <div class="form-group">
                        <label for="email1">{{ trans('message.emailaddress') }}</label>
                        <input type="email" name="Mail" class="form-control" id="email1" placeholder="{{ trans('message.enteremail') }}">
                    </div>
                    <div class="form-group">
                        <label>{{ trans('message.yourtext') }}</label>
                        <textarea class="form-control" name="Message" rows="3"></textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-large btn-success">{{ trans('message.submit') }}</button>
                </form>
            </div>
        </div>
    </div>
    <div id="c">
        <div class="container">
            <p>
                <a href="https://github.com/nilsenj/storecamp"></a><b>admin-StoreCamp-laravel</b></a>. {{ trans('message.descriptionpackage') }}.<br/>
                <strong>Copyright &copy; {!! date('Y') !!} <a href="http://stroecamp.org">StoreCamp.io</a>.</strong> {{ trans('message.createdby') }} .{{ trans('message.seecode') }} <a href="https://github.com/nilsenj/storecamp">Github</a>
                <br/>
                StoreCamp {{ trans('message.createdby') }} Nikolenko Ivan
                <br/>
            </p>

        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('custom_vendors/jQuery/jQuery-2.1.4.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('/js/app.js') }}"></script>
<script src="{{ asset('/js/smoothscroll.js') }}"></script>
<script>
    $('.carousel').carousel({
        interval: 3500
    })
</script>
</body>
</html>