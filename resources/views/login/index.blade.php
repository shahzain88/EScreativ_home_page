@extends('login.master')
@section('title', 'Login')
@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ url('/') }}" class="h1"><b>ES</b> CREATIVE</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Login to start your session</p>



                <form id="loginForm" method="post">
                    @csrf


                    <div class="alert alert-danger alert-dismissible d-none">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-info"></i>Login Failed!</h5>
                        <small class="alert-message">Email or password does not match.</small>
                    </div>

                    <div class="alert alert-success alert-dismissible d-none">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i>Login Success!</h5>
                        <small class="alert-message"><i class="fa fa-spinner fa-spin"></i> Redirecting to authenticate page...</small>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="text" name="email" class="form-control" placeholder="Email or username">
                    </div>


                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>


                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Login <span
                                    class="esc-loading-button d-none"> <i class="fa fa-spinner fa-spin"></i></span></button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                {{-- <div class="social-auth-links text-center mt-2 mb-3">
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div> --}}
                <!-- /.social-auth-links -->

                {{-- <p class="mb-1">
          <a href="#">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="#" class="text-center">Register a new membership</a>
        </p> --}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection

@section('authScript')
    <script>
        $(document).ready(function() {
            $("#loginForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                let formData = thisForm.serialize();

                $.ajax({
                    type: "POST",
                    url: "{{route('loginCheck')}}",
                    data: formData,
                    beforeSend: function() {
                        thisForm.find(".esc-loading-button").removeClass('d-none');
                    },
                    success: function(response) {
                        thisForm.find(".esc-loading-button").addClass('d-none');
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: response.message
                        })

                        thisForm.find(".alert-danger").addClass('d-none');
                        thisForm.find(".alert-success").removeClass('d-none');

                        setTimeout(function() {
                            window.location.href = "{{ route('dashboard') }}";
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find(".esc-loading-button").addClass('d-none');
                        thisForm.find(".alert-danger").removeClass('d-none');
                        thisForm.find(".alert-success").addClass('d-none');

                        var responseText = jQuery.parseJSON(xhr.responseText);

                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: responseText.message
                        })
                    }

                })

            })





        })
    </script>
@endsection
