@extends('backend.master')
@section('style')
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Product</li>
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
                        <h3 class="card-title">Add Product</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <a class="btn btn-info" href="{{route('product.index')}}">View List</a>
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" id="productInsertForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="construction_site">Construction Site <small class="construction_site-error text-danger error"></small></label>
                        <input type="text" id="construction_site" class="form-control" name="construction_site" placeholder="Enter Construction Site">
                    </div>

                  <div class="form-group">
                    <label for="service_name">Service Name <small class="service_name-error text-danger error"></small></label>
                    <input type="text" required name="service_name" placeholder="Enter Service Name" class="form-control" id="service_name" >
                  </div>



                  <div class="form-group">
                    <label for="service_description">Service Descripton <small class="service_description-error text-danger error"></small></label>
                    <div class="mb-3">
                        <textarea class="form-control" id="service_description" required name="service_description"  placeholder="Service Description" rows="5" cols="30"></textarea>
                    </div>
                  
                </div>


                <div class="form-group">
                    <label for="product_name">Product Name <small class="product_name-error text-danger error"></small></label>
                    <input type="text" required name="product_name" class="form-control" id="product_name" placeholder="Enter Product Name">
                  </div>
               

                  <div class="form-group">
                    <label for="product_price">Unit Price <small class="product_price-error text-danger error"></small></label>
                    <input type="text" required name="product_price" class="form-control" id="product_price">
                  </div>

                  <div class="form-group">
                    <label for="product_details">Products Description <small class="product_details-error text-danger error"></small></label>
                    <textarea name="product_details" required class="form-control" id="product_details" cols="30" rows="5" placeholder="Enter Product Description"></textarea>
                  </div>

                  <div class="form-group">
                    <label for="inputImg">Image input <small class="product_image-error text-danger error"></small></label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" id="inputImg" accept=".jpg, .jpeg, .png" name="product_image">
                        </div>
                    </div>
                    <img style="height: 100px; width:100px" src="{{ asset('public/no_image_found.jpg') }}"
                        id="previewImg" alt="Preview">
                </div>

                <div class="form-group">
                    <input type="checkbox"  name="status" class="" id="status" value="1">
                    <label for="status">Active <small class="status-error text-danger error"></small></label>
                </div>

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

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <span class="esc-loading-button d-none">
                            <i class="fa fa-spinner fa-spin"></i>
                        </span>
                        <span class="submit-btn">
                            Submit
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

            $("#productInsertForm").on('submit', function(e){
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{route('product.store')}}",
                    data:new FormData(this),
                    dataType: "json",
                    contentType:false,
                    cache:false,
                    processData:false,
                    beforeSend: function() {
                        thisForm.find(".esc-loading-button").removeClass('d-none');
                        thisForm.find('button[type="submit"]').html('Submitting...');
                        thisForm.find('button[type="submit"]').prop("disabled",true);
                        thisForm.find(".alert-success").removeClass('d-none');
                        thisForm.find(".alert-danger").removeClass('d-none');
                        thisForm.find(".alert-success").addClass('d-none');
                        thisForm.find(".alert-danger").addClass('d-none');
                        thisForm.find('.error').text('');
                    },
                    success: function(response) {
                        thisForm.find(".esc-loading-button").addClass('d-none');
                        thisForm.find('button[type="submit"]').html('Submited');
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        thisForm.find(".alert-success").removeClass('d-none');
                        toastr.success(response.message);

                        setTimeout(function() {
                            location.href = "{{route('product.index')}}";
                        }, 2000)

                    },
                    error: function(xhr, status, error) {
                        thisForm.find(".esc-loading-button").addClass('d-none');
                        thisForm.find('button[type="submit"]').html('Submit');
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
          reader.onload = function (e) {
              $('#previewImg').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
      }
  }
  $("#inputImg").change(function(){
      readURL(this);
  });
  </script>
@endsection