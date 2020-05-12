@extends('backend.app')
@section('title','Edit Permission')
@section('content')

    <div class="content">

        <!-- Input group addons -->
        <div class="card">


            <div class="card-body">

                <form action="{{ route('permission.update',$permission->id) }}" method="post" class="row" role="form"
                      enctype="multipart/form-data" >

                    <legend class="text-uppercase font-size-sm font-weight-bold">Edit Permission</legend>
                    <div class="container">

                        <div class="form-group row  {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-form-label col-lg-3">Name</label>
                            <div class="col-lg-9">
                                <div class="input-group">

                                    <input type="text" name="name" class="form-control" value="{{$permission->name}}" placeholder="Enter Name">

                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('slug') ? 'has-error' :'' }}">
                            <label class="col-form-label col-lg-3">Slug</label>
                            <div class="col-lg-9">
                                <div class="input-group">

                                    <input type="text" name="slug" class="form-control" value="{{$permission->slug}}" placeholder="Enter Slug">

                                </div>
                                @if ($errors->has('slug'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        {!! csrf_field() !!}
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary btn-sm m-t-5">Update Permission</button>
                        </div>
                    </div>

                </form>
                </form>
            </div>
            <!-- /input group addons -->


            <!-- /touchspin layouts -->

        </div>


@stop