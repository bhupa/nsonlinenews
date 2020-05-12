@extends('backend.app')
@section('title', 'View Role')
@section('content')
    <div class="content">
        @if ($user->can('add-role'))
        <a class="btn btn-primary" href="{{ route('role.add') }}">{{ trans('labels.admin.role.add')}}</a>
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
                        <th scope="col">{{ trans('labels.admin.role.table.name')}}</th>
                        <th scope="col">{{ trans('labels.admin.role.table.created_at')}}</th>
                        <th scope="col">{{ trans('labels.admin.role.table.updated_at')}}</th>
                        <th scope="col">{{ trans('labels.admin.role.table.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $index=>$role)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->created_at }}</td>
                        <td>{{ $role->updated_at }}</td>
                        <td>

                                @if ($user->can('edit-role'))
                                    <a href="{{ route('role.edit',$role->id) }}" title="{{ trans('labels.admin.role.edit')}}"
                                       data-toggle="tooltip" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                @endif
                                @if ($user->can('delete-role'))
                                    <a href="#" class="delete-content btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $role->id !!}"
                                       title="{{ trans('labels.admin.role.delete')}}" data-toggle="tooltip" ><i
                                                class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                @endif
                        </td>
                    </tr>
                    @endforeach


                    </tbody>

                </table>
                {!! $roles->render() !!}
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
                        url: '{{ route("role.delete") }}',
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

            {{--$('.change-status').click(function (event) {--}}
                {{--event.preventDefault();--}}
                {{--$object = this;--}}
                {{--debugger;--}}
                {{--$.ajax({--}}
                    {{--type: 'POST',--}}
                    {{--url: '{{ route("admin.content.change_status") }}',--}}
                    {{--data: {id: $object.id, _token: '{!! csrf_token() !!}'},--}}
                    {{--success: function (response) {--}}
                        {{--if (response.is_active == 1) {--}}
                            {{--$($object).html('<i class="zmdi zmdi-check-circle zmdi-hc-fw"></i>');--}}
                        {{--} else {--}}
                            {{--$($object).html('<i class="zmdi zmdi-lock zmdi-hc-fw"></i>');--}}
                        {{--}--}}
                        {{--swal({--}}
                            {{--title: "Success!",--}}
                            {{--text: response.message,--}}
                            {{--imageUrl: AdminAssetPath + "img/thumbs-up.png",--}}
                            {{--timer: 2000,--}}
                            {{--showConfirmButton: false--}}
                        {{--});--}}
                    {{--},--}}
                    {{--error: function (e) {--}}
                        {{--debugger;--}}
                    {{--},--}}
                {{--});--}}
            {{--});--}}
        });

    </script>
@stop