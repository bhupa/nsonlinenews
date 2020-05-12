@extends('layouts.frontend.app')
@section('title', '')
@section('css_script')
    <style>
       .portfolio-main-wrapper .masonry-wrapper  {
           position: relative;
           overflow: hidden;
           height: 209.484px !important;
       }
    </style>
@endsection
@section('content')
    <div id="content" class="site-content global-layout-no-sidebar">
        <div class="container">
            <div class="inner-wrapper">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" >
                        <aside class="section section-portfolio lite-background">
                            <div class="container">


                                <div class="portfolio-main-wrapper">
                                    <div id="portfolio" class="masonry-wrapper portfolio-container row-fluid wow fadeInUp">
                                        @foreach($images as $image)
                                        <div class="portfolio-item  photography">
                                            <div class="item-inner-wrapper">
                                                <img src="{{  $image->image}}" alt="Portfolio" class="portfolio-thumb">
                                                <div class="overlay"></div>
                                                <a  class="zoom-icon" data-gal="prettyPhoto[product-gallery]" rel="bookmark" href="{{$image->image}}"><i class="icon-focus"></i></a>
                                               
                                            </div>
                                        </div><!-- end item -->
                                        @endforeach
                                    </div>
                                </div><!-- .portfolio-main-wrapper -->


                            </div><!-- end masonry-wrapper -->
                        </aside><!-- end portfolio -->
                    </main> <!-- #main -->
                </div> <!-- #primary -->
            </div> <!-- .inner-wrapper -->
        </div> <!-- .container -->
    </div>
@endsection
@section('js_script')
    <script src="{{URL::to('/')}}/js/lightboxgallery-min.js"></script>
    <script type="text/javascript">
        jQuery(function($) {
            $(document).on('click', '.lightboxgallery-gallery-item', function(event) {
                event.preventDefault();
                $(this).lightboxgallery({
                    showCounter: true,
                    showTitle: true,
                    showDescription: true
                });
            });
        });

        $(document).ready(function(){
            var tab = $('.samachar ul li a').attr('id')
            $(tab).on('click', function(){

            });
        });

    </script>
@endsection