@extends('frontend.master')

@section('content')
@include('frontend.layouts.pageBanner')


        
<section id="project_single" data-carousel="swiper">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <table class="details">
                    <tr>
                        <td>Construction Site :</td>
                        <td>{{$product->construction_site}}</td>
                    </tr>
                    <tr>
                        <td>Product Price :</td>
                    <td>{{$product->product_price}}</td>
                    </tr>
                    <tr>
                        <td>Service Cost :</td>
                    <td>{{$product->service_cost}}</td>
                    </tr>
                   
                  
                </table>
            </div>
            <div class="col-md-8">
                <div class="projece-single">
                <img style="width: 100%; height:400px" src="{{asset('/')}}{{$product->product_image}}" alt="Thumbnail">
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="project-details">
                            <h3 class="project-title">{{$product->product_name}}</h3>
                        <p>{{$product->product_details}}</p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="project-details">
                            <h3 class="project-title">{{$product->service_name}}</h3>
                        <p>{{$product->service_description}}</p>
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    
@endsection