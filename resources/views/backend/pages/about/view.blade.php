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
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">About View</li>
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
                        <h3 class="card-title">View About</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        @if ($about)
                            <a href="{{route('about.edit',$about->id)}}" class="btn btn-info">Edit About</a>
                            @else
                            <a href="{{route('about.create')}}" class="btn btn-info">Create New</a>
                            @endif
                    </div>
                  </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->


                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">About</label>
                                        <div class="mb-3">
                                            @if ($about)
                                            <p>{!! $about->about !!}</p>
                                            @else
                                            <p></p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">About Image</label><br>
                                        @if (isset($about->about_img))
                                            <img style="height: 100px; width:100px" src="{{asset('/')}}{{$about->about_img}}" id="previewImgAbout" alt="Preview">
                                        @else
                                            <img style="height: 100px; width:100px" src="{{asset('public/no_image_found.jpg')}}" id="previewImgAbout" alt="Preview">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Message of CEO</label>
                                        <div class="mb-3">
                                        @if ($about)
                                            {!!$about->message!!}
                                        @else
                                            <p></p>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">CEO Image</label><br>
                                        @if (isset($about->message_img))
                                            <img style="height: 100px; width:100px" src="{{asset('/')}}{{$about->message_img}}" id="previewImgAbout" alt="Preview">
                                        @else
                                            <img style="height: 100px; width:100px" src="{{asset('public/no_image_found.jpg')}}" id="previewImgAbout" alt="Preview">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Why Choose US</label>
                                        <div class="mb-3">
                                        @if ($about)
                                            {!!$about->why_choose!!}
                                        @else
                                            <p></p>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Why Choose Us Image</label><br>
                                        @if (isset($about->why_choose_img))
                                            <img style="height: 100px; width:100px" src="{{asset('/')}}{{$about->why_choose_img}}" id="previewImgAbout" alt="Preview">
                                        @else
                                            <img style="height: 100px; width:100px" src="{{asset('public/no_image_found.jpg')}}" id="previewImgAbout" alt="Preview">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Why we best?</label>
                                        <div class="mb-3">

                                        @if ($about)
                                            {!!$about->why_best!!}
                                        @else
                                            <p></p>
                                        @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> Why we best Image</label><br>
                                        @if (isset($about->why_best_img))
                                            <img style="height: 100px; width:100px" src="{{asset('/')}}{{$about->why_best_img}}" id="previewImgAbout" alt="Preview">
                                        @else
                                            <img style="height: 100px; width:100px" src="{{asset('public/no_image_found.jpg')}}" id="previewImgAbout" alt="Preview">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mission</label>
                                        <div class="mb-3">

                                        @if ($about)
                                            {!!$about->mission!!}
                                        @else
                                            <p></p>
                                        @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Misstion Image</label><br>
                                        @if (isset($about->mission_img))
                                            <img style="height: 100px; width:100px" src="{{asset('/')}}{{$about->mission_img}}" id="previewImgAbout" alt="Preview">
                                        @else
                                            <img style="height: 100px; width:100px" src="{{asset('public/no_image_found.jpg')}}" id="previewImgAbout" alt="Preview">
                                        @endif
                                    </div>
                                </div>
                            </div> --}}

                            {{-- <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Vision</label>
                                        <div class="mb-3">
                                        @if ($about)
                                            {!!$about->vision!!}
                                        @else
                                            <p></p>
                                        @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Vision Image</label><br>
                                        @if (isset($about->vision_img))
                                            <img style="height: 100px; width:100px" src="{{asset('/')}}{{$about->vision_img}}" id="previewImgAbout" alt="Preview">
                                        @else
                                            <img style="height: 100px; width:100px" src="{{asset('public/no_image_found.jpg')}}" id="previewImgAbout" alt="Preview">
                                        @endif
                                    </div>
                                </div>
                            </div> --}}

                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">History</label>
                                        <div class="mb-3">
                                        @if ($about)
                                            {!!$about->history!!}
                                        @else
                                            <p></p>
                                        @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">History Image</label><br>
                                        @if (isset($about->history_img))
                                            <img style="height: 100px; width:100px" src="{{asset('/')}}{{$about->history_img}}" id="previewImgAbout" alt="Preview">
                                        @else
                                            <img style="height: 100px; width:100px" src="{{asset('public/no_image_found.jpg')}}" id="previewImgAbout" alt="Preview">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        @if ($about)
                                            <p>{{$about->email}}</p>
                                        @else
                                            <p></p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mobile</label>
                                        @if ($about)
                                        <p>{{$about->mobile}}</p>
                                        @else
                                        <p></p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address</label>
                                        @if ($about)
                                        <p>{{$about->address}}</p>
                                        @else
                                        <p></p>
                                        @endif


                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Logo</label><br>
                                        @if (isset($about->logo))
                                            <img style="height: 100px; width:100px" src="{{asset('/')}}{{$about->logo}}" id="previewImgAbout" alt="Preview">
                                        @else
                                            <img style="height: 100px; width:100px" src="{{asset('public/no_image_found.jpg')}}" id="previewImgAbout" alt="Preview">
                                        @endif
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            @if ($about)
                            <a href="{{route('about.edit',$about->id)}}" class="btn btn-primary">Edit About</a>
                            @else
                            <a href="{{route('about.create')}}" class="btn btn-primary">Create New</a>
                            @endif
                        </div>


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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            $("#newsInsertForm").on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{url('/about')}}",
                    data:new FormData(this),
                    dataType: "json",
                    contentType:false,
                    cache:false,
                    processData:false,
                    success: function (response) {
                        toastr.success('Successful');
                        location.reload();
                    },

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
