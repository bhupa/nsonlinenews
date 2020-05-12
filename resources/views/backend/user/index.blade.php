@extends('backend.app')
@section('title', 'View Category')
@section('content')
    <div class="content">
        @if ($user->can('add-permission'))
            <a class="btn btn-primary" href="{{ route('category.add') }}">{{ trans('labels.admin.category.add') }}</a>
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
                        <th scope="col">{{ trans('labels.admin.user.table.name')}}</th>
                        <th scope="col">{{ trans('labels.admin.user.table.role')}}</th>
                        <th scope="col">{{ trans('labels.admin.user.table.email')}}</th>
                        <th scope="col">{{ trans('labels.admin.user.table.phone')}}</th>

                        <th scope="col">{{ trans('labels.admin.category.table.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $index=>$user)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="badge badge-primary">{{$role->name}}</span></br>
                                @endforeach
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->contact }}</td>
                       

                            <td>
                                @if($user->can('approve-user'))
                                    @if($user->is_active == '1')
                                        <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $user->id !!}"  data-toggle="tooltip" title="{{ trans('labels.admin.category.change_status')}}"><i
                                                    class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                    @else
                                        <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $user->id !!}"  data-toggle="tooltip" title="{{ trans('labels.admin.category.change_status')}}"><i
                                                    class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                    @endif

                                @endif
                                    @if ($user->can('assign-role'))
                                        <a href="{{ route('user.assignrole',$user->id) }}" title="{{ trans('labels.admin.user.assign-role')}}"
                                           data-toggle="tooltip" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i></a>
                                    @endif
                                    @if ($user->can('assign-category'))
                                        <a href="{{ route('user.assign.category',$user->id) }}" title="{{ trans('labels.admin.user.assign-category')}}"
                                           data-toggle="tooltip" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-assignment-account zmdi-hc-fw"></i></a>
                                    @endif

                                @if ($user->can('delete-user'))
                                    <a href="#" class="delete-content btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $user->id !!}"
                                       title="{{ trans('labels.admin.user.delete')}}" data-toggle="tooltip" ><i
                                                class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach


                    </tbody>

                </table>
                {!! $users->render() !!}

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
                        url: '{{ route("user.delete") }}',
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
            url: '{{ route("user.change-status") }}',
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
            imageUrl:"{{asset('backend/img/thumbs-up.png')}}",
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