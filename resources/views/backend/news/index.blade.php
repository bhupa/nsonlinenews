@extends('backend.app')
@section('title', 'View News')
@section('content')
    <div class="content">
        @if ($user->can('add-news'))
        <a class="btn btn-primary" href="{{ route('ne_ws.add') }}">{{ trans('labels.admin.news.add')}}</a>
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
                        <th scope="col">{{ trans('labels.admin.news.table.name')}}</th>
                        <th scope="col">{{ trans('labels.admin.news.table.category')}}</th>
                        <th scope="col">{{ trans('labels.admin.news.table.subcategory')}}</th>
                        <th scope="col">{{ trans('labels.admin.news.table.shortdescription')}}</th>
                        <th scope="col">{{ trans('labels.admin.news.table.publish')}}</th>

                        <th scope="col">{{ trans('labels.admin.news.table.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($news as $index=>$new)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{str_limit($new->title,'20','....') }}</td>
                        <td>{{$new->category->name }}</td>
                        <td>{{$new->subcategory['name'] }}</td>
                        <td>{!! str_limit($new->short_description,'20','...')  !!}</td>

                        <td>{{$new->publish_date }}</td>

                        <td>
                            @if($user->can('publish-news'))
                                @if($new->is_active == 1)
                                    <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $new->id !!}"  data-toggle="tooltip" title="{{ trans('labels.admin.news.change_status')}}"><i
                                                class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                @else
                                    <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $new->id !!}"  data-toggle="tooltip" title="{{ trans('labels.admin.news.change_status')}}"><i
                                                class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                @endif
                            @else
                                @if($new->is_active == 1)
                                    Published
                                @else
                                    Draft
                                @endif
                            @endif

                                @if ($user->can('edit-news'))
                                    <a href="{{ route('ne_ws.edit',$new->id) }}" title="{{ trans('labels.admin.news.edit')}}"
                                       data-toggle="tooltip" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                @endif
                                @if ($user->can('delete-news'))
                                    <a href="#" class="delete-content btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $new->id !!}"
                                       title="{{ trans('labels.admin.news.delete')}}" data-toggle="tooltip" ><i
                                                class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                @endif

                        </td>
                    </tr>
                    @endforeach


                    </tbody>

                </table>
                    {!! $news->render() !!}
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
                        url: '{{ route("ne_ws.delete") }}',
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
                    url: '{{ route("ne_ws.change-status") }}',
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
                            imageUrl: "{{asset('backend/thumbs-up.png')}}",
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