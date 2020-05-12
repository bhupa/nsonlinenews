@extends('backend.app')
@section('title','View Album')
@section('content')

    <div class="content">

        <!-- Input group addons -->

        <div class="card">

            <div class="card-header">
                <ol class="breadcrumb" style="margin-bottom: 5px;">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    @if($user->can('view-news'))
                        <li><a href="{{ route('gallery.index') }}">/Album</a></li>
                    @endif
                    <li class="active">/Add Gallery Album</li>
                </ol>
            </div>
            <div class="heading-elements">
                <a href="{{ route('gallery.index') }}" class="btn btn-default legitRipple pull-right">
                    <i class="icon-undo2 position-left"></i>
                    Back
                    <span class="legitRipple-ripple"></span>
                </a>
            </div>
            <div class="card-body">

                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title"><i class="icon-grid3 position-left"></i>Gallery Images</h5>
                        <div class="heading-elements">
                            <a href="{{ route('media.add', [$gallery->id]) }}"
                               class="btn btn-default legitRipple pull-right">
                                <i class="icon-file-plus position-left"></i>
                                Upload Images
                                <span class="legitRipple-ripple"></span>
                            </a>
                        </div>
                    </div>

                    <div class="panel-body gallery">

                        <div class="row">
                            @forelse($gallery->images as $item)
                                <div class="col-sm-6 col-lg-3" id="imageItem-{{ $item->id }}">
                                    <div class="card">
                                        <div class="card-img-actions m-1">
                                            <img class="card-img img-fluid" src="{{ $item->image }}" alt=""
                                                 style="width: 221px; height:165px;">
                                            <div class="card-img-actions-overlay card-img">
                                                <a href="{{ $item->image }}"
                                                   class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round"
                                                   data-popup="lightbox" rel="group">
                                                    <i class="icon-plus3"></i>
                                                </a>

                                                <a href="javascript:void(0)" id="{{ $item->id  }}" data-gallery = "{{ $gallery->id }}"
                                                   class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2 delete">
                                                    <i class="icon-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-sm-6 col-lg-3">
                                    <div class="card">
                                        Sorry, no image has been uploaded yet.
                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>

                </div>

            </div>
            <!-- /input group addons -->


            <!-- /touchspin layouts -->

        </div>


        @stop
        @section('js_script')
            <script src="{{ asset('backend/js/main/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('backend/js/loaders/blockui.min.js') }}"></script>
            <script src="{{ asset('backend/js/fancybox.min.js') }}"></script>
            <script src="{{ asset('backend/js/gallery.js') }}"></script>
            <script type="text/javascript">


                    $(document).ready(function () {
                        $('.delete').click(function (event) {
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
                                    url: '{{ route("media.delete") }}',
                                    data: {id: $object.id, _token: '{!! csrf_token() !!}'},
                                    success: function (response) {
                                        if (response.status == true) {
                                            debugger
                                            $("#imageItem-"+response.id).empty();
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
@stop
