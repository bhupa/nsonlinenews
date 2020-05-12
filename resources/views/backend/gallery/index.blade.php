@extends('backend.app')
@section('title', 'View Gallery')
@section('content')
    <div class="content">
        @if ($user->can('add-gallery'))
        <a class="btn btn-primary" href="{{ route('gallery.add') }}">{{ trans('labels.admin.gallery.add')}}</a>
        @endif
        <!-- Input group addons -->
        <div class="card">


            <div class="card-body">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ trans('labels.admin.gallery.table.name')}}</th>
                        <th scope="col">{{ trans('labels.admin.gallery.table.image')}}</th>
                        <th scope="col">{{ trans('labels.admin.gallery.table.description')}}</th>
                        <th scope="col">{{ trans('labels.admin.gallery.table.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($galleries as $index=>$gallerie)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{str_limit($gallerie->title,'20','....') }}</td>
                        <td>
                            @if(file_exists('storage/'.$gallerie->image) && $gallerie->image !== '')
                                <img src="{{asset('storage/'.$gallerie->image)}}" alt="" style="width:100px;height:100px;">
                            @endif

                        </td>
                        <td>{!! str_limit($gallerie->description,'20','...')  !!}</td>


                        <td>
                            @if($user->can('publish-gallery'))
                                @if($gallerie->is_active == 1)
                                    <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $gallerie->id !!}"  data-toggle="tooltip" title="{{ trans('labels.admin.gallery.change_status')}}"><i
                                                class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                @else
                                    <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $gallerie->id !!}"  data-toggle="tooltip" title="{{ trans('labels.admin.gallery.change_status')}}"><i
                                                class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                @endif
                            @else
                                @if($gallerie->is_active == 1)
                                    Published
                                @else
                                    Draft
                                @endif
                            @endif

                                    @if($user->can('add-media'))
                                    <a href="{{ route('media.add',$gallerie->id) }}" class="add-image btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $gallerie->id !!}"  data-toggle="tooltip" title="{{ trans('labels.admin.gallery.add_image')}}"><i
                                                class="zmdi zmdi-image-o zmdi-hc-fw"></i></a>
                                @endif


                                @if ($user->can('edit-gallery'))
                                    <a href="{{ route('gallery.edit',$gallerie->id) }}" title="{{ trans('labels.admin.gallery.edit')}}"
                                       data-toggle="tooltip" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                @endif
                                @if ($user->can('delete-gallery'))
                                    <a href="#" class="delete-content btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $gallerie->id !!}"
                                       title="{{ trans('labels.admin.gallery.delete')}}" data-toggle="tooltip" ><i
                                                class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                @endif

                        </td>
                    </tr>
                    @endforeach


                    </tbody>

                </table>
                {!! $galleries->render() !!}
            </div>
        </div>

    </div>
@stop
@section('js_script')
    <script type="text/javascript">

        $(document).ready(function () {
            $('.delete-content').click(function (event) {
                event.preventDefault();
                $object = this;
//
                swal({
                    title: "Are you sure?",
                    text: "You will do you want to delete this Content ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    debugger;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("gallery.delete") }}',
                        data: {id: $object.id, _token: '{!! csrf_token() !!}'},
                        success: function (response) {
                            if (response.status == true) {
                                $($object).parent('td').parent('tr').remove();
                                swal("Deleted!", response.message, "success");
                            }
                            else {
                                swal("Error !", response.message, "error");
                            }
                        },
                        error: function (e) {
                            swal("Error !", response.message, "error");
                        },
                    });
                });
            });

            $('.change-status').click(function (event) {
                event.preventDefault();
                $object = this;
                debugger;
                $.ajax({
                    type: 'POST',
                    url: '{{ route("gallery.change-status") }}',
                    data: {id: $object.id, _token: '{!! csrf_token() !!}'},
                    success: function (response) {
                        if (response.is_active == 1) {
                            $($object).html('<i class="zmdi zmdi-check-circle zmdi-hc-fw"></i>');
                        } else {
                            $($object).html('<i class="zmdi zmdi-lock zmdi-hc-fw"></i>');
                        }
                        debugger
                        swal({
                            title: "Success!",

                            text: response.message,
                            imageUrl: "{{asset('backend/img/thumbs-up.png')}}",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function (e) {
                        debugger;
                    },
                });
            });
        });

    </script>
@stop
