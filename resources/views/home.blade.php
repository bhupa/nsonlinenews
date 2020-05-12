@extends('layouts.frontend.app')
@section('title', 'होमपेज')
@section('content')
    @foreach($popups as $index=>$popup)
        @if($popup->image == null)
            <div id="thover" style="display:none"> </div>
        @else
            <div id="thover"></div>
            <div id="tpopup" > <img src="{{asset('storage/'.$popup->image) }}" alt="Popup">
                <div id="tclose">X</div>
            </div>
        @endif
    @endforeach
    <div class="container">
    <div class="latest-news">
        @foreach($latests as  $recent)
            <div class="top-heading">
                <h1><a href="{{route('news.show', [$recent->slug])}}">{{$recent->title}}</a></h1>
                <ul>
                    <li>
                        <i class="fas fa-pencil-alt"></i>
                      <span>{{$recent->author->firstname}} {{$recent->author->lastname}}</span>

                    </li>
                    <li>
                        <i class="far fa-clock"></i>
                        @php
                            $dates = Carbon\Carbon::parse($recent->created_at)->diffForHumans(null, true);

                            $time =str_replace(['hour', 'minutes' ,'days','week','months','years'], ['घण्टा', 'मिनेट','दिन','हप्ता','महिना','वर्ष'], $dates );

                        @endphp

                        <span> <strong>{{ $time }}अगाडि</strong></span>

                    </li>
                    <li>
                        <i class="far fa-comment-alt-dots"></i>

                    </li>
                    <li>
                        <i class="fa fa-eye"></i><span><strong>&nbsp;&nbsp;{{$recent->view}}</strong></span>

                    </li>

                </ul>
            </div>
            <div class="content-image">
                @if(file_exists('storage/'.$recent->image) && $recent->image)
                    <a href="{{route('news.show', [$recent->slug])}}"><img src="{{asset('storage/'.$recent->image)}}" alt="{{$recent->slug}}"></a>
                @endif
            </div>
            <div class="content-image">
                {!! str_limit($recent->short_description,'300','....') !!}
            </div>

        @endforeach
    </div>
        <div class="samachar">
          @if(!empty($homeadds1))
            <div class="home-add1" style="margin-bottom: 10px;">

                    @if(file_exists('storage/'.$homeadds1->image) &&  $homeadds1->image !== '')
                     <img src="{{asset('storage/'.$homeadds1->image)}}" alt="{{$homeadds1->title}}" >
                    @endif

            </div>
            @endif
            <div class="row">
                <div class="col-lg-9">
                    <div class="category-title">
                        <h2>{{ $samachars->name}}</h2>
                    </div>
                    <div class="row">
                     <div class="col-lg-4">

                   @foreach( $samachars->news()->latest()->take(1)->get() as $latesamachar )

                   <div class="sama-img">
                       <div class="card" >
                                @if(file_exists('storage/'.$latesamachar->image) && $latesamachar->image !== '')
                                   <a href="{{route('news.show', [$latesamachar->slug])}}">
                                       <img class="card-img-top" src="{{ asset('storage/'.$latesamachar->image) }}" alt="{{$latesamachar->title}}">

                                   </a>
                                @endif
                               <div class="card-body">

                                   <span><i class="fas fa-pencil-alt"></i>{{$recent->author->firstname}} {{$recent->author->lastname}}</span>

                                   @php
                                       $dates = Carbon\Carbon::parse($latesamachar->created_at)->diffForHumans(null, true);
                                        $time =str_replace(['hours', 'minutes' ,'day','week','months','years'], ['घण्टा', 'मिनेट','दिन','हप्ता','महिना','वर्ष'], $dates );
                                   @endphp

                                   <span><i class="far fa-clock"></i> <strong>{{ $time }}अगाडि </strong></span>
                                   <span> <i class="fa fa-eye"></i> <strong>{{$latesamachar->view }}</strong></span>

                               <h5 class="card-title"> <a href="{{route('news.show',[$latesamachar->slug])}}">{{ str_limit($latesamachar->title,'50','....') }}</a></h5>
                               <p class="card-text">{!!  str_limit($latesamachar->short_description,'190','....') !!} </p>
                               <a href="{{route('news.show',[$latesamachar->slug])}}" class="btn btn-primary">Readmore</a>
                           </div>
                       </div>
                    @endforeach
                   </div>
                </div>
                     <div class="col-lg-8">
                    @php $latessamachars = $samachars->news()->orderBy('created_at', 'desc')->skip(1)->take(4)->get() @endphp
                    <div class="row">
                    @foreach($latessamachars  as $sama )
                           <div class="col-lg-6">
                             <div class="sama-side">

                                <div class="sama-side-image">
                                    @if(file_exists('storage/'.$sama->image) && $sama->image !== '')
                                        <a href="{{route('news.show',[$sama->slug])}}">
                                            <img class="card-img-top" src="{{ asset('storage/'.$sama->image) }}" alt="{{$sama->title}}">

                                        </a>
                                    @endif
                                        @php
                                            $dates = Carbon\Carbon::parse($sama->created_at)->diffForHumans(null, true);

                                                                        $time =str_replace(['hour', 'minutes' ,'day','week','months','years'], ['घण्टा', 'मिनेट','दिन','हप्ता','महिना','वर्ष'], $dates );

                                        @endphp
                                        <span><i class="far fa-clock"></i> <strong>{{$time}}अगाडि </strong></span>
                                        <span> <i class="fa fa-eye"></i> <strong>{{$sama->view }}</strong></span>
                                </div>
                                <div class="sama-side-title">
                                    <a href="{{route('news.show',[$sama->slug])}}">{{str_limit($sama->title,'20','.....')}}</a>
                                    <span>{!! str_limit($sama->short_description,'90','.....') !!}</span>

                                </div>

                             </div>
                           </div>
                    @endforeach
                    </div>
                </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="second-image">
                        @php $samacharadds= $singleadds->flatten(1)->take(3); @endphp
                        @foreach($samacharadds as $samacharadd)
                        @if(file_exists('storage/'.$samacharadd->image) && $samacharadd->image !== '')
                            <div class="add-img-wrap">
                            <img src="{{asset('storage/'.$samacharadd['image'])}}" alt="{{$samacharadd->title}}">
                            </div>
                        @endif
                            @endforeach
                    </div>
                </div>

            </div>
        </div>
         <div class="sports">
  @if(!empty($homeadds2))
             <div class="home-add1" style="margin-bottom: 10px;">

                 @if(file_exists('storage/'.$homeadds2->image) &&  $homeadds2->image !== '')
                     <img src="{{asset('storage/'.$homeadds2->image)}}" alt="{{$homeadds2->title}}" >
                 @endif

             </div>
