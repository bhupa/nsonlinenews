@extends('backend.app')
@section('title','Update Category')
@section('content')

    <div class="content">

        <!-- Input group addons -->

        <div class="card">

            <div class="card-header">
                <ol class="breadcrumb" style="margin-bottom: 5px;">
                    <li><a href="{{ route('admin.dashboard') }}">होमपेज</a></li>
                    @if($user->can('view-category'))
                        <li><a href="{{ route('category.index') }}">/{{ trans('labels.admin.category.table.name')}}</a></li>
                    @endif
                    <li class="active">/{{ trans('labels.admin.category.edit') }}</li>
                </ol>
            </div>

            <div class="card-body">


                <form action="{{ route('category.update',$category->id) }}" method="post" class="row" role="form"
                      enctype="multipart/form-data" >

                    <legend class="text-uppercase font-size-sm font-weight-bold">{{ trans('labels.admin.category.edit') }}</legend>
                    <div class="container">

                        <div class="form-group row  {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-form-label col-lg-3">{{ trans('labels.admin.category.table.name')}}</label>

                            <div class="col-lg-9">
                                <div class="input-group">

                                    <input type="text" name="name" value="{{$category->name}}" class="form-control" placeholder="Enter Name">

                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row  {{ $errors->has('display_in') ? ' has-error' : '' }}">
                            <label class="col-form-label col-lg-3">{{ trans('labels.admin.category.table.display_in')}}</label>
                            <div class="col-lg-9">
                                @php
                                    $menu = [];
                            foreach ($menus as $key){
                              $menu[$key->id] = $key->name;
                            }
                                @endphp

                                {!! Form::select('display_in[]',$menu, $category->menulocation, array('class' =>'selectpicker form-control','multiple' )) !!}
                                @if ($errors->has('display_in'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('display_in') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row  {{ $errors->has('orderlist') ? ' has-error' : '' }}">
                            <label class="col-form-label col-lg-3">{{ trans('labels.admin.category.table.orderlist')}}</label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    {!! Form::number('orderlist', $category->orderlist, array('class' =>'form-control' )) !!}


                                </div>
                                @if ($errors->has('orderlist'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('orderlist') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-lg-3">{{ trans('labels.admin.category.table.orderlist')}}?</label>
                            <div class="col-lg-9">
                                <div class="make-switch ">
                                    {!! Form::checkbox('is_active',null, $category->is_active, array('class' => 'switch','data-on-text'=>trans('labels.form.on'),'data-off-text'=>trans('labels.form.off'), 'data-on-color'=>'success','data-off-color'=>'danger' )) !!}

                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="clearfix"></div>
                    {!! csrf_field() !!}
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-sm m-t-5">{{ trans('labels.admin.category.edit') }}</button>
                    </div>
            </div>

            </form>

        </div>
        <!-- /input group addons -->


        <!-- /touchspin layouts -->

    </div>


@endsection
@section('js_script')


    <script type="text/javascript">
        $(document).ready(function() {
            $('select').selectpicker();
            $("[name='is_active']").bootstrapSwitch();
        });
    </script>
@endsection