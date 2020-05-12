@extends('backend.app')
@section('title','Edit News')
@section('content')

    <div class="content">

        <!-- Input group addons -->
        <div class="card">

            <div class="card-header">
                <ol class="breadcrumb" style="margin-bottom: 5px;">
                    <li><a href="{{ route('admin.dashboard') }}">होमपेज</a></li>
                    @if($user->can('view-news'))
                        <li><a href="{{ route('ne_ws.index') }}">/{{ trans('labels.admin.news.name')}}</a></li>
                    @endif
                    <li class="active">/{{ trans('labels.admin.news.edit')}}</li>
                </ol>
            </div>
            <div class="card-body">

                <form action="{{ route('ne_ws.update', $new->id) }}" method="post" class="row" role="form"
                      enctype="multipart/form-data" >

                    <legend class="text-uppercase font-size-sm font-weight-bold">{{ trans('labels.admin.news.edit')}}</legend>
                    <div class="container">
                        <div class="form-group row  {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="col-form-label col-lg-2">{{ trans('labels.admin.news.table.name')}}</label>
                            <div class="col-lg-10">
                                <div class="input-group">

                                    <input type="text" name="title" class="form-control" value="{{ $new->title }}"  >

                                </div>
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('category_id') ? 'has-errors' : '' }}">
                            <label class="control-label col-lg-2">{{ trans('labels.admin.news.table.category') }}<span class="text-danger">*</span></label>
                            <div class="col-lg-10">

                                @php $categoies = [];  @endphp
                                @foreach( $categories as $key)
                                    @php $categoies[$key->id] = $key->name; @endphp
                                @endforeach
                                {{Form::select('category_id', $categoies, $new->category_id,['class'=>'form-control', 'placeholder'=>'Please select The Categories','id'=>'select'])}}

                                @if($errors->has('category_id'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('category_id')}}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('sub_category_id') ? 'has-errors' : '' }}">
                            <label class="control-label col-lg-2">{{ trans('labels.admin.news.table.subcategory') }}<span class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                {{Form::select('sub_category_id',array(),null,['class'=>'form-control', 'placeholder'=>'Please select Category From Above list','id'=>'select-sub-category'])}}
                                @if($errors->has('sub_category_id'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('sub_category_id')}}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row {{$errors->has('image') ? 'has-errors' : ''}}">
                            <label class="control-label col-lg-2">{{ trans('labels.admin.news.table.images') }}</label>
                            <div class="col-lg-10">
                                @if(file_exists('storage/'.$new->image) && $new->image !== '')
                                    <img src="{{asset('storage/'.$new->image)}}" alt="{{asset('storage/'.$new->image)}}" class="displayimage" style="width:100px; height:100px">
                                @endif
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

                        <div class="form-group row {{ $errors->has('short_description') ? 'has-errors'  : ''}}">
                            <label class="control-label col-lg-2">Short Description </label>

                            <div class="col-lg-10">
                                {!! Form::textarea('short_description', $new->short_description, array('class'=>'form-control mini-editor','id'=>'editor', 'required' => 'true')) !!}
                                @if($errors->has('short_description'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('short_description')}}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>



                        <div class="form-group row {{ $errors->has('publish_date') ? 'has-errors'  : ''}}">
                            <label class="control-label col-lg-2">Published Date</label>
                            <div class="col-lg-8">
                                <p>

                                    <input type="text" value="{{$new->publish_date}}" name="publish_date" class="bod-picker" placeholder="Select Publish Date">
                                    <button id="clear-bth" onclick="">Clear</button>
                                    @if($errors->has('publish_date'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('publish_date')}}</strong>
                            </span>
                                    @endif
                                </p>

                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group row">
                            <label class="control-label col-lg-2 {{ $errors->has('description') ? 'has-errors'  : ''}}">Description </label>
                            <div class="col-lg-10">
                                {!! Form::textarea('description', $new->description, array('class'=>'form-control editor', 'placeholder'=>'Please insert the description','id'=>'editor')) !!}
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
                                    {!! Form::checkbox('is_active', 1, $new->is_active, array('class' => 'switch','data-on-text'=>'On','data-off'=>'Off', 'data-on-color'=>'success','data-off-color'=>'danger' )) !!}

                                </div>

                            </div>
                        </div>

                        <div class="clearfix"></div>
                        {!! csrf_field() !!}
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary btn-sm m-t-5">Submit</button>
                        </div>
                    </div>

                </form>
                </form>
            </div>
            <!-- /input group addons -->


            <!-- /touchspin layouts -->

        </div>


@stop
        @section('js_script')
            <script type="text/javascript">

                $(document).ready(function(){
                    onload = function() {
                        var value = $('#select').find('option:selected').val();
                        var url = '{{route('news.subcategories')}}';
                        select(value, url);
                    }
                    $("[name='is_active']").bootstrapSwitch();

                    $(".bod-picker").nepaliDatePicker({
                        dateFormat: "%D, %M %d, %y",
                        closeOnDateSelect: true
                    });

                    $("#clear-bth").on("click", function(event) {
                        event.preventDefault();
                        $(".bod-picker").val('');

                    });

                    $('#select').on('change', function() {
                        $('#select-sub-category').empty();
                        var value = $(this).val();
                        var url = '{{route('news.subcategories')}}';
                        select(value, url);
                    });
                    function select(value,url){

                        $.ajax({
                            type:'get',
                            url:url,
                            data:{category_id:value},
                            dataType:'json',
                            success:function(response){
                            if(response.success == true){
                                var value = response.subcategory;
                                var option = '';

                                $.each(value, function(key, value) {

                                    option  +='<option selected="selected" value="'+value.id+'">'+value.name+'</option:selectedoption>';
                                });

                                $('#select-sub-category').append(option).show();
                            }else{
                                $('#select-sub-category').empty();
                            }

                            }
                        });
                    }
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