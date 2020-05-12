@extends('backend.app')
@section('title', 'View Advertising')
@section('content')
    <div class="content">
        @if ($user->can('add-advertising'))
            <a class="btn btn-primary" href="{{ route('advertise.add') }}">{{ trans('labels.admin.advertising.add') }}</a>
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
                            <th scope="col">{{ trans('labels.admin.advertising.table.name')}}</th>
                            <th scope="col">{{ trans('labels.admin.advertising.table.image')}}</th>
                            <th scope="col">{{ trans('labels.admin.advertising.table.action')}}</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach($advertisings as $index=>$advertising)
                            <tr data-index="{{$advertising->id}}" >
                                <td >{{ $index+$advertisings->firstItem() }}</td>
                                <td>{{ $advertising->title }}</td>

                                <td>
                                    @if(file_exists('storage/'.$advertising->image) && $advertising->image !== '')
                                        <img src="{{asset('storage/'.$advertising->image)}}" alt="" style="width:100px;height:100px;">
                                    @endif
                                </td>
                                <td>
                                    @if($user->can('publish-advertising'))
                                        @if($advertising->is_active == 1)
                                            <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $advertising->id !!}"  data-toggle="tooltip" title="{{ trans('labels.admin.advertising.change_status')}}"><i
                                                        class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                        @else
                                            <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $advertising->id !!}"  data-toggle="tooltip" title="{{ trans('labels.admin.advertising.change_status')}}"><i
                                                        class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                        @endif
                                    @else
                                        @if($advertising->is_active == 1)
                                            Published
                                        @else
                                            Draft
                                        @endif
                                    @endif
                                    @if ($user->can('edit-advertising'))
                                        <a href="{{ route('advertise.edit',$advertising->id) }}" title="{{ trans('labels.admin.advertising.edit')}}"
                                           data-toggle="tooltip" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    @endif
                                    @if ($user->can('delete-advertising'))
                                        <a href="#" class="delete-content btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $advertising->id !!}"
                                           title="{{ trans('labels.admin.advertising.delete')}}" data-toggle="tooltip" ><i
                                                    class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach


                        </tbody>

                    </table>
                    {!! $advertisings->render() !!}
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
                        url: '{{ route("advertise.delete") }}',
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
                    url: '{{ route("advertise.change-status") }}',
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


            $( "#sortable" ).sortable({
                axis: 'y',
                update: function(event, ui) {
                    $(this).children().each(function (index) {

                        if ($(this).attr("data-position") != (index + 1)) {
                            $(this).attr("data-position", (index + 1)).addClass('updated');
                        }
                    });
                    var url = "{{ route('category.sortable') }}";
                    sortableCategory();
                }


            });
            function sortableCategory(){
                var positions = [];
                $('.updated').each(function(){
                    positions.push([$(this).attr('data-index'),$(this).attr('data-position')]);
                    $(this).removeClass('updated');
                });

                $.ajax({
                    url:"{{ route('category.sortable') }}",
                    type:'post',
                    dataType:'html',
                    data:{update:1,positions:positions,_token: '{{csrf_token()}}'},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function($categorieslist){
                        // window.location.reload();
                        debugger
                        // $.each(categories, function (index, value) {
                        //     $('#sortable').append('<tr>' +
                        //         // '<td>'+value.name +'</td>' +
                        //         // '<td>'+$.each(value.display_in,function(index, value){
                        //         //     <span class='badge badge-primary'>'+ value+ '</span>
                        //         // }) +'</td>' +
                        //         // '<td>'+value.orderlist +'</td>' +
                        //         // '</tr>');
                        // });
                        console.log(data);
                        var obj = jQuery.parseJSON(data);
                        swal({
                            title: "Success!",
                            text: "Gallery has been sorted.",
                            imageUrl: "{{ asset('backend') }}/thumbs-up.png",
                            timer: 2000,
                            showConfirmButton: false
                        });
                        //  console.log(categories,menuItems);
                        // $('.sortablehtlm').html(categories,menuItems);
                    }
                })
            }

        });

    </script>
@stop