@extends('backend.app')
@section('title', 'View Popup')
@section('content')
    <div class="content">
        @if ($user->can('add-popup'))
            <a class="btn btn-primary" href="{{ route('popup.add') }}">{{ trans('labels.admin.popup.add') }}</a>
    @endif
    <!-- Input group addons -->
        <div class="card">


            <div class="card-body">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="sortablehtlm">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ trans('labels.admin.popup.table.name')}}</th>
                            <th scope="col">{{ trans('labels.admin.popup.table.image')}}</th>
                            <th scope="col">{{ trans('labels.admin.popup.table.action')}}</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach($popups as $index=>$popup)
                            <tr data-index="{{$popup->id}}" >
                                <td >{{ $index+$popups->firstItem() }}</td>
                                <td>{{ $popup->title }}</td>

                                <td>
                                    @if(file_exists('storage/'.$popup->image) && $popup->image !== '')
                                        <img src="{{asset('storage/'.$popup->image)}}" alt="" style="width:100px;height:100px;">
                                    @endif
                                </td>
                                <td>
                                    @if($user->can('publish-popup'))
                                        @if($popup->is_active == 1)
                                            <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $popup->id !!}"  data-toggle="tooltip" title="{{ trans('labels.admin.popup.change_status')}}"><i
                                                        class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                        @else
                                            <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $popup->id !!}"  data-toggle="tooltip" title="{{ trans('labels.admin.popup.change_status')}}"><i
                                                        class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                        @endif
                                    @else
                                        @if($popup->is_active == 1)
                                            Published
                                        @else
                                            Draft
                                        @endif
                                    @endif
                                    @if ($user->can('edit-popup'))
                                        <a href="{{ route('popup.edit',$popup->id) }}" title="{{ trans('labels.admin.popup.edit')}}"
                                           data-toggle="tooltip" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    @endif
                                    @if ($user->can('delete-popup'))
                                        <a href="#" class="delete-content btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $popup->id !!}"
                                           title="{{ trans('labels.admin.popup.delete')}}" data-toggle="tooltip" ><i
                                                    class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach


                        </tbody>

                    </table>
                    {!! $popups->render() !!}
                </div>
            </div>
        </div>

    </div>
@endsection
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
                        url: '{{ route("popup.delete") }}',
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
                    url: '{{ route("popup.change-status") }}',
                    data: {id: $object.id, _token: '{!! csrf_token() !!}'},
                    success: function (response) {
                        if (response.is_active == 1) {
                            $($object).html('<i class="zmdi zmdi-check-circle zmdi-hc-fw"></i>');
                        } else {
                            $($object).html('<i class="zmdi zmdi-lock zmdi-hc-fw"></i>');
                        }
                        swal({
                            title: "Success!",
                            text: response.message,
                            imageUrl:"{{asset('backend//thumbs-up.png')}}",
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