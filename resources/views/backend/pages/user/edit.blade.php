@extends('backend.master')
@section('style')
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Category</li>
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
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <h3 class="card-title">Add Category</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="btn btn-info" href="{{route('category.index')}}">View List</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="userUpdateForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
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

                                <div class="form-group">
                                    <label for="name">Name <small class="name-error text-danger error"></small></label>
                                    <input type="text" required name="name" class="form-control" value="{{$user->name}}" id="name"
                                        placeholder="Enter Name">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email <small class="email-error text-danger error"></small></label>
                                    <input type="email" required name="email" value="{{$user->email}}" class="form-control" id="email"
                                        placeholder="Enter Email">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password <small class="password-error text-danger error">(Keep blank to unchange)</small></label>
                                    <input type="text"  name="password" class="form-control" id="password">
                                </div>

                                <div class="form-group">
                                    <label for="role_id">Role <small class="role_id-error text-danger error"></small></label>
                                    <div class="mb-3">
                                        <select class="form-control" id="role_id" required name="role_id">
                                            <option value="">Select Role</option>
                                            @if ($roles)
                                                @foreach ($roles as $role)
                                                    <option value="{{$role->id}}" @if ($user->role_id == $role->id) selected @endif >{{$role->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
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

                                <div class="form-group">
                                    <input type="checkbox"  name="status" class="" @if ($user->status) checked @endif id="status" value="1">
                                    <label for="status">Active <small class="status-error text-danger error"></small></label>
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
        $(document).ready(function() {
            $("#userUpdateForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('user.update', $user->id) }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
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
                            location.href = "{{route('user.index')}}";
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
