<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rayeallistic | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ URL('plugins/datatables-responsive/css/responsive.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ URL('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ URL('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ URL('plugins/select2/css/select2.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ URL('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL('css/admin_css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ URL('css/admin_css/mine.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ URL('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ URL('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ URL('plugins/summernote/summernote-bs4.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('layouts.admin_layout.admin_header')
        @include('layouts.admin_layout.admin_sidebar')
        @yield('content')
        @include('layouts.admin_layout.admin_footer')
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ URL('plugins/jquery/jquery.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ URL('plugins/jquery-ui/jquery-ui.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL('plugins/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ URL('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2').select2()
    </script>
    <!-- DataTables -->
    <script src="{{ URL('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ URL('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function() {
            $("#sections").DataTable();
            $("#categories").DataTable();
            $("#products").DataTable();
            $("#shipping").DataTable();
            $("#orders").DataTable();
            $("#coupons").DataTable();
            $("#brands").DataTable();
            $("#review").DataTable();
        });
    </script>
    <!-- ChartJS -->
    <script src="{{ URL('plugins/chart.js/Chart.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ URL('plugins/sparklines/sparkline.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ URL('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ URL('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ URL('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ URL('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ URL('plugins/summernote/summernote-bs4.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ URL('plugins/overlayScrollbars/js/jquery.overlayScrollbars.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL('js/admin_js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ URL('js/admin_js/pages/dashboard.js') }}"></script>
    <!-- Custom Admin JS -->
    <script src="{{ URL('js/admin_js/admin_script.js') }}"></script>
    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>
