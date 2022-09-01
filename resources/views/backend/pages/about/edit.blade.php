@extends('backend.master')

@section('style')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>About</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">About</li>
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
                                    <h3 class="card-title">Edit About</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="btn btn-info" href="{{route('about.index')}}">View About</a>
                                </div>
                              </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <form role="form" id="aboutUpdateForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" type="text" name="id" id="aboutID" value="{{ $about->id }}">

                            <div class="card-body">




                                <div class="row">
                                    <div class="col-md-8 col-lg-8 col-sm-12">
                                        <div class="form-group">
                                            <label for="about_img">About Image <small class="about_img-error text-danger error"></small></label><br>
                                            <input type="file" id="about_img" accept="image/*"  name="about_img"  >
                                        </div>
                                        <div class="form-group">
                                            <label for="about">About <small class="about-error text-danger error"></small></label>
                                            <div class="mb-3">
                                                <textarea class="form-control summernote" required name="about" id="about"  placeholder="Place some text here">{!! $about->about !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="about_img_preview">Preview About Image</label><br>
                                            @if (isset($about->about_img))
                                                <img style="height: 100px; width:100px" src="{{asset('/')}}{{$about->about_img}}" id="about_img_preview" alt="Preview">
                                            @else
                                                <img style="height: 100px; width:100px" src="{{asset('public/no_image_found.jpg')}}" id="about_img_preview" alt="Preview">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-8 col-lg-8 col-sm-12">
                                        <div class="form-group">
                                            <label for="message_img">CEO Image <small class="message_img-error text-danger error"></small></label><br>
                                            <input type="file" id="message_img" accept="image/*"  name="message_img"  >
                                        </div>
                                        <div class="form-group">
                                            <label for="message">Message of CEO <small class="message-error text-danger error"></small></label>
                                            <div class="mb-3">
                                                <textarea class="form-control summernote" required name="message" id="message" placeholder="Place some text here"
                                                       row="30" col="5">{!!$about->message!!}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="message_img_preview">Preview CEO Image <small class="message_img-error text-danger error"></small></label><br>
                                            @if (isset($about->message_img))
                                                <img style="height: 100px; width:100px" src="{{asset('/')}}{{$about->message_img}}" id="message_img_preview" alt="Preview">
                                            @else
                                                <img style="height: 100px; width:100px" src="{{asset('public/no_image_found.jpg')}}" id="message_img_preview" alt="Preview">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr>


                                <div class="row">
                                    <div class="col-md-8 col-lg-8 col-sm-12">
                                        <div class="form-group">
                                            <label for="why_choose_img">Choose Image <small class="why_choose_img-error text-danger error"></small></label><br>
                                            <input type="file" id="why_choose_img" accept="image/*"  name="why_choose_img"  >
                                        </div>
                                        <div class="form-group">
                                            <label for="why_choose">Why Choose US <small class="why_choose-error text-danger error"></small></label>
                                            <div class="mb-3">
                                                <textarea class="form-control summernote" required name="why_choose" id="why_choose"  placeholder="Place some text here"
                                                       row="30" col="5">{!!$about->why_choose!!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="why_choose_img_preview">Preview Choose Image </label><br>
                                            @if (isset($about->why_choose_img))
                                                <img style="height: 100px; width:100px" src="{{asset('/')}}{{$about->why_choose_img}}" id="why_choose_img_preview" alt="Preview">
                                            @else
                                                <img style="height: 100px; width:100px" src="{{asset('public/no_image_found.jpg')}}" id="why_choose_img_preview" alt="Preview">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-8 col-lg-8 col-sm-12">
                                        <div class="form-group">
                                            <label for="why_best_img">Best Image <small class="why_best_img-error text-danger error"></small></label><br>
                                            <input type="file" id="why_best_img" accept="image/*"  name="why_best_img"  >
                                        </div>
                                        <div class="form-group">
                                            <label for="why_best">Why we best? <small class="why_best-error text-danger error"></small></label>
                                            <div class="mb-3">
                                                <textarea class="form-control summernote" required name="why_best" id="why_best"  placeholder="Place some text here"
                                                       row="30" col="5">{!!$about->why_best!!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="why_best_img_preview">Preview Best Image </label><br>
                                            @if (isset($about->why_best_img))
                                                <img style="height: 100px; width:100px" src="{{asset('/')}}{{$about->why_best_img}}" id="why_best_img_preview" alt="Preview">
                                            @else
                                                <img style="height: 100px; width:100px" src="{{asset('public/no_image_found.jpg')}}" id="why_best_img_preview" alt="Preview">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- <hr>

                                <div class="row">
                                    <div class="col-md-8 col-lg-8 col-sm-12">
                                        <div class="form-group">
                                            <label for="mission_img">Mission Image <small class="mission_img-error text-danger error"></small></label><br>
                                            <input type="file" id="mission_img" accept="image/*"  name="mission_img"  >
                                        </div>
                                        <div class="form-group">
                                            <label for="mission">Mission <small class="mission-error text-danger error"></small></label>
                                            <div class="mb-3">
                                                <textarea class="form-control" required name="mission" id="mission"  placeholder="Place some text here"
                                                       row="30" col="5">{!!$about->mission!!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="mission_img_preview">Preview Mission Image</label><br>
                                            @if (isset($about->mission_img))
                                                <img style="height: 100px; width:100px" src="{{asset('/')}}{{$about->mission_img}}" id="mission_img_preview" alt="Preview">
                                            @else
                                                <img style="height: 100px; width:100px" src="{{asset('public/no_image_found.jpg')}}" id="mission_img_preview" alt="Preview">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-8 col-lg-8 col-sm-12">
                                        <div class="form-group">
                                            <label for="vision_img">Vision Image <small class="vision_img-error text-danger error"></small></label><br>
                                            <input type="file" id="vision_img" accept="image/*"  name="vision_img"  >
                                        </div>
                                        <div class="form-group">
                                            <label for="vision">Vision <small class="vision-error text-danger error"></small></label>
                                            <div class="mb-3">
                                                <textarea class="form-control" required name="vision" id="vision"  placeholder="Place some text here"
                                                       row="30" col="5">{!!$about->vision!!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="vision_img_preview">Preview Vision Image</label><br>
                                            @if (isset($about->vision_img))
                                                <img style="height: 100px; width:100px" src="{{asset('/')}}{{$about->vision_img}}" id="vision_img_preview" alt="Preview">
                                            @else
                                                <img style="height: 100px; width:100px" src="{{asset('public/no_image_found.jpg')}}" id="vision_img_preview" alt="Preview">
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}

                                <hr>

                                <div class="row">
                                    <div class="col-md-8 col-lg-8 col-sm-12">
                                        <div class="form-group">
                                            <label for="history_img">History Image <small class="history_img-error text-danger error"></small></label><br>
                                            <input type="file" id="history_img" accept="image/*"  name="history_img"  >
                                        </div>
                                        <div class="form-group">
                                            <label for="history">History <small class="history-error text-danger error"></small></label>
                                            <div class="mb-3">
                                                <textarea class="form-control summernote" required name="history" id="history"  placeholder="Place some text here"
                                                       row="30" col="5">{!!$about->history!!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="history_img_preview">Preview History Image</label><br>
                                            @if (isset($about->history_img))
                                                <img style="height: 100px; width:100px" src="{{asset('/')}}{{$about->history_img}}" id="history_img_preview" alt="Preview">
                                            @else
                                                <img style="height: 100px; width:100px" src="{{asset('public/no_image_found.jpg')}}" id="history_img_preview" alt="Preview">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-md-8 col-lg-8 col-sm-12">
                                        <div class="form-group">
                                            <label for="logo">Company Logo <small class="logo-error text-danger error"></small></label><br>
                                            <input type="file"  accept="image/*" id="logo" name="logo"  >
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="logo_preview">Preview Company Logo</label><br>
                                            @if (isset($about->logo))
                                                <img style="height: 100px; width:100px" src="{{asset('/')}}{{$about->logo}}" id="logo_preview" alt="Preview">
                                            @else
                                                <img style="height: 100px; width:100px" src="{{asset('public/no_image_found.jpg')}}" id="logo_preview" alt="Preview">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="email">Email <small class="email-error text-danger error"></small></label>
                                            <input type="email" id="email" value="{{$about->email}}" class="form-control" name="email">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="mobile">Mobile <small class="mobile-error text-danger error"></small></label>
                                            <input type="text" id="mobile" value="{{$about->mobile}}" class="form-control" name="mobile">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="address">Address <small class="address-error text-danger error"></small></label>
                                            <input type="text" id="address" value="{{$about->address}}" class="form-control" name="address">
                                        </div>
                                    </div>

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
                                    <span class="slider-submit-btn">
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
            console.log("Jquery Getting");

            $("#aboutUpdateForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);

                $.ajax({
                    type: "POST",
                    url: "{{route('about.update', $about->id)}}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find(".esc-loading-button").removeClass('d-none');
                        thisForm.find(".slider-submit-btn").html('Updateing...');
                        thisForm.find('button[type="submit"]').prop("disabled",true);
                        thisForm.find(".alert-success").removeClass('d-none');
                        thisForm.find(".alert-danger").removeClass('d-none');
                        thisForm.find(".alert-success").addClass('d-none');
                        thisForm.find(".alert-danger").addClass('d-none');
                        thisForm.find('.error').text('');
                    },
                    success: function(response) {
                        thisForm.find(".esc-loading-button").addClass('d-none');
                        thisForm.find(".slider-submit-btn").html('Updated');
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        thisForm.find(".alert-success").removeClass('d-none');
                        toastr.success(response.message);

                        setTimeout(function() {
                            location.href = "{{route('about.index')}}";
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find(".esc-loading-button").addClass('d-none');
                        thisForm.find(".slider-submit-btn").html('Submit');
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

    function read_about_img_URL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#about_img_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }



    $("#about_img").change(function(){
        read_about_img_URL(this);
    });

      //   message_img
      $("#message_img").change(function(){
          read_message_img_URL(this);
      });

    function read_message_img_URL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#message_img_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

      //   why_choose_img
      $("#why_choose_img").change(function(){
          read_why_choose_img_URL(this);
      });

      function read_why_choose_img_URL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#why_choose_img_preview').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }

      // why_best_img
      $("#why_best_img").change(function(){
          read_why_best_img_URL(this);
      });

      function read_why_best_img_URL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#why_best_img_preview').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }

      // mission_img
      $("#mission_img").change(function(){
          read_mission_img_URL(this);
      });

      function read_mission_img_URL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#mission_img_preview').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }

      // vision_img

      $("#vision_img").change(function(){
          read_vision_img_URL(this);
      });

      function read_vision_img_URL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#vision_img_preview').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }

      // history_img

      $("#history_img").change(function(){
          read_history_img_URL(this);
      });

      function read_history_img_URL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#history_img_preview').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }

      // logo

      $("#logo").change(function(){
          read_logo_URL(this);
      });

      function read_logo_URL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#logo_preview').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }


  </script>
@endsection
