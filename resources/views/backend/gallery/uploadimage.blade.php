@extends('backend.app')
@section('title','Add Album')
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
                <a href="{{ route('media.index',[$gallery->id]) }}" class="btn btn-default legitRipple pull-right">
                    <i class="icon-undo2 position-left"></i>
                    Back
                    <span class="legitRipple-ripple"></span>
                </a>
            </div>
            <div class="card-body">


                <form action="{{ route('media.store',$gallery->id) }}" class="dropzone" id="dropzone_accepted_files">
                    {{ csrf_field() }}
                </form>
            </div>
            <!-- /input group addons -->


            <!-- /touchspin layouts -->

        </div>


        @stop
        @section('js_script')
            <script src="{{ asset('backend/js/uploaders/dropzone.min.js') }}"></script>
            <script src="{{ asset('backend/js/uploaders/dropzoneDemo.js') }}"></script>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("[name='is_active']").bootstrapSwitch();

                    $(".bod-picker").nepaliDatePicker({
                        dateFormat: "%D, %M %d, %y",
                        closeOnDateSelect: true
                    });

                    $("#clear-bth").on("click", function(event) {
                        event.preventDefault();
                        $(".bod-picker").val('');

                    });
                    onload = function() {
                        var  value = $(this).find('option:selected').text();
                        change(value);
                    }
                    $('#type').on('change', function() {

                        var  value = $(this).find('option:selected').text();
                        change(value);
                    });
                    function change(value){
                        debugger
                        if(value == "Image"){
                            $('#Video').css('display','none');
                            $('#Image').css('display','flex');
                        }else{
                            $('#Video').css('display','flex');
                            $('#Image').css('display','none');
                        }

                    }
                    $('#add-gallery').on('submit', function(){
                        var  value = $(this).find('option:selected').text();
                        debugger
                        if(value == "Image"){
                            $('#Video').remove();

                        }else{
                            $('#Image').remove();
                        }
                    });


                });
            </script>
@stop
