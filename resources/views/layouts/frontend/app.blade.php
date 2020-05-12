<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
 @yield('facebook_meta')
    <title>@yield('title')</title>
    <meta name="description" content="nsOnlinekhabar">

    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" />
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
   <link rel="stylesheet" type="text/css" href="{{asset('frontend/third-party/sidr/css/jquery.sidr.dark.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/third-party/slick/css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/third-party/slick/css/slick-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/third-party/wow/css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/third-party/prettyphoto/css/prettyPhoto.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/third-party/accordionjs/css/accordion.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/icons/icons.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/third-party/fakeloader/fakeLoader.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/mystyle.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/responsive.css')}}">
    <link rel="stylesheet" id="color" href="{{asset('frontend/css/default.css')}}">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Hind:400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700" rel="stylesheet">
    @yield('css_script')
</head>
<body class="home header-v1">
<div id="page" class="site">
    <!-- Mobile main menu -->
    <a href="#" id="mobile-trigger"><i class="fa fa-list" aria-hidden="true"></i></a>
    <div id ="mob-menu">
        <ul>
            <li class="current-menu-item "><a href="{{route('home')}}">होमपेज</a></li>
            @foreach($categories as $category)
                <li><a href="{{route('categories.show',[$category->name])}}">{{$category->name}}</a></li>

            @endforeach
            <li class="current-menu-item "><a href="{{route('video.index')}}">एन एस टिभि</a></li>

        </ul>
    </div>
    <!-- #mob-menu -->

    <header id="masthead" class="site-header" >
        <div class="container">
            <div class="fairtrade-logo"><a href="#."  rel="home"><img alt="logo" src="{{asset('head.jpg')}}"></a></div>
            {{--            <div class="wfto-logo"><a href="#."  rel="home"><img alt="logo" src="images/wfto-logo.jpg"></a></div>--}}
            {{--            <div class="fairtrade-txt"><a href="index.html"><img src="images/fairtrade-txt.jpg" alt=""></a></div>--}}
        </div>
        <!-- .container -->
    </header>
    <!-- .site-header -->
    <div id ="main-navigation" class="sticky-enabled">
        <div class="container">
            <div class="nav-inner-wrapper clear-fix">
                <nav class="main-navigation pull-left">
                    <ul>
                        <li class="current-menu-item "><a href="{{route('home')}}">होमपेज</a></li>
                        @foreach($categories as $category)
                            <li><a href="{{route('categories.show',[$category->name])}}">{{$category->name}}</a></li>

                        @endforeach
                        <li class="current-menu-item "><a href="{{route('video.index')}}">एन एस टिभि</a></li>

                    </ul>
                   
                </nav>
            </div>
            <!-- .nav-inner-wrapper -->
        </div>
        <!-- .container -->
    </div>
    <!-- #main-navigation -->
    <div id="content" class="site-content global-layout-no-sidebar">
        <div class="container">
            <div class="inner-wrapper">
                <div id="primary" class="content-area">
                @yield('content')
                <!-- #main -->
                </div>
                <!-- #primary -->
            </div>
            <!-- .inner-wrapper -->
        </div>
        <!-- .container -->
    </div>
    <!-- #content-->
    <div class="footer-container">
        <div id="footer-widgets">
            <div class="container">
                <div class="inner-wrapper">
                    <div class="row">
                        <div class="col-grid-3">

                            <aside  class="footer-widget">
                                <h3 class="widget-title">About Us</h3>
                                <div class="widget-quick-contact"> <span><i class="fas fa-phone" aria-hidden="true"></i> +977-053540401,+977-9855024744 </span> <span><i class="fas fa-envelope" aria-hidden="true"></i> nsonlinegmail.com </span> <span><i class="far fa-map"></i>Nijgadh- 8, Bara  </span> </div>
                                <div class="social-links brand-color circle">
                                    <ul>
                                        <li><a href="http://facebook.com/" target="_blank"></a></li>
                                        <li><a href="http://youtube.com/" target="_blank"></a></li>
                                        <li><a href="http://twitter.com/" target="_blank"></a></li>
                                        <li><a href="http://linkedin.com/" target="_blank">></a></li>
                                    </ul>
                                </div>
                                <!-- .social-links -->
                            </aside>
                        </div>


                        <!-- .footer-widget-area -->
                        <div class="col-grid-9">
                            @foreach($subcategories as $category)
                                <aside class="footer-active-5 footer-widget-area">
                                    <div class="widget recent-posts-widget">
                                        <h3 class="widget-title"><span class="widget-title-wrapper">{{$category->name}}</span></h3>
                                        <div class="recent-post-item">
                                            <ul>
                                                @foreach($category->child as $subcategory)
                                                    <li><a href="{{route('subcategory.show', [$subcategory->id])}}">{{$subcategory->name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </aside>
                            @endforeach
                        </div>

                        <!-- .footer-widget-area -->
                    </div>
                </div>
                <!-- .inner-wrapper -->
            </div>
            <!-- .container -->
        </div>
        <!-- #footer-widgets -->
        <footer id="colophon" class="site-footer">
            <div class="colophon-bottom">
                <div class="container">
                    <div class="copyright">
                        <p style="color:#000000"> Copyright © {{date("Y")}} <a href="{{route('home')}}" style="color:#000000">nsOnlinKhabar</a>. All rights reserved. </p>
                    </div>
                    <div class="site-info">
                        <p>Developed  By : <a  rel="" href="https://www.facebook.com/sapkota12bhupendra"  style="color:#000000">Bhupendra Sapkota</a> </p>
                    </div>
                    <!-- .site-info -->
                </div>
                <!-- .container -->
            </div>
            <!-- .colophon-bottom -->
        </footer>
        <!-- footer ends here -->
    </div>
    <!-- footer-container -->
</div>
<!--#page-->
<div id="btn-scrollup"> <a  title="Go Top"  class="scrollup button-circle" href="#"><i class="fas fa-angle-up"></i></a> </div>
<script  src="{{asset('frontend/third-party/jquery/jquery-3.2.1.min.js')}}"></script>
<script  src="{{asset('frontend/third-party/jquery/jquery-migrate-3.0.0.min.js')}}"></script>
<script src="{{ asset('backend/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!--Include all compiled plugins (below), or include individual files as needed-->
<script  src="{{asset('frontend/third-party/sidr/js/jquery.sidr.js')}}"></script>
<script  src="{{asset('frontend/third-party/cycle2/jquery.cycle2.js')}}"></script>
<script  src="{{asset('frontend/third-party/slick/js/slick.min.js')}}"></script>
<script  src="{{asset('frontend/third-party/wow/js/wow.min.js')}}"></script>
<script  src="{{asset('frontend/third-party/counter-up/js/waypoints.min.js')}}"></script>
<script  src="{{asset('frontend/third-party/counter-up/js/jquery.counterup.min.js')}}"></script>
<script  src="{{asset('frontend/third-party/isotope/js/isotope.pkgd.min.js')}}"></script>
<script  src="{{asset('frontend/third-party/prettyphoto/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('frontend/third-party/fakeloader/fakeLoader.min.js')}}"></script>
<script  src="{{asset('frontend/third-party/accordionjs/js/accordion.min.js')}}"></script>
<script  src="{{asset('frontend/third-party/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
<script  src="{{asset('frontend/js/contact.js')}}"></script>
<script  src="{{asset('frontend/js/custom.js')}}"></script>
<script  src="{{asset('frontend/js/color-switcher.js')}}"></script>
@yield('js_script')
</body>
</html>
