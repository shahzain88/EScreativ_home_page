@extends('frontend.master')

@section('content')
@include('frontend.layouts.pageBanner')
<br><br>
@if ($about)
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <img src="{{asset('/')}}{{$about->history_img}}" alt="Mission Preview">


            </div>
            <div class="col-md-6">
                <h3 class="p-3">History</h3>
                <hr>
            <p>{{$about->history}}</p>
            </div>



        </div>
    </div>
</section>
@endif

<br><br>
@include('frontend.layouts.banner')


@endsection
