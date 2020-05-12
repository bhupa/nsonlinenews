<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('title')</title>



    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('global_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/selectize.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/4.0.0-alpha.1/css/bootstrap-switch.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/4.0.0-alpha.1/css/bootstrap-switch.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.3/croppie.css" />
{{--<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/css/bootstrap4-toggle.min.css" rel="stylesheet">--}}
{{--<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>--}}
<!-- /global stylesheets -->
    <link href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/plugins/animate.css/animate.min.css')}}"  rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/plugins/bootstrap-sweetalert/lib/sweet-alert.css') }}"  rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/plugins/bootstrap-sweetalert/lib/sweetalert2.css')}}"  rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/plugins/material-design-iconic-font/css/material-design-iconic-font.min.css')}}"  rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/nepaliDatePicker.css')}}"  rel="stylesheet" type="text/css">
    {{--<!-- CSS -->--}}
    {{--<link href="{{ asset('backend/css/app.min.1.css')}}"  rel="stylesheet" type="text/css">--}}
    <link href="{{ asset('backend/css/app.min.2.css')}}"  rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/style.css')}}"  rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.8/css/bootstrap-select.css" />

    <style>
        #my-image, .use, .cancle-btn {
            display: none;
        }
        img {
            max-width: 100%; /* This rule is very important, please do not ignore this! */
        }

    </style>
    <script src=" {{asset('backend/js/jquery.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.3/croppie.js"></script>
@yield('css_scripts')
<!-- Core JS files -->
    <script src="{{ asset('global_assets/js/main/jquery.min.js')}}"></script>
    <script src="{{ asset('global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('global_assets/js/plugins/loaders/blockui.min.js')}}"></script>



</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark">
 @include("include.header")
</div>
<!-- /main navbar -->


<!-- Page content -->
<div class="page-content">

    <!-- Main sidebar -->
    @include("include.sidebar")
    <!-- /main sidebar -->


    <!-- Main content -->
    <div class="content-wrapper">


        <!-- /page header -->


        <!-- Content area -->
  @yield('content')
        <!-- /content area -->


        <!-- Footer -->
        @include("include.footer");
        <!-- /footer -->
    </div>
    </div>
    <!-- /main content -->

</div>
<!-- /page content -->
<!-- /page content -->
>

<script src="{{ asset('assets/js/app.js')}}"></script>
<script src="{{ asset('assets/js/nepalidatetimepicker.js')}}"></script>

<script src="{{ asset('backend/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('backend/plugins/fullcalendar/dist/fullcalendar.min.js') }}" ></script>
{{--{!! Html::script('backend/plugins/bootstrap-sweetalert/lib/sweet-alert.min.js') !!}--}}
<script src="{{ asset('backend/plugins/bootstrap-sweetalert/lib/sweetalert2.min.js') }}" ></script>
{{--{!! Html::script('backend/sweetAlert/sweetalert.min.js') !!}--}}
<script src="{{ asset('backend/plugins/bootstrap-growl/bootstrap-growl.min.js') }}" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/4.0.0-alpha.1/js/bootstrap-switch.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>





<script>
    // "http://localhost:8000/"
    var editor_config = {
        path_absolute : "https://nsonlinekhabar.com/public/",
        images_upload_credentials: true,
        selector: ".editor[name=description] ,.mini-editor[name=short_description]",

        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no",

            });
        } ,

        //  Add Bootstrap Image Responsive class for inserted images
        image_class_list: [
            {title: 'None', value: ''},
            {title: 'Bootstrap responsive image', value: 'img-responsive'},
        ]

    };

    tinymce.init(editor_config);
</script>


@yield('js_script');
</body>
</html>
