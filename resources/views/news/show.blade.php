@extends('layouts.frontend.app')
@section('title', $news->title)
@section('facebook_meta')
  <meta property="og:image" content="{{asset('storage/'.$news->image)}}"  style="display:none"/>
@stop
@section('content')

    <div id="content" class="site-content global-layout-right-sidebar">
        <div class="container">
            <div class="inner-wrapper">
                <div class="row">
                    <div class="col-lg-9">
                         <div id="primary" class="content-area">
                    <main id="main" class="site-main" >
                        <article class="hentry post">
                            <div class="entry-thumb aligncenter thumb-overlay">
                                @if(file_exists('storage/'.$news->image) && $news->image !== '')
                                    <a  href="{{route('news.show',[$news->slug])}}" >
                                        <img  src="{{asset('storage/'.$news->image)}}" alt="{{$news->slug}}">
                                    </a>
                                @endif

                            </div> <!-- .entry-thumb -->
                            <div class="entry-content-wrapper">
                                <header class="entry-header">
                                    <h2 class="entry-title">
                                        <a href="{{route('news.show',[$news->slug])}}" rel="bookmark">
                                            {{$news->title}}
                                        </a>
                                    </h2>
                                </header><!-- .entry-header -->
                                <div class="entry-meta">
                                    <i class="icon-calendar"></i><span class="author vcard">
                                         {{$news->publish_date}}
                                        </span>
                                    <i class="fa fa-eye"></i><span>{{$news->view}}</span>

                                </div>
                                <div class="entry-content">
                                    {!! $news->description !!}
				                                    <a href="javascript:void(0)" style="background: #4267b2;" class="btn btn-primary" onclick="fb_share('{{ route('news.show',[$news->slug]) }}', '{{ $news->title}}')" data-bg-color="#3A5795" class="fb-btn">Facebook--Share</a>

                                   </div>
                                </div><!-- .entry-content -->
                            </div><!-- .entry-content-wrapper -->
                        </article><!-- .post -->
                        <div class="fb-comments" data-href="{{route('news.show',[$news->slug])}}" data-numposts="20"></div>
                    </main>
                </div>
                    
                    <div class="col-lg-3">
                        <div class="single-page-side">
                        <h3 class="widget-title"><span class="widget-title-wrapper">
                                    {{ trans('labels.admin.news.viewed')}}
                                </span></h3>
                        @foreach($mostviews as $abolis)
                            <div class="custom-media">
                                <div class="media-left media-top">
                                    @if(file_exists('storage/'.$abolis->image)  && $abolis->image)
                                        <img src="{{ asset('storage/'.$abolis->image) }}" class="media-object" >
                                    @endif


                                </div>
                                <div class="media-body">

                                    <h4 class="media-heading"><a href="{{route('news.show',[$abolis->slug])}}">{{str_limit($abolis->title,'20','.....')}}</a></h4>
                                    <span>{{$abolis->publish_date}}</span>
                                    {!! str_limit($abolis->short_description,'90','...') !!}
                                    <div class="media-footer">
                                       <span>  <i class="fas fa-pencil-alt"></i>
                                       {{$abolis->author->firstname}} {{$abolis->author->lastname}}</span>
                                    <span><i class="fa fa-eye"></i>{{$abolis->view}} </span>
                                    </div>


                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div> <!-- .sidebar -->
                </div>
                </div>
            </div> <!-- #inner-wrapper -->
        </div><!-- .container -->
    </div>
<div id="fb-root"></div>
@endsection

@section('js_script')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>

    <script>
(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3&appId=464414370786393";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));


        function fb_share(dynamic_link,dynamic_title) {
            var app_id = '464414370786393';
            var pageURL="https://www.facebook.com/dialog/feed?app_id=" + app_id + "&link=" + dynamic_link;
            var w = 600;
            var h = 400;
            var left = (screen.width / 2) - (w / 2);
            var top = (screen.height / 2) - (h / 2);
            window.open(pageURL, dynamic_title, 'toolbar=no, location=no, directories=no, status=no, menubar=yes, scrollbars=no, resizable=no, copyhistory=no, width=' + 800 + ', height=' + 650 + ', top=' + top + ', left=' + left)
            return false;
        }

	</script>

@endsection
