@extends('backend.app')
@section('title',trans('labels.admin.advertising.add'))
@section('content')

    <div class="content">

        <!-- Input group addons -->

        <div class="card">

            <div class="card-header">
                <ol class="breadcrumb" style="margin-bottom: 5px;">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    @if($user->can('view-popup'))
                        <li><a href="{{ route('popup.index') }}">/{{ trans('labels.admin.popup.list') }}</a></li>
                    @endif
                    <li class="active">/ {{ trans('labels.admin.popup.add') }}</li>
                </ol>
            </div>

            <div class="card-body">


                {!! Form::open(array('route' => ['popup.update',$popup->id],'class'=>'row','id'=>'add-gallery', 'files' => 'true')) !!}

                <legend class="text-uppercase font-size-sm font-weight-bold">{{ trans('labels.admin.advertising.add') }}</legend>
                <div class="container">
                    <div class="form-group row {{ $errors->has('title') ? 'has-errors' : '' }}">
                        <label class="control-label col-lg-2">Name</label>

                        <div class="col-lg-10">

                            {!! Form::text('title',$popup->title, array('class'=>'form-control','placeholder'=>'Advertising title' )) !!}
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
                        <label class="control-label col-lg-2">{{ trans('labels.admin.popup.table.image') }}</label>
                        <div class="col-lg-10 popup">
                            @if(file_exists('storage/'.$popup->image) && $popup->image !== '')
                                <img src="{{ asset('storage/'.$popup->image)}}" class="displayimage" style="width:100px; height:100px; margin-bottom: 15px;" alt=""></br>

                            @endif

                            <input name="image" type="hidden" class="fileimage" accept="image/*">
                            <div id="form1" runat="server">
                                <input type='file' id="imgInp" accept="image/*" /></br> </br>
                                @if($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('image')}}</strong>
                                    </span>
                                @endif
                                <img id="my-image" src="#" />
                            </div>
                            
                            <input type="button" class="use" value="Crop" >
                            <input type="button" class="cancle-btn" value="Delete" ></br> </br>
                            <div class="result"></div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="form-group row">
                            <label class="control-label col-lg-2">Publish ?</label>
                            <div class="col-lg-10">
                                <div class="make-switch ">
                                    {!! Form::checkbox('is_active',$popup->is_active, array('class' => 'switch','data-on-text'=>'On','data-off'=>'Off', 'data-on-color'=>'success','data-off-color'=>'danger' )) !!}

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

                        $('.cancle-btn').on('click', function(){
                            $('.croppie-container').hide();
                            $('.cr-image').attr('src', '');
                            $('.cr-boundary').remove();
                            $('.cr-slider').remove();
                            $('.result').empty();
                            $('.use').hide();
                            $('.cancle-btn').hide();
                            $("#imgInp").val('');
                            $(".fileimage").val('');
                        });
                        function readURL(input) {
                            $('.croppie-container').css('display','block');
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    $('#my-image').attr('src', e.target.result);
                                    var resize = new Croppie($('#my-image')[0], {
                                        viewport: { width: 600, height: 500 },
                                        boundary: { width: 800, height: 600 },
                                        showZoomer: true,
                                        enableResize: true,
                                        enableOrientation: false,
                                        format:'jpeg'

                                    });

                                    $('.use').fadeIn();
                                    $('.cancle-btn').fadeIn();
                                    $('.use').on('click', function() {
                                        resize.result({type: 'canvas', size: { width:1250,height:1250}}).then(function(dataImg) {


                                            var data = [{ image: dataImg }, { name: 'myimgage.jpg' }];
                                            if( $('#leftmenu').is(':empty') ) {
                                                // use ajax to send data to php
                                                $('.result').css('display', 'block');
                                                $('.result').append('<img src="' + dataImg + '" style="width:200px; height:200px"    >');
                                                $('.fileimage').val(dataImg);
                                                $('.displayimage').css('display', 'none');
                                            }else{
                                                $('.result').empty();
                                                $('.result').css('display', 'block');
                                                $('.result').append('<img src="' + dataImg + '" style="width:200px; height:200px"    >');
                                                $('.fileimage').val(dataImg);
                                                $('.displayimage').css('display', 'none');
                                            }

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