@endif
            <div class="row">
                <div class="col-lg-9">
                <div class="category-title">
                    <h2>{{ $sports->name}}</h2>
                </div>

                  <div class="row">

                @foreach($sports->news()->latest()->take(6)->get() as $sport)
                        <div class="col-grid-4">
                            <div class="custom-media">
                                <div class="media-left media-top">
                                    <a href="{{route('news.show',[$sport->slug])}}">
                                    <img src="{{ asset('storage/'.$sport->image) }}" class="media-object" >
                                    </a>

                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="{{route('news.show',[$sport->slug])}}">{{$sport->title}}</a></h4>
                                    {!! str_limit($sport->short_description,'200','...') !!}

                                </div>
                            </div>
                        </div>
                    @endforeach
                  </div>
                </div>

                 <div class="col-lg-3">
                     <div class="single-page-side">
                         <h3 class="widget-title"><span class="widget-title-wrapper">
                         @php
                             $bidahs1 = $bibidhas->child;
                               $bidah1s = $bidahs1->firstWhere('name','विचार')
                         @endphp
                         {{ $bidah1s->name }}
                         </span></h3>
                                     <ul class="list-news">
                                         @foreach($bidah1s->news()->latest()->take(8)->get() as $bidah1)
                                         <li><a href="{{route('news.show',[$bidah1->slug])}}">{{str_limit($bidah1->title,'100','.....')}}</a></li>
                                         @endforeach
                                     </ul>
                     </div>

                 </div>

            </div>


    </div>
         <div classs="information">
        <div class="row">
            <div class="col-lg-12">
                <div class="category-title">
                    <h2>{{ $information->name}}</h2>
                </div>
        <div class="row">
            <div class=" col-lg-9">

                @php  $informs = $information->news()->latest()->take(1)->get() @endphp
                @foreach( $informs as  $inform)
                  <div class="information-inner">

                      <div class="img" style="margin-bottom:15px;">
                          @if(file_exists('storage/'.$inform->image) &&  $inform->image !== '')
                              <img src="{{asset('storage/'.$inform->image)}}" alt="{{$inform->title}}">
                          @endif
                      </div>
                      <div class="description">
                          <h3><a href="{{route('news.show',[$inform->slug])}}">{{$inform->title}}</a></h3>
                          {!! str_limit($inform->short_description,'400','..') !!}
                      </div>
                  </div>

                @endforeach
            </div>
            <div class=" col-lg-3">
                @php  $informs = $information->news()->latest()->skip(1)->take(4)->get() @endphp

                @foreach($informs as $dtinform)
                    <div class="custom-media">
                        <div class="media-left media-top">
                            <img src="{{ asset('storage/'.$dtinform->image) }}" class="media-object" >

                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="{{route('news.show',[$inform->slug])}}">{{ str_limit($dtinform->title,'20','.....')}}</a></h4>
                            {!! str_limit($dtinform->short_description,'100','...') !!}

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
            </div>
        </div>


    </div>
        <div class="business">
