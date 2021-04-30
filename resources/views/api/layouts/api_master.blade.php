<!DOCTYPE html>
<html lang="en">

<head>
    <title>Royal Restaurant</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{asset('admin/img/favicon.ico')}}" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap-responsive.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/colorpicker.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/datepicker.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/uniform.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/matrix-style.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/matrix-media.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap-wysihtml5.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/datepicker.css')}}" />
    <link href="{{asset('admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>

<body>

    <!--Header-part-->
    <div id="header">
        <h1><a href="{{route('index')}}"></a></h1>
    </div>
    <!--close-Header-part-->


    <!--top-Header-menu-->
    @include('admin.partials.admin_top_menu')
    <!--close-top-Header-menu-->
    <!--sidebar-menu-->
    @include('admin.partials.admin_sidebar')
    <!--sidebar-menu-->

    <!--main-container-part-->
    @yield('admin_main_content')

    <!--end-main-container-part-->

    <!--Footer-part-->

    <div class="row-fluid">
        <div id="footer" class="span12"> 2017 &copy; Royal Restaurant. Developed by <a href="http://makngbd.com" target="_blank">Arif Khan</a> </div>
    </div>

    <!--end-Footer-part-->
    <script src="{{asset('admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('admin/js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap-colorpicker.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('admin/js/masked.js')}}"></script>
    <script src="{{asset('admin/js/jquery.uniform.js')}}"></script>
    <script src="{{asset('admin/js/select2.min.js')}}"></script>
    <script src="{{asset('admin/js/matrix.js')}}"></script>
    <script src="{{asset('admin/js/matrix.form_common.js')}}"></script>
    <script src="{{asset('admin/js/wysihtml5-0.3.0.js')}}"></script>
    <script src="{{asset('admin/js/jquery.peity.min.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap-wysihtml5.js')}}"></script>
    <script src="{{asset('admin/js/jquery.flot.min.js')}}"></script>
    <script src="{{asset('admin/js/jquery.flot.pie.min.js')}}"></script>
    <script src="{{asset('admin/js/matrix.charts.js')}}"></script>
    <script src="{{asset('admin/js/jquery.flot.resize.min.js')}}"></script>
    <script src="{{asset('admin/js/matrix.dashboard.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap-datepicker.js')}}"></script>

    <script>
        $('.textarea_editor').wysihtml5();
    </script>
    <script type="text/javascript">
        // This function is called from the pop-up menus to transfer to
        // a different page. Ignore if the value returned is a null string:
        function goPage(newURL) {

            // if url is empty, skip the menu dividers and reset the menu selection to default
            if (newURL != "") {

                // if url is "-", it is this page -- reset the menu:
                if (newURL == "-") {
                    resetMenu();
                }
                // else, send page to designated URL            
                else {
                    document.location.href = newURL;
                }
            }
        }

        // resets the menu selection upon entry to this page:
        function resetMenu() {
            document.gomenu.selector.selectedIndex = 2;
        }

        $('.textarea_editor').wysihtml5();
    </script>
</body>

</html>