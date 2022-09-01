@extends('frontend.master')

@section('content')
@include('frontend.layouts.pageBanner')

@if ($about)
    <section id="ab-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="ab-content wow animated fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <h2 class="section-title">Who We Are?</h2>
                            {{$about->about}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="ab-thumb wow animated fadeInRight" data-wow-delay="300ms"
                data-wow-duration="1500ms"><img src="{{asset('/')}}{{$about->about_img}}" alt="about"></div>
                </div>
            </div>
        </div>
    </section>
@endif

@include('frontend.layouts.banner')

@endsection
