@extends('layouts.frontend.app')
@section('title', trans('labels.admin.video.name'))
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
                                <div class="video">

                                    <div class="row">
                                        @foreach($videos as  $video)
                                            <div class="col-lg-3">
                                                <div  class="video-image">
                                                    <a href="{{$video->url}}" class="vidoe-img">
                                                        <img class="img" alt="{{ $video->title }}" src="{{$video->image}}">
                                                    </a>
                                                </div>
                                                <div class="video-title">
                                                    <a href="{{$video->url}}" class="vidoe-img">
                                                        <span>{{ str_limit($video->title,'50','.....')}}</span>
                                                    </a>
                                                </div>

                                            </div>
                                        @endforeach
                                        {{$videos->render()}}
                                    </div>

                                </div>

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

        $(document).ready(function(){
            $('.vidoe-img').on('click',function(event) {
                event.preventDefault();
                event.stopPropagation();
                var href = $(this).attr('href');
                window.open(href , '_blank');
            });
        });

    </script>
@endsection