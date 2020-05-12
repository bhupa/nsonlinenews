@extends('backend.app')
@section('title', 'View Video')
@section('content')
    <div class="content">
        @if ($user->can('add-video'))
            <a class="btn btn-primary" href="{{ route('videos.add') }}">{{ trans('labels.admin.video.add')}}</a>
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
                        <th scope="col">{{ trans('labels.admin.video.table.title')}}</th>
                        <th scope="col">{{ trans('labels.admin.video.table.url')}}</th>
                        <th scope="col">{{ trans('labels.admin.video.table.image')}}</th>
                        <th scope="col">{{ trans('labels.admin.video.table.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($videos as $index=>$video)
                        <tr>
                            <td>{{ $index +$videos->firstItem() }}</td>
                            <td>{{str_limit($video->title,'20','....') }}</td>
                            <td>
                                <img src="{{$video->image}}" alt="{{$video->title}}" style="width:100px; height:100px;">

                            </td>



                            <td>
                                @if($user->can('publish-video'))
                                    @if($video->is_active == 1)
                                        <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $video->id !!}"  data-toggle="tooltip" title="{{ trans('labels.admin.gallery.change_status')}}"><i
                                                    class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                    @else
                                        <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $video->id !!}"  data-toggle="tooltip" title="{{ trans('labels.admin.gallery.change_status')}}"><i
                                                    class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                    @endif
                                @else
                                    @if($video->is_active == 1)
                                        Published
                                    @else
                                        Draft
                                    @endif
                                @endif
                                @if ($user->can('edit-video'))
                                    <a href="{{ route('videos.edit',$video->id) }}" title="{{ trans('labels.admin.video.edit')}}"
                                       data-toggle="tooltip" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                @endif
                                @if ($user->can('delete-video'))
                                    <a href="#" class="delete-content btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $video->id !!}"
                                       title="{{ trans('labels.admin.video.delete')}}" data-toggle="tooltip" ><i
                                                class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                @endif

                            </td>
                        </tr>
                    @endforeach


                    </tbody>

                </table>
                {!! $videos->render() !!}
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
                        url: '{{ route("videos.delete") }}',
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
                    url: '{{ route("videos.change-status") }}',
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
@endsection
