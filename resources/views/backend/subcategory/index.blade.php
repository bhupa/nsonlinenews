@extends('backend.app')
@section('title', 'View Sub Category')
@section('content')
    <div class="content">
        @if ($user->can('add-subcategory'))
        <a class="btn btn-primary" href="{{ route('sub_category.add') }}">{{ trans('labels.admin.subcategory.name')}}</a>
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
                        <th scope="col">{{ trans('labels.admin.subcategory.table.category')}}</th>
                        <th scope="col">{{ trans('labels.admin.subcategory.table.name')}}</th>
                        <th scope="col">{{ trans('labels.admin.subcategory.table.display_in')}}</th>

                        <th scope="col">{{ trans('labels.admin.subcategory.table.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subcategories as $index=>$subcategory)
                    <tr>
                        <td>{{ $index+$subcategories->firstItem() }}</td>
                        <td>{{ $subcategory->getSubCategoryName() }}</td>
                        <td>{{ $subcategory->name }}</td>
                        <td>{{ $subcategory->display_in }}</td>

                        <td>

                                @if ($user->can('edit-subcategory'))
                                    <a href="{{ route('sub_category.edit',$subcategory->id) }}" title="{{ trans('labels.admin.subcategory.edit')}}"
                                       data-toggle="tooltip" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                @endif
                                @if ($user->can('delete-subcategory'))
                                    <a href="#" class="delete-content btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $subcategory->id !!}"
                                       title="{{ trans('labels.admin.subcategory.delete')}}" data-toggle="tooltip" ><i
                                                class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                @endif
                        </td>
                    </tr>
                    @endforeach


                    </tbody>

                </table>
                {!! $subcategories->render() !!}
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
                        url: '{{ route("sub_category.delete") }}',
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