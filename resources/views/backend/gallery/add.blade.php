@extends('backend.app')
@section('title','Add Gallery')
@section('content')

    <div class="content">

        <!-- Input group addons -->

        <div class="card">

            <div class="card-header">
                <ol class="breadcrumb" style="margin-bottom: 5px;">
                <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                @if($user->can('view-gallery'))
                    <li><a href="{{ route('gallery.index') }}">/Gallery</a></li>
                @endif
                <li class="active">/Add new Gallery</li>
                </ol>
            </div>

            <div class="card-body">


                {!! Form::open(array('route' => 'gallery.store','class'=>'row','id'=>'add-gallery', 'files' => 'true')) !!}

                <legend class="text-uppercase font-size-sm font-weight-bold">Add Gallery</legend>
                <div class="container">
                    <div class="form-group row {{ $errors->has('title') ? 'has-errors' : '' }}">
                        <label class="control-label col-lg-2">Name</label>

                        <div class="col-lg-10">

                            {!! Form::text('title', null, array('class'=>'form-control','placeholder'=>'Gallery title' )) !!}
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
                    <div class="form-group row {{$errors->has('image') ? 'has-errors' : ''}}">
                        <label class="control-label col-lg-2">{{ trans('labels.admin.news.table.images') }}</label>
                        <div class="col-lg-10">

                            <input name="image" type="hidden" class="fileimage">
                            <div id="form1" runat="server">
                                <input type='file' id="imgInp" /></br> </br>
                                @if($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('image')}}</strong>
                                    </span>
                                @endif
                                <img id="my-image" src="#" />
                            </div>
                            {{--<button class="use">Upload</button>--}}
                            <input type="button" class="use" value="Crop" ></br> </br>
                            <div class="result"></div>
                        </div>


                    </div>

                    <div class="clearfix"></div>
                    <div class="form-group row">
                        <label class="control-label col-lg-2 {{ $errors->has('description') ? 'has-errors'  : ''}}">Description </label>
                        <div class="col-lg-10">
                            {!! Form::textarea('description', null, array('class'=>'form-control editor', 'placeholder'=>'Please insert the description','id'=>'editor')) !!}
                            @if($errors->has('description'))
                                <span class="help-block">
                                <strong>{{ $errors->first('description')}}</strong>
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

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#my-image').attr('src', e.target.result);
                    var resize = new Croppie($('#my-image')[0], {
                        viewport: { width: 600, height: 300 },
                        boundary: { width: 800, height: 600 },
                        showZoomer: true,
                        enableResize: false,
                        enableOrientation: false,
                        format:'jpeg'

                    });

                    $('.use').fadeIn();
                    $('.use').on('click', function() {
                        resize.result({type: 'canvas', size: { width:1200,height:600}}).then(function(dataImg) {

                            var data = [{ image: dataImg }, { name: 'myimgage.jpg' }];

                            // use ajax to send data to php

                            $('.result').empty();
                            $('.result').append('<img src="'+dataImg+'" style="width:200px; height:200px">');
                            $('.fileimage').val(dataImg);
                            $('.displayimage').css('display','none');

                        });


                    })
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });

    });
</script>
@stop
