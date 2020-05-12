@extends('backend.app')
<style>
    /*.dropdown {*/
    /*position: absolute;*/
    /*top:50%;*/
    /*transform: translateY(-50%);*/
    /*}*/

    a {
        color: #fff;
    }

    .dropdown dd,
    .dropdown dt {
        margin: 0px;
        padding: 0px;
    }

    .dropdown ul {
        margin: -1px 0 0 0;
    }

    .dropdown dd {
        position: relative;
    }

    .dropdown a,
    .dropdown a:visited {
        color: #000000;
        text-decoration: none;
        outline: none;
        font-size: 12px;
    }

    .dropdown dt a {
        background-color: #ffffff;
        display: block;
        padding: 8px 20px 5px 10px;
        min-height: 25px;
        line-height: 24px;
        overflow: hidden;
        border: 1px solid #4c4c4c;
        width: 100%;
    }

    .dropdown dt a span,
    .multiSel span {
        cursor: pointer;
        display: inline-block;
        padding: 0 3px 2px 0;
    }

    .dropdown dd ul {
        background-color: #fff;
        border: 0;
        color: #000000;
        display: none;
        left: 0px;
        padding: 2px 15px 2px 5px;
        position: absolute;
        top: 2px;
        width: 100%;
        list-style: none;
        height: 100px;
        overflow: auto;
        z-index: 1;
        border: 1px solid #000000;
    }

    .dropdown span.value {
        display: none;
    }

    .dropdown dd ul li a {
        padding: 5px;
        display: block;
    }

    .dropdown dd ul li a:hover {
        background-color: #fff;
    }

    .mutliSelect Input[type=checkbox] {
        width:20px;
        height:20px;
        background: #ffffff;
        /*border-radius: 0px;*/
        border: 1px solid #4c4c4c;
        margin-right: 4px;
    }
    .mutliSelect ul li span  {
        position: absolute;
    }

    /*.mutliSelect Input[type=checkbox]:before {*/
    /*content: '';*/
    /*display: block;*/
    /*width: 20px;*/
    /*height: 20px;*/
    /*background: #ffffff;*/
    /*position: absolute;*/
    /*left: 5px;*/
    /*right:5px;*/
    /*border: 1px solid #4c4c4c;*/
    /*}*/


</style>
@section('title','Assign Role')
@section('css_scripts')
@endsection
@section('content')

    <div class="content">

        <!-- Input group addons -->
        <
        <div class="card">

            <div class="card-header">
                <ol class="breadcrumb" style="margin-bottom: 5px;">
                    <li><a href="{{ route('dashboard') }}">Home</a></li>
                    @if($user->can('view-user'))
                        <li><a href="{{ route('user.index') }}">/User</a></li>
                    @endif
                    <li class="active">/Assign Role</li>
                </ol>
            </div>

            <div class="card-body">

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ trans('labels.admin.role.table.name')}}</th>

                        <th scope="col">{{ trans('labels.admin.role.table.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach( $userroles as $index=>$usrs)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $usrs->role->name }}</td>
                            <td>

                                @if ($user->can('delete-role'))
                                    <a href="#"  id="{{ $usrs->role_id }}" data-type="{{$usrs->user_id }}" title="{{ trans('labels.admin.user.delete')}}"
                                       data-toggle="tooltip" class="btn btn-success delete-role btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i></a>
                                @endif

                            </td>
                        </tr>
                    @endforeach


                    </tbody>

                </table>
                <form action="{{ route('user.storerole',[$users->id]) }}" method="post" class="row" role="form"
                      enctype="multipart/form-data" >

                    <legend class="text-uppercase font-size-sm font-weight-bold">Assign Role</legend>
                    <div class="container">

                        <div class="form-group row  {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-form-label col-lg-3">Role</label>
                            <div class="col-lg-9">

                                    @php $role = [] @endphp
                                    @foreach($roles as $index)
                                        @php $role[$index->id] = $index->name @endphp
                                    @endforeach

                                    <dl class="dropdown">

                                        <dt>
                                            <a href="#">
                                                <span class="hida">Select</span>
                                                <input type="hidden" class="role" name="role_id" value="">
                                                <p class="multiSel"></p>
                                            </a>
                                        </dt>
                                        {{--<h1>{{ dd($user->roles->name) }}</h1>--}}

                                        <dd>

                                            <div class="mutliSelect">
                                                <ul>




                                                    @foreach($roles as $role)


                                                    <li>
                                                        {!! Form::checkbox('is_active',$role->name,0,array('class' => 'checkbox', 'id'=>$role->id,)) !!}
                                                        {{--<input type="checkbox" class="checkbox" id="{{$role->id}}" value="" />--}}
                                                        <span>{{$role->name}}</span>
                                                    </li>
                                                    @endforeach


                                                </ul>
                                            </div>
                                        </dd>

                                    </dl>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                    </div>
                    <div class="clearfix"></div>
                    {!! csrf_field() !!}
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-sm m-t-5">Submit</button>
                    </div>
            </div>

            </form>
        </div>
        <!-- /input group addons -->


        <!-- /touchspin layouts -->

    </div>


@stop
@section('js_script')
    <script type="text/javascript">

        $(document).ready(function () {
            $(".dropdown dt a").on('click', function() {
                $(".dropdown dd ul").slideToggle('fast');
            });

            $(".dropdown dd ul li a").on('click', function() {
                $(".dropdown dd ul").hide();
            });

            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }

            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
            });

            $('.mutliSelect .checkbox').each(function(index) {

                $(this).on('click', function () {
                    var role_id = [];
                    var id = $(this).closest('.mutliSelect').find('input[type="checkbox"]').attr('id');

                    var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val();


                    title = $(this).val() + ",";


                    $.each($(".mutliSelect .checkbox:checked"), function(){
                        role_id.push($(this).attr('id'));
                    });

                    if ($(this).is(':checked')) {
                        var html = '<span title="' + title + '">' + title + '</span>';
                        var role =
                        $('.checkbox').val()
                        $('.role').val(role_id)
                        $('.multiSel').append(html);
                        $(".hida").hide();
                    } else {
                        $('span[title="' + title + '"]').remove();
                        var ret = $(".hida");
                        $('.dropdown dt a').append(ret);

                    }
                });


            });
            $('.delete-role').click(function (event) {
                event.preventDefault();
                $object = this;
                var user_id = $(this).attr('data-type');
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
                        url: '{{ route("user.delete-role") }}',
                        data: {role_id: $object.id,user_id:user_id, _token: '{!! csrf_token() !!}'},
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

        });
    </script>
@endsection