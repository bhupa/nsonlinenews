@extends('backend.app')
@section('title','Edit Subcategory')
@section('content')

    <div class="content">

        <!-- Input group addons -->
        <div class="card">
            <div class="card-header">
                <ol class="breadcrumb" style="margin-bottom: 5px;">
                    <li><a href="{{ route('dashboard') }}">होमपेज</a></li>
                    @if($user->can('view-subcategory'))
                        <li><a href="{{ route('sub_category.index') }}">/{{ trans('labels.admin.subcategory.name')}}</a></li>
                    @endif
                    <li class="active">/{{ trans('labels.admin.subcategory.edit')}}</li>
                </ol>
            </div>

            <div class="card-body">

                <form action="{{ route('sub_category.update', $subcategory->id) }}" method="post" class="row" role="form"
                      enctype="multipart/form-data" >

                    <legend class="text-uppercase font-size-sm font-weight-bold">{{ trans('labels.admin.subcategory.edit')}}/legend>
                    <div class="container">
                        <div class="form-group row  {{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label class="col-form-label col-lg-3">{{ trans('labels.admin.category.name')}}</label>
                            <div class="col-lg-9">
                                <div class="input-group">




                                    <select name="category_id" class="form-control">
                                        <option value="0">Please Select The Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{($category->id == $subcategory->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row  {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-form-label col-lg-3">{{ trans('labels.admin.subcategory.name')}}</label>
                            <div class="col-lg-9">
                                <div class="input-group">

                                    <input type="text" name="name" class="form-control" value="{{ $subcategory->name }}"   placeholder="Enter Name">

                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row  {{ $errors->has('display_in') ? ' has-error' : '' }}">
                            <label class="col-form-label col-lg-3">{{ trans('labels.admin.subcategory.table.display_in')}}</label>
                            <div class="col-lg-9">
                                <div class="input-group">

                                    <input type="text" name="display_in" value="{{ $subcategory->display_in }}" class="form-control" placeholder="Enter Display Number">

                                </div>
                                @if ($errors->has('display_in'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('display_in') }}</strong>
                                    </span>
                                @endif
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