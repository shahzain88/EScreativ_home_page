@extends('frontend.master')

@section('content')
    @include('frontend.layouts.pageBanner')

    <section id="service_single" data-carousel="swiper">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <aside class="service-widgets">
                        @include('frontend.layouts.asideCategory')
                    </aside>
                    <br>
                    <aside class="widget widget_archive">
                        @include('frontend.layouts.gallery')
                    </aside>
                </div>
                <div class="col-md-9">

                    <div class="projece-single">
                        <div class="thumbnail-container gallery-top" data-swiper="container" data-initial="3"
                            data-loop="true" data-looped="5" data-effect="fade" data-crossfade="true">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide"><img src="{{ asset('/') . $service->feature_image }}"
                                        alt="Thumbnail"></div>
                                    @if ($service->images)
                                        @foreach ($service->images as $serviceImg)
                                        <div class="swiper-slide"><img src="{{asset('/') . $serviceImg->image }}" alt="Thumbnail"></div>

                                        @endforeach
                                    @endif

                                {{-- <div class="swiper-slide"><img src="{{asset('public/frontend/media/recent-work/10.jpg')}}" alt="Thumbnail"></div>
                                <div class="swiper-slide"><img src="{{asset('public/frontend/media/recent-work/12.jpg')}}" alt="Thumbnail"></div>
                                <div class="swiper-slide"><img src="{{asset('public/frontend/media/recent-work/13.jpg')}}" alt="Thumbnail"></div> --}}
                            </div>
                        </div>
                        <div class="thumbnail-container gallery-thumbs" data-swiper="ascontrol" data-initial="2"
                            data-items="4" data-space="30" data-click-to-slide="true" data-loop="true" data-looped="4"
                            data-direction="horizontal">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide"><img src="{{ asset('/') . $service->feature_image }}"
                                        alt="Thumbnail"></div>

                                    @if ($service->images)
                                        @foreach ($service->images as $serviceImg)
                                            <div class="swiper-slide"><img src="{{asset('/') . $serviceImg->image }}" alt="Thumbnail"></div>
                                        @endforeach
                                    @endif
                                {{-- <div class="swiper-slide"><img src="{{asset('public/frontend/media/recent-work/15.jpg')}}" alt="Thumbnail"></div>
                                <div class="swiper-slide"><img src="{{asset('public/frontend/media/recent-work/16.jpg')}}" alt="Thumbnail"></div>
                                <div class="swiper-slide"><img src="{{asset('public/frontend/media/recent-work/17.jpg')}}" alt="Thumbnail"></div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="project-details">
                                <h3 class="project-title">{{ $service->title }}</h3>
                                <p>{{ $service->info }}</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="project-title"> ¥ {{ $service->unit_price }} <small>yen per unit (tax
                                                included)</small> </h3>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{route('serviceReservation', ['slug'=>$service->slug,'id'=>$service->id] )}}" class="btn btn-outline-success">Enter To Reservation The Service</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#sales">Sales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#price">Price</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#work">Work</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#flowToWork">Flow to work</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#beforeBooking">Before booking</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#cancellationPolicy">Cancellation Policy</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#aboutStore">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#reviews">Reviews</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div id="sales" class="container tab-pane active"><br>
                                    <h3>Sales</h3>
                                    {!!$service->sales_point !!}
                                </div>
                                <div id="price" class="container tab-pane fade"><br>
                                    <h3>Price</h3>
                                    {!!$service->price_list !!}
                                </div>
                                <div id="work" class="container tab-pane fade"><br>
                                    <h3>Work</h3>
                                    {!!$service->work_content !!}
                                </div>

                                <div id="flowToWork" class="container tab-pane fade"><br>
                                    <h3>Flow To Work</h3>
                                    {!!$service->flow_to_work !!}
                                </div>
                                <div id="beforeBooking" class="container tab-pane fade"><br>
                                    <h3>Before Booking</h3>
                                    {!!$service->before_booking !!}
                                </div>
                                <div id="cancellationPolicy" class="container tab-pane fade"><br>
                                    <h3>Cancellation Policy</h3>
                                    {!!$service->cancellation_policy !!}
                                </div>

                                <div id="aboutStore" class="container tab-pane fade"><br>
                                    <h3>About</h3>
                                    {!!$service->about_the_store !!}
                                </div>
                                <div id="reviews" class="container tab-pane fade"><br>
                                    <h3>Reviews</h3>
                                    <p>Under Constructions</p>

                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".mySwiper2", {
            loop: true,
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
    </script>
@endsection
