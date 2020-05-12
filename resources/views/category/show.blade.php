@extends('layouts.frontend.app')
@section('title',$category->name.'--' ) `
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
                            <div col-lg-9>
                                <div class="sub-category-list">
                                    <ul class="category-sub-lists">
                                       @foreach($category->child as $cat)
                                        <li>
                                            <a href="{{route('subcategory.show', [$cat->id])}}">{{$cat->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                    <div class="row">
                                    @foreach($news as $catnew)
                                        <div class="col-lg-3">
                                            <span>{{$catnew->subcategory['name']}}</span>
                                             <div class="cat-new-content">
                                                <div class="content-img">
                                                    @if(file_exists('storage/'.$catnew->image) && $catnew->image !== '')
                                                    <img src="{{asset('storage/'.$catnew->image)}}" alt="{{$catnew->title}}">
                                                        @endif
                                                </div>
                                                <div class="content-cont">
                                                    <a href="{{route('news.show', [$catnew->slug])}}">{{$catnew->title}}</a>
                                                    {!! str_limit($catnew->short_description,'150','....') !!}
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                            </div>
                            <div col-lg-3>

                            </div>
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