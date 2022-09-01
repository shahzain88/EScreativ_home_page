<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ES CREATIVE | @yield('title') </title>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/backend/plugins')}}/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('public/backend/plugins')}}/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('public/backend/plugins')}}/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('public/backend/plugins')}}/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/backend/dist')}}/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
    @auth
        <script type="text/javascript">location.href = "{{route('home')}}"</script>
    @endauth

<!-- /.login-box -->

@yield('content')
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('public/backend/plugins')}}/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/backend/plugins')}}/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="{{asset('public/backend/plugins')}}/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="{{asset('public/backend/plugins')}}/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/backend/dist')}}/js/adminlte.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
</script>
@yield('authScript')

</body>
</html>
