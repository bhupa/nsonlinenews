@extends('backend.app')
@section('title','Add Video')
@section('content')

    <div class="content">

        <!-- Input group addons -->

        <div class="card">

            <div class="card-header">
                <ol class="breadcrumb" style="margin-bottom: 5px;">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    @if($user->can('view-video'))
                        <li><a href="{{ route('videos.index') }}">/Video</a></li>
                    @endif
                    <li class="active">/Add new Video</li>
                </ol>
            </div>

            <div class="card-body">


                {!! Form::open(array('route' => 'videos.store','class'=>'row','id'=>'add-video', 'files' => 'true')) !!}

                <legend class="text-uppercase font-size-sm font-weight-bold">Add Video</legend>
                <div class="container">
                    <div class="form-group row {{ $errors->has('title') ? 'has-errors' : '' }}">
                        <label class="control-label col-lg-2">Title</label>

                        <div class="col-lg-10">

                            {!! Form::text('title', null, array('class'=>'form-control','placeholder'=>'Video title' )) !!}
                            @if($errors->has('title'))
                                <span class="help-block">
                                    <strong>
                                        {{ $errors->first('title') }}
                                    </strong>

                                </span>
                            @endif

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="clearfix"></div>
                    <div class="form-group row">
                        <label class="control-label col-lg-2 {{ $errors->has('description') ? 'has-errors'  : ''}}">Description </label>
                        <div class="col-lg-10">
                            {!! Form::url('url', null, array('class'=>'form-control', 'placeholder'=>'Please insert the Url','id'=>'editor')) !!}
                            @if($errors->has('url'))
                                <span class="help-block">
                                <strong>{{ $errors->first('url')}}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group row">
                        <label class="control-label col-lg-2">Publish ?</label>
                        <div class="col-lg-10">
                            <div class="make-switch ">
                                {!! Form::checkbox('is_active', 1, true, array('class' => 'switch','data-on-text'=>'On','data-off'=>'Off', 'data-on-color'=>'success','data-off-color'=>'danger' )) !!}

                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="text-left col-lg-offset-2">
                        <button type="submit" class="btn btn-primary legitRipple">
                            Submit <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /input group addons -->


            <!-- /touchspin layouts -->

        </div>


        @stop
        @section('js_script')
            <script type="text/javascript">
                $(document).ready(function(){
                    $("[name='is_active']").bootstrapSwitch();

                    $(".bod-picker").nepaliDatePicker({
                        dateFormat: "%D, %M %d, %y",
                        closeOnDateSelect: true
                    });



                });
            </script>
@stop
