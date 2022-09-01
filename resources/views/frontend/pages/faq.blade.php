@extends('frontend.master')
@section('style')

<style>
    .faqHeader {
        font-size: 27px;
        margin: 20px;
    }

    .panel-heading [data-toggle="collapse"]:after {
        font-family: 'Glyphicons Halflings';
        content: "e072"; /* "play" icon */
        float: right;
        color: #F58723;
        font-size: 18px;
        line-height: 22px;
        /* rotate "play" icon from > (right arrow) to down arrow */
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }

    .panel-heading [data-toggle="collapse"].collapsed:after {
        /* rotate "play" icon from > (right arrow) to ^ (up arrow) */
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
        color: #454444;
    }
</style>

    
@endsection
@section('content')
@include('frontend.layouts.pageBanner')

<div class="container">
   
    <br />

    <div class="" id="accordion">
        <div class="faqHeader">General questions</div>
        @foreach ($faqs as $key=>$faq)
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-header">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}">{{$faq->question}}</a>
                    </h4>
                </div>
            <div id="collapse{{$key}}" class="panel-collapse collapse in">
                    <div class="card-block">
                      <h6 class="p-3">  {{$faq->answer}}</h6> 
                    </div>
                </div>
            </div>   
        @endforeach
    </div>
</div>
<br><br> 

@include('frontend.layouts.banner')
    
@endsection