@if(!empty($homeadds3))
            <div class="home-add1" style="margin-bottom: 10px;">

                @if(file_exists('storage/'.$homeadds3->image) &&  $homeadds3->image !== '')
                    <img src="{{asset('storage/'.$homeadds3->image)}}" alt="{{$homeadds3->title}}" >
                @endif

            </div>
            @endif
            <div class="category-title">
            <h2>{{ $buissness->name}}</h2>
            </div>
            <div class="row">
                @php  $bussines = $buissness->news()->latest()->take(4)->get() @endphp
                @foreach($bussines as $bussine )
                    <div class="col-lg-3">
                        <div class="card" >
                            @if(file_exists('storage/'.$bussine->image) && $bussine->image !== '')
                                <a href="{{route('news.show', [$bussine->slug])}}">
                                    <img class="card-img-top" src="{{ asset('storage/'.$bussine->image) }}" alt="{{$bussine->title}}">

                                </a>
                            @endif
                            <div class="card-btn">

                                <span>   <i class="fas fa-pencil-alt"></i>{{$recent->author->firstname}} {{$bussine->author->lastname}}</span>
                                @php
                                    $dates = Carbon\Carbon::parse($recent->created_at)->diffForHumans(null, true);

                                   $time =str_replace(['hour', 'minutes' ,'days','week','months','years'], ['घण्टा', 'मिनेट','दिन','हप्ता','महिना','वर्ष'], $dates );

                                @endphp
                                <span><i class="far fa-clock"></i> <strong>{{ $time}}अगाडि</strong></span>
                                <span> <i class="fa fa-eye"></i> <strong>{{$bussine->view }}</strong></span>
                            </div>
                            <div class="card-body">
                                {{--                        <span><i class="far fa-clock"></i> <strong>{{ Carbon\Carbon::$bussine->created_at)->diffForHumans(null, true)}}</strong></span>--}}

                                <h5 class="card-title"> <a href="{{route('news.show',[$bussine->slug])}}">{{ str_limit($bussine->title,'50','....') }}</a></h5>
                                <p class="card-text">{!!  str_limit($bussine->short_description,'135','....') !!} </p>
                                <a href="{{route('news.show',[$bussine->slug])}}" class="btn btn-primary">Readmore</a>

                            </div>
                        </div>


                    </div>
                @endforeach
            </div>
        </div>
        <div classs="aboard">
