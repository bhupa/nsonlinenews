@extends('backend.app')
@section('title','Add User')
@section('content')

    <div class="content">

        <!-- Input group addons -->
        <
        <div class="card">

            <div class="card-header">
                <ol class="breadcrumb" style="margin-bottom: 5px;">
                    <li><a href="{{ route('dashboard') }}">Home</a></li>
                    @if($user->can('view-category'))
                        <li><a href="{{ route('category.index') }}">/Category</a></li>
                    @endif
                    <li class="active">/Add new Category</li>
                </ol>
            </div>

            <div class="card-body">


                <form action="{{ route('category.store') }}" method="post" class="row" role="form"
                      enctype="multipart/form-data" >

                    <legend class="text-uppercase font-size-sm font-weight-bold">Add category</legend>
                    <div class="container">

                        <div class="form-group row  {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-form-label col-lg-3">Name</label>
                            <div class="col-lg-9">
                                <div class="input-group">

                                    <input type="text" name="name" class="form-control" placeholder="Enter Name">

                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('is_active') ? 'has-error' :'' }}">
                            <label class="col-form-label col-lg-3">Publish</label>
                            <div class="col-sm-9">
                                <div class="form-group fg-line"
                                    <label class="radio radio-inline m-r-20">
                                        <input type="radio" name="is_active" value="1" checked="checked">
                                        <i class="input-helper"></i>
                                        Yes
                                    </label>
                                    <label class="radio radio-inline m-r-20">
                                        <input type="radio" name="is_active" value="0">
                                        <i class="input-helper"></i>
                                        No
                                    </label>
                                    @if ($errors->has('slug'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('is_active') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="clearfix"></div>
                        {!! csrf_field() !!}
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary btn-sm m-t-5">Add Permission</button>
                        </div>
                    </div>

                </form>
            </div>
            <!-- /input group addons -->


            <!-- /touchspin layouts -->

        </div>


@stop