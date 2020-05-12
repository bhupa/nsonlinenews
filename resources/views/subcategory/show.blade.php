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
                <div class="sub-content-area">
                            <div class="container">
                                    <div class="row">
                                        @foreach( $subcategories as  $category)
                                            <div class="col-lg-3">
                                                <div class="article">
                                                    <div class="article-img">
                                                        <a href="{{route('news.show',[$category->slug])}}">
                                                            @if(file_exists('storage/'.$category->image) && $category->image !== '')
                                                             <img src="{{asset('storage/'.$category->image)}}" alt="{{$category->title}}">
                                                            @endif
                                                        </a>

                                                    </div>
                                                    <div class="content">
                                                        <div class="content-link">
                                                        <span>   <i class="fas fa-pencil-alt"></i>{{$category->author->firstname}} {{$category->author->lastname}}</span>
                                                        <span><i class="far fa-clock"></i> <strong>{{ Carbon\Carbon::parse($category ->created_at)->diffForHumans(null, true)}}</strong></span>
                                                        <span> <i class="fa fa-eye"></i> <strong>{{$category ->view }}</strong></span>
                                                        </div>
                                                        <a href="{{route('news.show',[$category->slug])}}">{{ str_limit($category->title,'50','')}}</a>
                                                        <span>{!! str_limit($category->short_description,'150','....') !!}  </span>
                                                    </div>

                                                </div>

                                            </div>

                                        @endforeach
                                        {{ $subcategories->render()}}
                                    </div>

                            </div><!-- end masonry-wrapper -->
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