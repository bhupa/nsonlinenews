@extends('backend.app')
@section('title',trans('labels.admin.advertising.add'))
@section('css_scripts')
    <style>
        .add-cancle, .add-cancle-btn{
            position: absolute;
            left: 27%;
            top: 0%;
        }
    </style>
@endsection
@section('content')

    <div class="content">

        <!-- Input group addons -->

        <div class="card">

            <div class="card-header">
                <ol class="breadcrumb" style="margin-bottom: 5px;">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    @if($user->can('view-advertising'))
                        <li><a href="{{ route('advertise.index') }}">/{{ trans('labels.admin.advertising.list') }}</a></li>
                    @endif
                    <li class="active">/ {{ trans('labels.admin.advertising.add') }}</li>
                </ol>
            </div>

            <div class="card-body">


                {!! Form::open(array('route' => ['advertise.update',$advertisings->id],'class'=>'row','id'=>'add-gallery', 'files' => 'true')) !!}

                <legend class="text-uppercase font-size-sm font-weight-bold">{{ trans('labels.admin.advertising.add') }}</legend>
                <div class="container">
                    <div class="form-group row {{ $errors->has('title') ? 'has-errors' : '' }}">
                        <label class="control-label col-lg-2">Name</label>

                        <div class="col-lg-10">

                            {!! Form::text('title',$advertisings->title, array('class'=>'form-control','id'=>'edit-advertising','placeholder'=>'Advertising title' )) !!}
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
                            @if($advertisings->home == '1')

                            @if(file_exists('storage/'.$advertisings->image) && $advertisings->image !== '')
                                <img src="{{ asset('storage/'.$advertisings->image)}}" class="displayimage" style="width:100px; height:100px; margin-bottom: 15px;" alt=""></br>

                            @endif
                            @endif
                                @if($advertisings->single == '1')

                                    @if(file_exists('storage/'.$advertisings->image) && $advertisings->image !== '')
                                        <img src="{{ asset('storage/'.$advertisings->image)}}" class="displayimage" style="width:100px; height:100px; margin-bottom: 15px;" alt=""></br>

                                    @endif
                                @endif
                                <div id="home-image" style="display:none">
                                    <input name="home-image" type="file" class="home-fileimage" accept="image/*" >

                                </div>
                                <div id="single-image">
                                    <input name="single-image" type="file" class="fileimage" accept="image/*">

                                </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group row {{ $errors->has('home') ? 'has-errors' : '' }}">
                        <label class="control-label col-lg-2">Home</label>

                        <div class="col-lg-10">
                            <input type="checkbox" id="home" name="home" value=""
                            <?php if($advertisings->home==true) echo " checked "?>>
                            @if($errors->has('home'))
                                <span class="help-block">
                                    <strong>
                                        {{ $errors->first('home') }}
                                    </strong>

                                </span>
                            @endif

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group row {{ $errors->has('single') ? 'has-errors' : '' }}">
                        <label class="control-label col-lg-2">Single</label>

                        <div class="col-lg-10">
                            <input type="checkbox" id="single" name="single" value=""
                            <?php if($advertisings->single==true) echo " checked "?>>
                            @if($errors->has('single'))
                                <span class="help-block">
                                    <strong>
                                        {{ $errors->first('single') }}
                                    </strong>

                                </span>
                            @endif

                        </div>
                    </div>
                    <div class="clearfix">
                    <div class="form-group row">
                        <label class="control-label col-lg-2">Publish ?</label>
                        <div class="col-lg-10">
                            <div class="make-switch ">
                                {!! Form::checkbox('is_active',$advertisings->is_active, array('class' => 'switch','data-on-text'=>'On','data-off'=>'Off', 'data-on-color'=>'success','data-off-color'=>'danger' )) !!}

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
                    onload = function() {
                        var home = $('#home').is(":checked");
                        var  single = $('#single').is(":checked");
                        if(home == true){
                            $('#home-image').css('display','block');
                                $('#single-image').css('display','none');
                        }
                        else {
                            $('#home-image').css('display','none');
                                $('#single-image').css('display','block');
                        }
                    }
                    $('#home').change(function(){
                        if($(this).is(":checked")) {
                            debugger
                            $('#home-image').css('display','block');
                            $('#single-image').css('display','none');
                        }
                    })
                    $('#single').change(function(){
                        if($(this).is(":checked")) {

                            $('#home-image').css('display','none');
                            $('#single-image').css('display','block');
                        }
                    })
                    $(".fileimage").change(function() {
                        singlePreview(this);
                    });
                    function singlePreview(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#uploadForm + img').remove();
                                $('#single-image').append('<input type="button" id="addcancle" class="add-cancle" value="Delete" >');

                                $('#single-image').append('<img src="'+e.target.result+'" id="single-img" style="margin-top:10px" width="200" height="200"/>');
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    $(".home-fileimage").change(function() {
                        filePreview(this);
                    });
                    function filePreview(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                $('#uploadForm + img').remove();
                                $('#home-image').append('<input type="button" id="addcanclebtn" class="add-cancle-btn" value="Delete" >');
                                $('#home-image').append('<img src="'+e.target.result+'" id="home-img" style="margin-top:10px" width="200" height="200"/>');
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }
                    $('#edit-advertising').on('click','#addcancle',function(){
                        debugger
                        $('#single-img').remove();
                        $('#addcancle').remove();
                        $(".home-fileimage").val('');

                    });
                    $('#home-image').on('click','#addcanclebtn',function(){
                        $('#home-img').remove();
                        $('#addcanclebtn').remove();
                        $(".fileimage").val('');
                    });

                    $('#add-advertisement').on('submit',function(){

                        var single =$('.fileimage').val();
                        var home =$('.home-fileimage').val();
                        debugger
                        if(single == ''){
                            $('.fileimage').remove();
                        }
                        else{
                            debugger
                            $('.home-fileimage').remove();
                        }
                    });

                });
            </script>
@stop
