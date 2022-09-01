<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="apple-touch-icon" sizes="180x180"
            href="{{ asset('public/frontend') }}/assets/img/favicon/esfavicon.png">

        <title>ES Creative 工業株式会社 | Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('public/backend/plugins') }}/fontawesome-free/css/all.min.css">


        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet"
            href="{{ asset('public/backend/plugins') }}/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">


        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('public/backend/plugins') }}/icheck-bootstrap/icheck-bootstrap.min.css">


        <!-- JQVMap -->
        {{-- <link rel="stylesheet" href="{{ asset('public/backend/plugins') }}/jqvmap/jqvmap.min.css"> --}}


        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('public/backend/dist') }}/css/adminlte.min.css">


        <!-- overlayScrollbars -->
        <link rel="stylesheet"
            href="{{ asset('public/backend/plugins') }}/overlayScrollbars/css/OverlayScrollbars.min.css">


        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('public/backend/plugins') }}/daterangepicker/daterangepicker.css">


        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('public/backend/plugins') }}/summernote/summernote-bs4.css">

            <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('public/backend/plugins') }}/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="{{ asset('public/backend/plugins') }}/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="{{ asset('public/backend/plugins') }}/datatables-buttons/css/buttons.bootstrap4.min.css">


        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <!-- Toastr -->
        <link rel="stylesheet" href="{{ asset('public/backend/plugins') }}/toastr/toastr.min.css">
        <!-- SweetAlert2 -->
        <link rel="stylesheet"
            href="{{ asset('public/backend/plugins') }}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

        @yield('style')

    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <!-- Navbar -->
            @include('backend.layouts.topbar')
            <!-- /.navbar -->

            <!-- Main Sidebar Container Start-->

            @include('backend.layouts.sidebar')

            <!-- Main Sidebar Container End -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- /.content-wrapper -->

            @include('backend.layouts.footer')

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->




        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>





        <!-- jQuery -->
        <script src="{{ asset('public/backend/plugins') }}/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('public/backend/plugins') }}/jquery-ui/jquery-ui.min.js"></script>


        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>



        <!-- Bootstrap 4 -->
        <script src="{{ asset('public/backend/plugins') }}/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="{{ asset('public/backend/plugins') }}/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        {{-- <script src="{{ asset('public/backend/plugins') }}/sparklines/sparkline.js"></script> --}}

        <!-- jQuery Knob Chart -->
        <script src="{{ asset('public/backend/plugins') }}/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <script src="{{ asset('public/backend/plugins') }}/moment/moment.min.js"></script>
        <script src="{{ asset('public/backend/plugins') }}/daterangepicker/daterangepicker.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ asset('public/backend/plugins') }}/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
        </script>
        <!-- Summernote -->
        <script src="{{ asset('public/backend/plugins') }}/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('public/backend/plugins') }}/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('public/backend/dist') }}/js/adminlte.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('public/backend/dist') }}/js/pages/dashboard.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('public/backend/dist') }}/js/demo.js"></script>

        <!-- Toastr -->
        <script src="{{ asset('public/backend/plugins') }}/toastr/toastr.min.js"></script>
        <!-- SweetAlert2 -->
        <script src="{{ asset('public/backend/plugins') }}/sweetalert2/sweetalert2.min.js"></script>

         <!-- DataTables  & Plugins -->
        <script src="{{ asset('public/backend/plugins') }}/datatables/jquery.dataTables.min.js"></script>
        <script src="{{ asset('public/backend/plugins') }}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="{{ asset('public/backend/plugins') }}/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="{{ asset('public/backend/plugins') }}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

    <script>
        $(function () {
            // Summernote
            $('.summernote').summernote();

            // Datatable
            $('#esDatatable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

        })
    </script>

        @yield('script')



    </body>

</html>
