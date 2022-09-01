@extends('frontend.master')

@section('content')
@include('frontend.layouts.pageBanner')
<br><br>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <img src="{{asset('/')}}{{$about->vision_img}}" alt="Mission Preview">


            </div>
            <div class="col-md-6">
                <h3 class="p-3">Vision</h3>
                <hr>
            <p>{{$about->vision}}</p>
            </div>

            

        </div>
    </div>
</section>
<br><br>
@include('frontend.layouts.banner')
    
@endsection