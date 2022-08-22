<!DOCTYPE html>
<html lang="en">
<head>
    @section('header')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href='{{asset("plugins/fontawesome-free/css/all.min.css")}}'>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="shortcut icon" sizes="114x114" href="{{ asset('dist/img/ficon.png') }}">
        <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href='{{asset("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}'>
        <!-- Select2 -->
        <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
        <!-- Bootstrap4 Duallistbox -->
        <link rel="stylesheet" href='{{asset("plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css")}}'>
        <!-- BS Stepper -->
        <link rel="stylesheet" href='{{asset("plugins/bs-stepper/css/bs-stepper.min.css")}}'>
        <!-- iCheck -->
    <link rel="stylesheet" href='{{asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}'>
    <!-- JQVMap -->
    <link rel="stylesheet" href='{{asset("plugins/jqvmap/jqvmap.min.css")}}'>
    <!-- Theme style -->
    <link rel="stylesheet" href='{{asset("dist/css/adminlte.min.css")}}'>
        <!-- DataTables -->
        <link rel="stylesheet" href={{asset("plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}>
        <link rel="stylesheet" href={{asset("plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}} >
        <link rel="stylesheet" href={{asset("plugins/datatables-buttons/css/buttons.bootstrap4.min.css")}}>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href='{{asset("plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}'>
    <!-- Daterange picker -->
    <link rel="stylesheet" href='{{asset("plugins/daterangepicker/daterangepicker.css")}}'>
    <link rel="stylesheet" href='{{asset("plugins/bootstrap-daterangepicker/daterangepicker-bs3.css")}}'>
    <link rel="stylesheet" href='{{asset("plugins/bootstrap-datepicker/css/datepicker.css")}}'>
    <!-- summernote -->
    <link rel="stylesheet" href='{{asset("plugins/summernote/summernote-bs4.min.css")}}'>
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href={{asset("plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css")}}>
        <!-- Toastr -->
        <link rel="stylesheet" href={{asset("plugins/toastr/toastr.min.css")}}>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>
{{--For sidebar--}}
{{--<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">--}}
<body class="hold-transition layout-top-nav">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake brand-image img-circle elevation-4" src="{{asset("dist/img/IRLogo.png")}}"
             alt="Islamic-Relief-Logo" height="95" width="95">
    </div>

    <!-- Navbar -->
    @include('customlayouts.topbar')

    <div class="row">
        <div class="col-md-12">
            @include('flash::message')

        </div>
    </div>

    {{--<script>
        @if(Session::has('flash::message'))

        $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Toast Title',
            subtitle: 'Subtitle',
            body: "You are not authorized to perform this action"
        });
        @endif
    </script>--}}



<!-- /.navbar -->

    <!-- Main Sidebar Container -->
    {{--@include ('customlayouts.sidebar')--}}

            <!-- /.Main Sidebar Container -->
    @show

    <!-- ####################### Content Section ######################## -->
    <!-- ***** Content ***** -->
    @section ('content')
    @show



    @section('footer')
    <!-- ####################### Footer Section ######################## -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2021-{{date('Y')}} <a href="https://www.islamic-relief.org/" target="_blank">Islamic-Relief Worldwide</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.2.3
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src='{{asset("plugins/jquery/jquery.min.js")}}'></script>
<!-- jQuery UI 1.11.4 -->
<script src='{{asset("plugins/jquery-ui/jquery-ui.min.js")}}'></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src='{{asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}}'></script>

<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<!-- ChartJS -->
<script src={{asset("plugins/chart.js/Chart.min.js")}}></script>
<!-- Bootstrap Switch -->
<script src='{{asset("plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}'></script>
<!-- BS-Stepper -->
<script src='{{asset("plugins/bs-stepper/js/bs-stepper.min.js")}}'></script>
<!-- InputMask -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<!-- Sparkline -->
<script src='{{asset("plugins/sparklines/sparkline.js")}}'></script>
<!-- JQVMap -->
<script src='{{asset("plugins/jqvmap/jquery.vmap.min.js")}}'></script>
<script src='{{asset("plugins/jqvmap/maps/jquery.vmap.usa.js")}}'></script>
<!-- jQuery Knob Chart -->
<script src='{{asset("plugins/jquery-knob/jquery.knob.min.js")}}'></script>
<!-- daterangepicker -->
<script src='{{asset("plugins/moment/moment.min.js")}}'></script>
<script src='{{asset("plugins/daterangepicker/daterangepicker.js")}}'></script>

<script src='{{asset("plugins/bootstrap-daterangepicker/moment.min.js")}}'></script>
<script src='{{asset("plugins/bootstrap-datepicker/js/bootstrap-datepicker.js")}}'></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src='{{asset("plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}}'></script>
<!-- DataTables  & Plugins -->
<script src={{asset("plugins/datatables/jquery.dataTables.min.js")}}></script>
<script src={{asset("plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}></script>
<script src={{asset("plugins/datatables-responsive/js/dataTables.responsive.min.js")}}></script>
<script src={{asset("plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}></script>
<script src={{asset("plugins/datatables-buttons/js/dataTables.buttons.min.js")}}></script>
<script src={{asset("plugins/datatables-buttons/js/buttons.bootstrap4.min.js")}}></script>
<script src={{asset("plugins/jszip/jszip.min.js")}}></script>
<script src={{asset("plugins/pdfmake/pdfmake.min.js")}}></script>
<script src={{asset("plugins/pdfmake/vfs_fonts.js")}}></script>
<script src={{asset("plugins/datatables-buttons/js/buttons.html5.min.js")}}></script>
<script src={{asset("plugins/datatables-buttons/js/buttons.print.min.js")}}></script>
<script src={{asset("plugins/datatables-buttons/js/buttons.colVis.min.js")}}></script>
<!-- Summernote -->
<script src='{{asset("plugins/summernote/summernote-bs4.min.js")}}'></script>
<!-- overlayScrollbars -->
<script src='{{asset("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}'></script>
<!-- SweetAlert2 -->
<script src={{asset("plugins/sweetalert2/sweetalert2.min.js")}}></script>
<!-- Toastr -->
<script src={{asset("plugins/toastr/toastr.min.js")}}></script>
<!-- AdminLTE App -->
<script src='{{asset("dist/js/adminlte.js")}}'></script>
<!-- AdminLTE for demo purposes -->
<script src='{{asset("dist/js/demo.js")}}'></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src='{{asset("dist/js/pages/dashboard.js")}}'></script>



<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })


</script>


@show
</body>
</html>