@extends('frontend.master')

@section('content')
@include('frontend.layouts.pageBanner')
<section id="pricing">
    <div class="container">
        <h2 class="section-title text-center">Awesome products for you</h2>
        <p class="sub-title">Here is our pricing list by project categories, choose the best packege which
            is<br>you need, and we are commited you will won finally .</p>
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="pricing text-center">
                    <div class="pricing-head"><img src="{{asset('public/frontend/media')}}/pricing/1.jpg" alt="price">
                        {{-- <div class="price">
                            <p><sup>$</sup>79 <span>M</span></p>
                        </div> --}}
                    </div>
                    <h5>Product Name</h5>
                    <ul class="plan">
                        <p>Short description</p>
                        {{-- <li>5 Km Distence</li>
                        <li>4 Lane Road</li>
                        <li>With Footover Bridge</li> --}}
                    </ul><a type="button" data-toggle="modal" data-target="#exampleModal" class="dt-btn text-center">Get It</a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="pricing text-center">
                    <div class="pricing-head"><img src="{{asset('public/frontend/media')}}/pricing/2.jpg" alt="price">
                        {{-- <div class="price">
                            <p><sup>$</sup>79 <span>M</span></p>
                        </div> --}}
                    </div>
                    <h5>Product Name</h5>
                    <ul class="plan">
                        <p>Short Description</p>
                        {{-- <li>5 Km Distence</li>
                        <li>4 Lane Road</li>
                        <li>With Footover Bridge</li> --}}
                    </ul><a type="button" data-toggle="modal" data-target="#exampleModal" class="dt-btn text-center">Get It</a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="pricing text-center">
                    <div class="pricing-head"><img src="{{asset('public/frontend/media')}}/pricing/3.jpg" alt="price">
                        {{-- <div class="price">
                            <p><sup>$</sup>79 <span>M</span></p>
                        </div> --}}
                    </div>
                    <h5>Product Name</h5>
                    <ul class="plan">
                        <p>Short Description</p>
                        {{-- <li>5 Km Distence</li>
                        <li>4 Lane Road</li>
                        <li>With Footover Bridge</li> --}}
                    </ul><a type="button" data-toggle="modal" data-target="#exampleModal" class="dt-btn text-center">Get It</a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="pricing text-center">
                    <div class="pricing-head"><img src="{{asset('public/frontend/media')}}/pricing/4.jpg" alt="price">
                        {{-- <div class="price">
                            <p><sup>$</sup>79 <span>M</span></p>
                        </div> --}}
                    </div>
                    <h5>Product Name</h5>
                    <ul class="plan">
                        <p>Short Description</p>
                        {{-- <li>5 Km Distence</li>
                        <li>4 Lane Road</li>
                        <li>With Footover Bridge</li> --}}
                    </ul><a  type="button" class="dt-btn text-center" data-toggle="modal" data-target="#exampleModal">Get It</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" style="margin-top:50px " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Product Name</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST">
                <input type="text" class="form-control" name="" placeholder="Name" id=""><br>
                <input type="text"  class="form-control" name="" placeholder="Address" id=""><br>
                <input type="text"  class="form-control" name="" placeholder="Email" id=""><br>
                <input type="text"  class="form-control" name="" placeholder="Mobile" id=""><br>
            </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Order Now</button>
        </div>
      </div>
    </div>
  </div>

@include('frontend.layouts.banner')
    
@endsection