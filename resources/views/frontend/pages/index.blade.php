@extends('frontend.master')

@section('content')

        {{-- Slider --}}
        @include('frontend.layouts.static_slider')

        @include('frontend.layouts.banner')


        <section id="categories" class="counts">
            <div class="container" data-aos="fade-up">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="section-title text-center " >Find Our <span class="text-dark">Categories</span></h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        @include('frontend.layouts.asideCategory')
                    </div>
                    <div class="col-md-9">
                        <div class="container">
                            <h3 class="widget-title">Recommended Categories</h3>
                            <div class="row">

                                @if ($recommend_categories)

                                    @foreach ($recommend_categories as $recommend_category)
                                        <div class="col-md-4">
                                            <a href="{{route('categoryServices', ['slug'=>$recommend_category->slug,'id'=>$recommend_category->id] )}}">
                                                <div class="card mb-3">
                                                    @if ($recommend_category->image)
                                                    <img src="{{asset('/') . $recommend_category->image}}" height="120" width="200" class="card-img-top" alt="...">
                                                    @else
                                                    <img src="{{asset('public/no_image_found.jpg')}}" class="card-img-top" alt="...">
                                                    @endif
                                                    <div class="card-body">
                                                        <p class="card-title">{{$recommend_category->name}}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach

                                @endif

                            </div>
                        </div>
                        <div class="container">
                            <h3 class="widget-title">Popular Categories</h3>
                            <div class="row">

                                @if ($popular_categories)

                                    @foreach ($popular_categories as $popular_category)
                                        <div class="col-md-4">
                                            <a href="{{route('categoryServices', ['slug'=>$popular_category->slug,'id'=>$popular_category->id] )}}">
                                                <div class="card mb-3">
                                                    @if ($popular_category->image)
                                                    <img src="{{asset('/') . $popular_category->image}}" height="120" width="200" class="card-img-top" alt="...">
                                                    @else
                                                    <img src="{{asset('public/no_image_found.jpg')}}" class="card-img-top" alt="...">
                                                    @endif
                                                    <div class="card-body">
                                                        <p class="card-title">{{$popular_category->name}}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach

                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        @if(isset($about))
            <section id="about" class="" data-bg-image="{{asset('public/frontend')}}/media/about/1.jpg">
                <div class="container "  >
                    <div class="tab">
                        <div class="row">
                            <div class="col-md-3">
                                <ul class="tabs">
                                    <li><a href="#">Message Of CEO</a></li>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Why Choose Us</a></li>
                                    <li><a href="#">Why We Best</a></li>
                                </ul>
                            </div>
                            <div class="col-md-9">
                                <div class="tab_content">
                                <div class="tabs_item clearfix">
                                    @if ($about->message_img)
                                    <img src="{{asset('/')}}{{$about->message_img}}" alt="Choose">
                                    @else
                                    <img src="{{asset('public/no_image_found.jpg')}}" alt="Choose">
                                    @endif


                                        <div class="content">
                                            <h4>Message of CEO</h4><br>
                                            <p>{{$about->message}}</p>
                                            <br>
                                            <p class="text-right">ES Creative 工業株式会社 <br> 代表取締役社長　高橋　忍</p>

                                        </div>
                                    </div>
                                    <div class="tabs_item clearfix">
                                        @if ($about->about_img)
                                        <img src="{{asset('/')}}{{$about->about_img}}" alt="Choose">
                                        @else
                                        <img src="{{asset('public/no_image_found.jpg')}}" alt="Choose">
                                        @endif
                                        <div class="content">
                                            <h4>About Us</h4>
                                        <p>{{$about->about}}</p>
                                            {{-- <ul class="list">
                                                <li><img src="{{asset('public/frontend')}}/media/about/3.png" alt="icon"> We Are the best for
                                                    constraction you know</li>
                                                <li><img src="{{asset('public/frontend')}}/media/about/3.png" alt="icon"> Constraction is not only work
                                                    it also passion</li>
                                                <li><img src="{{asset('public/frontend')}}/media/about/3.png" alt="icon"> We have 10000+ skilld and
                                                    greatest worker</li>
                                                <li><img src="{{asset('public/frontend')}}/media/about/3.png" alt="icon"> You can see our previous work
                                                    form gallery</li>
                                            </ul> --}}
                                        </div>
                                    </div>
                                    <div class="tabs_item clearfix">
                                        @if ($about->why_choose_img)
                                            <img src="{{asset('/')}}{{$about->why_choose_img}}" alt="Choose">
                                        @else
                                            <img src="{{asset('public/no_image_found.jpg')}}" alt="Choose">
                                        @endif
                                        <div class="content">
                                            <h4>Why Choose Us?</h4>
                                            <p>{{$about->why_choose}}</p>
                                            {{-- <ul class="list">
                                                <li><img src="{{asset('public/frontend')}}/media/about/3.png" alt="icon"> We Are the best for
                                                    constraction you know</li>
                                                <li><img src="{{asset('public/frontend')}}/media/about/3.png" alt="icon"> Constraction is not only work
                                                    it also passion</li>
                                                <li><img src="{{asset('public/frontend')}}/media/about/3.png" alt="icon"> We have 10000+ skilld and
                                                    greatest worker</li>
                                                <li><img src="{{asset('public/frontend')}}/media/about/3.png" alt="icon"> You can see our previous work
                                                    form gallery</li>
                                            </ul> --}}
                                        </div>
                                    </div>
                                    <div class="tabs_item clearfix">

                                        @if ($about->why_best_img)
                                            <img src="{{asset('/')}}{{$about->why_best_img}}" alt="Choose">
                                        @else
                                            <img src="{{asset('public/no_image_found.jpg')}}" alt="Choose">
                                        @endif


                                        <div class="content">
                                            <h4>Why Are We Best?</h4>
                                        <p>{{$about->why_best}}</p>
                                            {{-- <ul class="list">
                                                <li><img src="{{asset('public/frontend')}}/media/about/3.png" alt="icon"> We Are the best for
                                                    constraction you know</li>
                                                <li><img src="{{asset('public/frontend')}}/media/about/3.png" alt="icon"> Constraction is not only work
                                                    it also passion</li>
                                                <li><img src="{{asset('public/frontend')}}/media/about/3.png" alt="icon"> We have 10000+ skilld and
                                                    greatest worker</li>
                                                <li><img src="{{asset('public/frontend')}}/media/about/3.png" alt="icon"> You can see our previous work
                                                    form gallery</li>
                                            </ul> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif


        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container" data-aos="fade-up">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="section-title text-center " >Happy <span class="text-dark">Clients</span></h2>
                    </div>
                </div>

            <div class="row">

                <div class="col-lg-3 col-md-6">
                <div class="count-box">
                    <i class="bi bi-emoji-smile"></i>
                    <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                    <p>SATISFICTIONS</p>
                </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                <div class="count-box">
                    <i class="bi bi-journal-richtext"></i>
                    <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Projects</p>
                </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                <div class="count-box">
                    <i class="bi bi-headset"></i>
                    <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Hours Of Support</p>
                </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                <div class="count-box">
                    <i class="bi bi-people"></i>
                    <span data-purecounter-start="0" data-purecounter-end="380" data-purecounter-duration="1" class="purecounter"></span>
                    <p>HAPPY CLIENTS</p>
                </div>
                </div>

            </div>

            </div>
        </section>
        <!-- End Counts Section -->

        {{-- Services --}}
        @include('frontend.layouts.services')


       @include('frontend.layouts.banner')


        {{-- Working Process --}}


        <section id="popular-service">
            <div class="container">
                <h2 class="section-title text-center " >Our Working <span class="text-dark">Process</span></h2>
                {{-- <p class="sub-title " data-wow-delay="200ms">Here is show our popular service for
                    our clients, who want to create<br>building from us, and who have huge money for spend.</p> --}}
                <div class="row "  >

                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="pop-service"><img style="height: 300px; width:370px" src="{{asset('public/frontend/media')}}/prosses/1111.jpg" alt="service">
                            <div class="service-details">
                                <p>Counseling</p>
                                <a><i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="pop-service"><img style="height: 300px; width:370px" src="{{asset('public/frontend/media')}}/prosses/22.jpg" alt="service">
                            <div class="service-details">
                                <p>Contract</p>
                                <a><i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="pop-service"><img style="height: 300px; width:370px" src="{{asset('public/frontend/media')}}/prosses/333.jpg" alt="service">
                            <div class="service-details">
                                <p>Complete Work</p>
                                <a><i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="pop-service"><img style="height: 300px; width:370px" src="{{asset('public/frontend/media')}}/prosses/44.jfif" alt="service">
                            <div class="service-details">
                                <p>Delivery</p>
                                <a><i class="fa fa-long-arrow-up"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>




        {{-- Send Quotation --}}
        <section id="team" data-bg-image="{{asset('public/frontend')}}/media/rev-banner/officeloop_cover.jpg" >
            <div class="container">
                <h2 class="section-title text-center" >Get free quotaion</h2>
                <p class="sub-title text-dark">Send us about your estimate.</p>
                <div class="row ">
                   <div class="col-md-2 col-lg-2 col-sm-12"></div>
                    <div class="col-md-8 col-lg-8 col-sm-12">
                        <form id="quotationForm-1" method="POST">
                            @csrf
                                <div>
                                    <div class="col-md-12">
                                        <div class="alert alert-danger alert-dismissible d-none ">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="fa fa-info"></i> Error!</h5>
                                            <small class="alert-message">Something went wrong. Please try again...</small>
                                        </div>

                                        <div class="alert alert-success alert-dismissible d-none ">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h5><i class="fa fa-check"></i> Success!</h5>
                                            <small class="alert-message">Message Sent sucessfully.</small>
                                        </div>
                                    </div>

                                    <table class="table text-dark  bg-light">
                                        <tr>
                                            <td>Choose your necessary option <br>
                                                <span class="text-danger">[必須]</span>
                                            </td>
                                            <td>
                                                <label for="quotation"><input name="quotation" id="quotation"  type="checkbox" value="1"> Quotation</label> &nbsp;
                                                <label for="visit"><input name="visit" id="visit"  type="checkbox" value="1"> Visit Reservation</label> &nbsp;
                                                <label for="diagnosis"><input name="diagnosis" id="diagnosis" type="checkbox" value="1"> Diagnosis</label>&nbsp;
                                                <label for="consultation"><input name="consultation" id="consultation" type="checkbox" value="1"> Consultation</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Name <span class="text-danger">[必須]</span></td>
                                            <td>
                                                <input name="name" id="name" required maxlength="50" class="form-control" placeholder="Enter your name" type="text">
                                                <span id="err_name" class="name-error error text-danger"></span>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Email <span class="text-danger">[必須]</span></td>
                                            <td>
                                                <input required maxlength="50" id="email" name="email" class="form-control" placeholder="Enter you email" type="email">
                                                <span id="err_email" class="email-error error text-danger"></span>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Mobile <span class="text-danger">[必須]</span></td>
                                           <td>
                                               <input required name="mobile" id="mobile" class="form-control" placeholder="Enter your mobile number" type="text">
                                               <span id="err_mobile" class="mobile-error error text-danger"></span>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>Subject <span class="text-danger">[必須]</span></td>
                                            <td><input required maxlength="50" name="subject"  class="form-control" placeholder="Enter your subject" type="text"></td>
                                        </tr>
                                        <tr>
                                            <td>Message <span class="text-danger">[必須]</span></td>
                                            <td><textarea required name="message" id="message" class="form-control" cols="30" rows="5"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <button type="submit" class="btn btn-primary float-right">
                                                    <span class="esc-loading-button d-none">
                                                        <i class="fa fa-spinner fa-spin"></i>
                                                    </span>
                                                    <span class="submit-btn">
                                                        Submit
                                                    </span>
                                                </button>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                        </form>

                    </div>
                    <div class="col-md-2 col-lg-2 col-sm-12"></div>

                </div>
            </div>
        </section>

        {{-- Recent Projects --}}
        <section id="recent_project">
            <div class="container">
                <h2 class="section-title text-center " >Recent Project</h2>
                <p class="sub-title " data-wow-delay="200ms">Here i show our main services you ca
                    see this if you need, we are the boos of the constraction industry so you can order any service
                    without any hisitetion, why late</p>
                <div class="row fadeInBottom">
                    @foreach ($projects as $project)
                    <div class="col-md-4 col-sm-6 ">
                    <div class="project"><img style="height: 380px; withd:400px" src="{{asset('/')}}{{$project->image}}" alt="project">
                            <div class="project-intro">
                            <h3>{{$project->title}}</h3>
                            <p>{{substr($project->description,0,50)}}...</p><a href="{{route('projectDetails', $project->id)}}" class="dt-btn bg-transpernt">More</a>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
        </section>


        {{-- <section id="popular-service">
            <div class="container">
                <h2 class="section-title text-center " >Happy <span class="text-dark">Clients</span></h2>

                <div class="row "  >

                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="pop-service"><img style="height: 300px; width:370px; border-radius: 50%;" src="{{asset('public/frontend/media')}}/happy/a1.JPG" alt="service">
                            <div class="service-details" style="text-align: center">
                                <p>Total Projects</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="pop-service"><img style="height: 300px; width:370px ;border-radius: 50%" src="{{asset('public/frontend/media')}}/happy/a2.JPG" alt="service">
                            <div class="service-details" style="text-align: center">
                                <p>Successfull Projects</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="pop-service"><img style="height: 300px; width:370px ;border-radius: 50%" src="{{asset('public/frontend/media')}}/happy/a3.JPG" alt="service">
                            <div class="service-details" style="text-align: center">
                                <p>Happy Clients</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 mb-2">
                        <div class="pop-service"><img style="height: 300px; width:370px ; border-radius: 50%" src="{{asset('public/frontend/media')}}/happy/a4.JPG" alt="service">
                            <div class="service-details" style="text-align: center">
                                <p>Satisfiction</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


 --}}



        {{-- Testimonial --}}
        <section id="testimonial" data-bg-image="{{asset('public/frontend')}}/media/rev-banner/desktopbg1.jpg" data-parallax="image" data-carousel="swiper">
            <div class="container">

                <h2 class="section-title text-center " >Testimonial</h2>

                <p class="sub-title  text-dark " data-wow-delay="200ms">Here i show our main services you ca
                    see this if you need, we are the boos of the constraction industry so you can order any service
                    without any hisitetion, why late</p>

                <div class="testimonial-slider">
                    <div class="swiper-container" data-swiper="container" data-items="2" data-space="70"
                        data-loop="true" data-autoplay="5000" data-speed="600"
                        data-breakpoints='{"5000": {"slidesPerView": 2}, "1024": {"slidesPerView": 2}, "768": {"slidesPerView": 1}, "480": {"slidesPerView": 1}}'>
                        <div class="swiper-wrapper">
                            @foreach ($testimonial as $testimoni)
                            <div class="swiper-slide">
                                <div class="testimonial clearfix">
                                    <div class="content">
                                        <!--<div class="testi-thumb"><img src="{{asset('public/frontend')}}/media/testimonial/3.jfif" alt="Testi"></div>-->
                                    <p class="text-dark">{{$testimoni->comment}}</p>
                                        <ul class="star">
                                            <li><i class="fa fa-star text-warning"></i></li>
                                            <li><i class="fa fa-star text-warning"></i></li>
                                            <li><i class="fa fa-star text-warning"></i></li>
                                            <li><i class="fa fa-star text-warning"></i></li>
                                            <li><i class="fa fa-star text-warning"></i></li>
                                        </ul>
                                    </div>
                                    <div class="user-details text-right">
                                    <h3 class="name">{{$testimoni->name}}</h3>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="testi-pagination text-center" data-swiper="pagination"></div>
            </div>
        </section>



        @include('frontend.layouts.banner')





        {{-- Blog --}}
        <section id="blog">
            <div class="container">
                <h2 class="section-title text-center " >Latest Blogs</h2>
                <p class="sub-title text-center " data-wow-delay="200ms">Here i show our main
                    services you ca see this if you need, we are the boos of the constraction industry so you can order
                    any service without any hisitetion, why late :)</p>
                <div class="row">
                    @foreach ($blogs as $blog)
                    <div class="col-md-4 col-sm-6">
                        <div class="blog-grid wow animated fadeInLeft">
                            <div class="blog-thumb">
                                <a href="{{route('blogDetails',['slug'=>$blog->slug,'id'=>$blog->id])}}"><img style="height: 300px; width:100%" src="{{asset('/')}}{{$blog->image}}" alt="blog thumb"></a>
                                <div class="post-meta clearfix">
                                    <span  class="author text-left text-light" style="padding: 2px" ><i class="fa fa-user"></i> Admin</span>
                                    <span  class="date text-right text-light"><i class="fa fa-clock-o"></i> {{date('d-m-Y', strtotime($blog->updated_at))}}</span>
                                </div>
                                </div>
                            <div class="blog-content">
                            <h3 class="blog-title"><a href="{{route('blogDetails',['slug'=>$blog->slug,'id'=>$blog->id])}}">{{$blog->title}}</a></h3>
                            <p>{{substr($blog->description,0,50)}}</p>
                            <a href="{{route('blogDetails',['slug'=>$blog->slug,'id'=>$blog->id])}}" class="dt-btn">Read More</a>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
        </section>

        <section id="choice">
            <div class="container">
                <div class="choice clearfix">
                    <h4>Are You Want a Awesome Construction Agency?</h4>
                <h2>We are the right choice for your project you know.</h2><a href="{{route('quotation.create')}}" class="dt-btn">Get Quotation</a>
                </div>
            </div>
        </section>
@endsection



@section('script')

    <script>
        $(document).ready(function(){
            $("#quotationForm-1").on('submit', function(e){
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{route('quotationStore')}}",
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
                    },
                    success: function (response) {
                        thisForm.find(".esc-loading-button").addClass('d-none');
                        thisForm.find('button[type="submit"]').html('Submitted');
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        thisForm.find(".alert-success").removeClass('d-none');
                        toastr.success('Successful');
                        setTimeout(function() {
                                location.reload();
                            }, 5000)

                    },
                    error: function(xhr, status, error) {
                            thisForm.find(".esc-loading-button").addClass('d-none');
                            thisForm.find('button[type="submit"]').html('Submit');
                            thisForm.find('button[type="submit"]').prop("disabled",false);
                            thisForm.find(".alert-danger").removeClass('d-none');
                            var responseText = jQuery.parseJSON(xhr.responseText);
                            toastr.error(responseText.message);
                    }

                });
            })
        })
    </script>


@endsection
