@extends('frontend.master')

@section('content')
@include('frontend.layouts.pageBanner')

<section id="popular-service">
    <div class="container">
        <h2 class="section-title text-center wow animated fadeInUp" data-wow-delay="0ms">Service list</h2>
        <p class="sub-title wow animated fadeInUp" data-wow-delay="200ms">Find your desire service from the below service list. Select any categories to get your expected services.</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h2 class="card-title">Services</h2>

                @foreach ($services as $service)

                    <div class="card mb-3">
                        <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{asset('/') . $service->feature_image}}" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href="{{route('serviceDetails',['slug'=>$service->slug,'id'=>$service->id])}}"><h5 class="card-title">{{$service->title}}</h5></a>
                                <p class="card-text">{{$service->info}}</p>
                                <strong> ¥ {{$service->unit_price}}</strong>
                                <p class="card-text"><small class="text-muted">{{$service->category->name}}</small></p>
                            </div>
                        </div>
                        </div>
                    </div>

                @endforeach



                  {{$services->links("pagination::bootstrap-4")}}


            </div>
            <div class="col-md-3">
                @include('frontend.layouts.asideCategory')
            </div>
        </div>
    </div>
</section>


@include('frontend.layouts.banner')
@endsection