@if(!empty($homeadds4))
            <div class="home-add1" style="margin-bottom: 10px;">

                @if(file_exists('storage/'.$homeadds4->image) &&  $homeadds4->image !== '')
                    <img src="{{asset('storage/'.$homeadds4->image)}}" alt="{{$homeadds4->title}}" >
                @endif

            </div>
           @endif


            @php  $abordes =  $aboards->news()->latest()->take(1)->get() @endphp

            <div class="row">

                <div class=" col-lg-9">
                    <div class="category-title">
                        <h2>{{ $aboards->name}}</h2>
                    </div>

                   @foreach($abordes as $aborde)

                    <div class="top-left">
                        @if(file_exists('storage/'.$aborde->image)  && $aborde->image)
                        <img src="{{ asset('storage/'.$aborde->image)}}" alt="{{$aborde->image}}">
                        @endif
                    </div>
                    <div class="top-right">
                        <h2><a href="{{route('news.show',[$aborde->slug])}}">{{$aborde->title}}</a></h2>
                        <p>{!! str_limit($aborde->short_description,'200','.....') !!}</p>

                    </div>
                @endforeach

                    @php $abordelists =  $aboards->news()->latest()->skip(1)->take(3)->get()  @endphp
                   <div class="row">
                    @foreach($abordelists as $abordelist)
                        <div class="col-lg-4">
                            <div class="aboard-list">

                            <div class="aboard-iner">
                                @if(file_exists('storage/'.$abordelist->image)  && $abordelist->image)
                                    <img src="{{ asset('storage/'.$abordelist->image)}}" alt="{{$abordelist->image}}">
                                    @endif
                                    @php
                                        $dates = Carbon\Carbon::parse($abordelist->created_at)->diffForHumans(null, true);

                                                                    $time =str_replace(['hour', 'minutes' ,'days','week','months','years'], ['घण्टा', 'मिनेट','दिन','हप्ता','महिना','वर्ष'], $dates );

                                    @endphp
                                    <span><i class="far fa-clock"></i> <strong>{{$time}}अगाडि </strong></span>
                                    <span> <i class="fa fa-eye"></i> <strong>{{$abordelist->view }}</strong></span>
                                <h3><a href="{{route('news.show',[$abordelist->slug])}}">{{str_limit($abordelist->title,'50','...')}}</a></h3>

                                    <div class="desription">
                                        {!! str_limit($abordelist->short_description,'100','...') !!}
                                    </div>
                            </div>



                         </div>
                        </div>

                       @endforeach
      </div>
                </div>

                <div class=" col-lg-3">

                    <div class="single-page-side">
                        <h3 class="widget-title"><span class="widget-title-wrapper">
                         @php
                             $bidahs1 = $bibidhas->child;
                               $bidah1s = $bidahs1->firstWhere('name','साहित्य')
                         @endphp
                                {{ $bidah1s->name }}
                         </span></h3>
                        <ul class="list-news">
                            @foreach($bidah1s->news()->latest()->take(8)->get() as $bidah1)
                                <li><a href="{{route('news.show',[$bidah1->slug])}}">{{str_limit($bidah1->title,'100','.....')}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="second-image">
                        @php $aboaradds=  $singleadds->slice(3)->take(3); @endphp
                        @foreach($aboaradds as $samacharadd)
                            @if(file_exists('storage/'.$samacharadd->image) && $samacharadd->image !== '')
                                <div class="add-img-wrap">
                                    <img src="{{asset('storage/'.$samacharadd['image'])}}" alt="{{$samacharadd->title}}">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="video">
            <div class="category-title">
            <h2>एन एस टिभि</h2>
            </div>
                        <div class="row">
                            @php $video =$videos->first() @endphp

                                <div class="col-lg-6">
                                    <div  class="video-image">

                                        <a href="{{$video->url}}" class="vidoe-img">
                                            <iframe width="100%" height="480" src="https://www.youtube.com/embed/{{$video->url}}" frameborder="0" allowfullscreen></iframe>

                                        </a>



                                    </div>


                                </div>

                                <div class="col-lg-6">
                                    <div class="row">
                                        @foreach($videos->slice(1) as $video)
                                            <div class="col-lg-6">
                                            <div  class="video-image">
                                                <a href="{{$video->url}}" class="vidoe-img">
                                                    <iframe width="100%" height="240" src="https://www.youtube.com/embed/{{$video->url}}" frameborder="0" allowfullscreen></iframe>

                                                </a>
                                            </div>

                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                        </div>

        </div>
        <div class="entertainment">
@if(!empty($homeadds5))
            <div class="home-add1" style="margin-bottom: 10px;">

                @if(file_exists('storage/'.$homeadds5->image) &&  $homeadds5->image !== '')
                    <img src="{{asset('storage/'.$homeadds5->image)}}" alt="{{$homeadds5->title}}" >
                @endif

            </div>
            @endif    

        <div class="category-title">
                <h2>{{ $entertainments->name}}</h2>
            </div>
            <div class="row">


                        <div class="col-lg-4">
                            @php  $entertainsment =  $entertainments->news()->latest()->take(1)->get() @endphp
                            @foreach($entertainsment as $entertainment)
                                <div class="card" >
                                    @if(file_exists('storage/'.$entertainment->image) && $entertainment->image !== '')
                                        <a href="{{route('news.show', [$entertainment->slug])}}">
                                            <img class="card-img-top" src="{{ asset('storage/'.$entertainment->image) }}" alt="{{$entertainment->title}}">

                                        </a>
                                    @endif
                                    <div class="card-btn">
                                        <span>   <i class="fas fa-pencil-alt"></i>{{$entertainment->author->firstname}} {{$entertainment->author->lastname}}</span>

                                        @php
                                            $dates = Carbon\Carbon::parse($entertainment->created_at)->diffForHumans(null, true);
                                            $time =str_replace(['hour', 'minutes' ,'day','weeks','months','years'], ['घण्टा', 'मिनेट','दिन','हप्ता','महिना','वर्ष'], $dates );

                                        @endphp
                                        <span><i class="far fa-clock"></i> <strong>{{  $time}}अगाडि</strong></span>
                                        <span> <i class="fa fa-eye"></i> <strong>{{$entertainment->view }}</strong></span>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"> <a href="{{route('news.show',[$entertainment->slug])}}">{{ str_limit($entertainment->title,'100','....') }}</a></h5>
                                        <p class="card-text">{!!  str_limit($entertainment->short_description,'200','....') !!} </p>
                                        <a href="{{route('news.show',[$entertainment->slug])}}" class="btn btn-primary">Readmore</a>

                                    </div>

                                    @endforeach
                                </div>
                        </div>
                        @php  $entertainsment =  $entertainments->news()->latest()->skip(1)->take(8)->get() @endphp
                        <div class="col-lg-8">
                            <div class="row">
                                @foreach($entertainsment->chunk(2) as $entertainment)
                                    @foreach($entertainment as $entertain)
                                        <div class="col-lg-6">
                                            <div class="list-side">
                                                <div class="list-image">
                                                    @if(file_exists('storage/'.$entertain->image) && $entertain->image !=='')
                                                        <img src="{{asset('storage/'.$entertain->image)}}" alt="{{$entertain->title}}">
                                                    @endif
                                                </div>
                                                <div class="list-title">

                                                    @php
                                                        $dates = Carbon\Carbon::parse($entertain->created_at)->diffForHumans(null, true);
                                                         $time =str_replace(['hour', 'minutes' ,'days','week','months','years'], ['घण्टा', 'मिनेट','दिन','हप्ता','महिना','वर्ष'], $dates );

                                                    @endphp
                                                    <span><i class="far fa-clock"></i> <strong>{{$time}}अगाडि</strong></span></br>
                                                    <a href="{{route('news.show',[$entertain->slug])}}">{{str_limit($entertain->title,'40','.....')}}</a>
                                                </div>
                                            </div>
                                        </div>


                                    @endforeach
                                @endforeach
                            </div>

                        </div>


                </div>

    </div>
        <div class="lifestyle">
@if(!empty($homeadds6))
            <div class="home-add1" style="margin-bottom: 10px;">

                @if(file_exists('storage/'.$homeadds6->image) &&  $homeadds6->image !== '')
                    <img src="{{asset('storage/'.$homeadds6->image)}}" alt="{{$homeadds6->title}}" >
                @endif

            </div>
            @endif

            <div class="row">

                            @php $lifes = $lifestyles->news()->latest()->take(6)->get() @endphp
                            <div class="col-lg-9">
                                <div class="category-title">
                                    <h2>{{$lifestyles->name}}</h2>
                                </div>

                                        <div class="row">
                                            @foreach($lifes ->chunk(2) as $lifeStylelists)
                                                @foreach($lifeStylelists as $lifeStylelist)
                                                    <div class="col-lg-6">
                                                        <div class="list-side">
                                                            <div class="list-image">
                                                                @if(file_exists('storage/'.$lifeStylelist->image) && $lifeStylelist->image !=='')
                                                                    <img src="{{asset('storage/'.$lifeStylelist->image)}}" alt="{{$lifeStylelist->title}}">
                                                                @endif
                                                            </div>
                                                            <div class="list-title">

                                                                @php
                                                                    $dates = Carbon\Carbon::parse($lifeStylelist->created_at)->diffForHumans(null, true);
                                                                      $time =str_replace(['hour', 'minutes' ,'day','week','months','years'], ['घण्टा', 'मिनेट','दिन','हप्ता','महिना','वर्ष'], $dates );

                                                                @endphp
                                                                <span><i class="far fa-clock"></i> <strong>{{$time}}अगाडि</strong></span></br>
                                                                <a href="{{route('news.show',[$lifeStylelist->slug])}}">{{str_limit($lifeStylelist->title,'40','.....')}}</a>
                                                            </div>
                                                        </div>
                                                    </div>


                                                @endforeach
                                            @endforeach
                                        </div>


                     </div>
                            <div class="col-lg-3">
                                <div class="single-page-side">
                                    <h3 class="widget-title"><span class="widget-title-wrapper">
                         @php
                             $entertain =   $entertainments->child;
                                $entertains =   $entertain ->firstWhere('name','गसिप')
                         @endphp
                                            {{   $entertains->name }}
                         </span></h3>
                                    <ul class="list-news">
                                        @foreach( $entertains->news()->latest()->take(8)->get() as   $entert)
                                            <li><a href="{{route('news.show',[ $entert->slug])}}">{{str_limit( $entert->title,'100','.....')}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="second-image">
                                    @php $aboaradds= $singleadds->slice(6)->take(3); @endphp
                                    @foreach($aboaradds as $samacharadd)
                                        @if(file_exists('storage/'.$samacharadd->image) && $samacharadd->image !== '')
                                            <div class="add-img-wrap">
                                                <img src="{{asset('storage/'.$samacharadd['image'])}}" alt="{{$samacharadd->title}}">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                </div>

            </div>

        </div>
        <div class="politics">
@if(!empty($homeadds7))
            <div class="home-add1" style="margin-bottom: 10px;">

                @if(file_exists('storage/'.$homeadds7->image) &&  $homeadds7->image !== '')
                    <img src="{{asset('storage/'.$homeadds7->image)}}" alt="{{$homeadds7->title}}" >
                @endif

            </div>
            @endif
            <div class="category-title">
            <h2>{{ $politics->name}}</h2>
            </div>
            <div class="row">
                @php  $poliTics = $politics->news()->latest()->take(4)->get() @endphp
                @foreach($poliTics as  $politic )
                    <div class="col-lg-3">
                        <div class="card" >
                            @if(file_exists('storage/'.$politic ->image) && $politic ->image !== '')
                                <a href="{{route('news.show', [$politic ->slug])}}">
                                    <img class="card-img-top" src="{{ asset('storage/'.$politic ->image) }}" alt="{{$politic ->title}}">

                                </a>
                            @endif
                            <div class="card-btn">

                            </div>
                            <div class="card-body">
                                {{--                        <span><i class="far fa-clock"></i> <strong>{{ Carbon\Carbon::$bussine->created_at)->diffForHumans(null, true)}}</strong></span>--}}

                                <h5 class="card-title"> <a href="{{route('news.show',[$politic->slug])}}">{{ str_limit($politic->title,'50','....') }}</a></h5>
                                <p class="card-text">{!!  str_limit($politic->short_description,'135','....') !!} </p>
                                <a href="{{route('news.show',[$politic->slug])}}" class="btn btn-primary">Readmore</a>

                            </div>
                        </div>


                    </div>
                @endforeach
            </div>
        </div>
        <div class="state">

            <div class="row">
                <div class="col-lg-9">
                    <div class="category-title">
                        <h2>{{  $states->name}}</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            @php  $States =  $states->news()->latest()->take(1)->get() @endphp
                            @foreach($States as $state)
                                <div class="top-img">
                                    @if(file_exists('storage/'.$state->image) && $state->image !== '')
                                        <a href="{{route('news.show', [$state->slug])}}">
                                            <img class="card-img-top" src="{{ asset('storage/'.$state->image) }}" alt="{{$state->title}}">

                                        </a>
                                    @endif
                                </div>
                                <div class="content">
                                    <div class="content-list">
                                        @php
                                            $dates = Carbon\Carbon::parse($state->created_at)->diffForHumans(null, true);
                                             $time =str_replace(['hour', 'minutes' ,'days','week','months','years'], ['घण्टा', 'मिनेट','दिन','हप्ता','महिना','वर्ष'], $dates );
                                        @endphp
                                        <span><i class="far fa-clock"></i> <strong>{{ $time }}अगाडि</strong></span>
                                        <span> <i class="fa fa-eye"></i> <strong>{{$state->view }}</strong></span>

                                    </div>
                                    <h4> <a href="{{route('news.show',[$state->slug])}}">{{str_limit($state->title,'40','.....')}}</a></h4>

                                    <p>{!! str_limit($state->short_description,'200','....') !!}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-7">
                            @php  $Stateslists =  $states->news()->latest()->skip(1)->take(4)->get() @endphp
                            <div class="row">
                                @foreach( $Stateslists as  $Stateslist)

                                    <div class="col-lg-6">
                                        <div class="custom-media">
                                            <div class="media-left media-top">
                                                <a href="{{route('news.show',[$Stateslist->slug])}}">
                                                    <img src="{{ asset('storage/'.$Stateslist->image) }}" class="media-object" >
                                                </a>

                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="{{route('news.show',[$Stateslist->slug])}}">{{ str_limit($Stateslist->title,'20','....')}}</a></h4>
                                                {!! str_limit($Stateslist->short_description,'120','...') !!}

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="single-page-side">
                        <h3 class="widget-title"><span class="widget-title-wrapper">
                         @php
                              $entertain =   $entertainments->child;
                                 $entertains =   $entertain ->firstWhere('name','बलिउड /')
                         @endphp
                                {{   $entertains->name }}
                         </span></h3>
                        <ul class="list-news">
                            @foreach( $entertains->news()->latest()->take(8)->get() as   $entert)
                                <li><a href="{{route('news.show',[ $entert->slug])}}">{{str_limit( $entert->title,'100','.....')}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="second-image">
                        @php $aboaradds=  $singleadds->slice(9)->take(3); @endphp
                        @foreach($aboaradds as $samacharadd)
                            @if(file_exists('storage/'.$samacharadd->image) && $samacharadd->image !== '')
                                <div class="add-img-wrap">
                                    <img src="{{asset('storage/'.$samacharadd['image'])}}" alt="{{$samacharadd->title}}">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
        <div class="gallery">
            <div class="category-title">
            <h2>{{trans('labels.admin.gallery.name') }}</h2>
            </div>

                <aside class="section-portfolio lite-background">
                    <div class="container">
                        <div class="row">
                        @foreach( $galleries as  $gallerie)
                        <div class="col-lg-4 gallery-responsive thumb-overlay">
                            <a href="{{route('galleries.show',[$gallerie->id])}}">
                                @if(file_exists('storage/'.$gallerie->image) && $gallerie->image !== '')
                                <img class="aligncenter img-border" alt="{{ $gallerie->title }}" src="{{asset('storage/'.$gallerie->image)}}">
                                    @endif
                            </a>
                            <div class="overlay-box">
                                <a href="{{route('galleries.show',[$gallerie->id])}}">
                                    <i class="icon-attachment">
                                        <div class="gallerylist-title">{{$gallerie->title}}</div>
                                    </i>
                                </a>
                            </div>

                        </div>
                        @endforeach
                        </div>

                    </div><!-- end masonry-wrapper -->
                </aside><!-- end portfolio -->

        </div>
        <div class="interview">
 @if(!empty($homeadds8))
            <div class="home-add1" style="margin-bottom: 10px;">

                @if(file_exists('storage/'.$homeadds8->image) &&  $homeadds8->image !== '')
                    <img src="{{asset('storage/'.$homeadds8->image)}}" alt="{{$homeadds8->title}}" >
                @endif

            </div>
            @endif

            <div class="category-title">
            <h2>{{ $interviews->name}}</h2>
            </div>
            <div class="row">
                <div class=" col-lg-9">
                    @php  $interViews = $interviews->news()->where('is_active', '1')->latest()->take(1)->get() @endphp
                    @foreach($interViews as  $interView)
                        <div class="information-inner">

                            <div class="img">
                                @if(file_exists('storage/'. $interView->image) &&   $interView->image !== '')
                                    <img src="{{asset('storage/'. $interView->image)}}" alt="{{ $interView->title}}">
                                @endif
                            </div>
                            <div class="description">
                                <h2><a href="{{route('news.show',[ $interView->slug])}}">{{ $interView->title}}</a></h2>
                                {!! str_limit( $interView->short_description,'400','..') !!}
                            </div>
                        </div>

                    @endforeach
                </div>
                <div class=" col-lg-3">
                    @php  $interViewS = $interviews->news()->where('is_active', '1')->latest()->skip(1)->take(4)->get() @endphp

                    @foreach($interViewS as $inter)
                        <div class="custom-media">
                            <div class="media-left media-top">
                                <img src="{{ asset('storage/'. $inter->image) }}" class="media-object" >

                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="{{route('news.show',[$inter->slug])}}">{{ str_limit( $inter->title,'20','.....')}}</a></h4>
                                {!! str_limit( $inter->short_description,'100','...') !!}

                            </div>
                        </div>
                    @endforeach

                </div>

            </div>

        </div>
        <div class="literatures">
 @if(!empty($homeadds9))
            <div class="home-add1" style="margin-bottom: 10px;">

                @if(file_exists('storage/'.$homeadds9->image) &&  $homeadds9->image !== '')
                    <img src="{{asset('storage/'.$homeadds9->image)}}" alt="{{$homeadds9->title}}" >
                @endif

            </div>
            @endif
            <div class="category-title">
            <h2>{{ $literatures->name}}</h2>
            </div>
            @php  $Literatures = $literatures->news()->latest()->take(4)->get() @endphp

            <div class="row">
                @foreach($Literatures  as $Literature)
                    <div class="col-lg-3">
                        <div class="aboard-list">
                            <div class="aboard-iner">
                                @if(file_exists('storage/'.$Literature->image)  && $Literature->image)
                                    <img src="{{ asset('storage/'.$Literature->image)}}" alt="{{$Literature->title}}">
                                @endif

                                    @php
                                        $dates = Carbon\Carbon::parse($Literature->created_at)->diffForHumans(null, true);
                                         $time =str_replace(['hour', 'minutes' ,'days','week','months','years'], ['घण्टा', 'मिनेट','दिन','हप्ता','महिना','वर्ष'], $dates );
                                    @endphp
                                <span><i class="far fa-clock"></i> <strong>{{$time}}अगाडि</strong></span>
                                <span> <i class="fa fa-eye"></i> <strong>{{$Literature->view }}</strong></span>
                                <h5><a href="{{route('news.show',[$Literature->slug])}}">{{str_limit($Literature->title,'100','...')}}</a></h5>
                                {!! str_limit($Literature->short_description,'150','....') !!}

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
@endsection

@section('js_script')
    <script>
        $(document).ready(function(){
            $("#thover").click(function(){
                $(this).fadeOut();
                $("#tpopup").fadeOut();
            });


            $("#tclose").click(function(){
                $("#thover").fadeOut();
                $("#tpopup").fadeOut();
            });
            var tab = $('.samachar ul li a').attr('id')
            $(tab).on('click', function(){

            });
            $('.vidoe-img').on('click',function(event) {
                event.preventDefault();
                event.stopPropagation();
                var href = $(this).attr('href');
                window.open(href , '_blank');
            });
        });

    </script>
@endsection
