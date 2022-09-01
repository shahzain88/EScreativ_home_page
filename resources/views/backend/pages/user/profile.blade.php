@extends('backend.master')
@section('style')
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Update Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" id="userUpdateForm" method="POST" >
                @csrf

                <div class="alert alert-danger alert-dismissible d-none">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-info"></i> Error!</h5>
                    <small class="alert-message">Something went wrong. Please try again...</small>
                </div>

                <div class="alert alert-success alert-dismissible d-none">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                    <small class="alert-message"><i class="fa fa-spinner fa-spin"></i> Redirecting to listing page...</small>
                </div>
                {{-- @method('PUT') --}}
                <input type="hidden" id="userID" name="id" value="{{$user->id}}">
                <div class="card-body">
                  <div class="form-group">
                    <label>User name</label>
                    <input type="text" required name="name" class="form-control"  value={{$user->name}}>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <div class="mb-3">
                        <input class="form-control" value={{$user->email}} type="email" required name ="email" placeholder="Enter Email">
                      </div>

                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <div class="mb-3">
                        <input class="form-control" id="pass" type="password" minlength="8"  name ="password" placeholder="*********">
                    </div>

                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <div class="mb-3">
                        <input class="form-control" id="cpass" type="password"  minlength="8"  name ="cpassword" placeholder="*********">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputImg">Image input <small class="image-error text-danger error"></small></label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" id="inputImg" accept=".jpg, .jpeg, .png" name="image">
                        </div>
                    </div>

                    @if ($user->image)
                    <img style="height: 100px; width:100px" src="{{ asset('/') . $user->image }}"
                    id="previewImg" alt="Preview">
                    @else
                    <img style="height: 100px; width:100px" src="{{ asset('public/no_image_found.jpg') }}"
                    id="previewImg" alt="Preview">

                    @endif


                </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <span class="esc-loading-button d-none">
                            <i class="fa fa-spinner fa-spin"></i>
                        </span>
                        <span class="submit-btn">
                            Update
                        </span>
                    </button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    {{-- Form section --}}


@endsection


@section('script')
    <script>
        $(document).ready(function(){
            console.log("Jquery Getting");

            $("#userUpdateForm").on('submit', function(e){
                e.preventDefault();
                var userID = $("#userID").val();
                var pass = $("#pass").val();
                var cpass = $("#cpass").val();
                let thisForm = $(this);

                if(pass != cpass){
                    alert("password does not match");
                }else{
                        $.ajax({
                            type: "POST",
                            url: "{{route('user.updateProfile')}}",
                            data:new FormData(this),
                            dataType: "json",
                            contentType:false,
                            cache:false,
                            processData:false,
                            beforeSend: function() {
                                thisForm.find(".esc-loading-button").removeClass('d-none');
                                thisForm.find('button[type="submit"]').html('Updateing...');
                                thisForm.find('button[type="submit"]').prop("disabled",true);
                                thisForm.find(".alert-success").removeClass('d-none');
                                thisForm.find(".alert-danger").removeClass('d-none');
                                thisForm.find(".alert-success").addClass('d-none');
                                thisForm.find(".alert-danger").addClass('d-none');
                                thisForm.find('.error').text('');
                            },
                            success: function(response) {
                                thisForm.find(".esc-loading-button").addClass('d-none');
                                thisForm.find('button[type="submit"]').html('Updated');
                                thisForm.find('button[type="submit"]').prop("disabled",false);
                                thisForm.find(".alert-success").removeClass('d-none');
                                toastr.success(response.message);

                                setTimeout(function() {
                                    location.href = "{{route('dashboard')}}";
                                }, 2000)

                            },
                            error: function(xhr, status, error) {
                                thisForm.find(".esc-loading-button").addClass('d-none');
                                thisForm.find('button[type="submit"]').html('Update');
                                thisForm.find('button[type="submit"]').prop("disabled",false);
                                thisForm.find(".alert-danger").removeClass('d-none');

                                var responseText = jQuery.parseJSON(xhr.responseText);
                                toastr.error(responseText.message);

                                $.each(responseText.errors, function(key, val) {
                                    thisForm.find("." + key + "-error").text(val[0]);
                                });
                            }


                        });


                    }

            })



        })
    </script>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#inputImg").change(function() {
        readURL(this);
    });
</script>

@endsection
