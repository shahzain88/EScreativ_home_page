@extends('frontend.master')

@section('content')

@include('frontend.layouts.pageBanner')

<div class="container">

    @if(Session::get('message'))

    <p>{{Session::get('message')}}</p>

@endif



<form action="{{route('order.store')}}" method="post">

    @csrf

    <div class="row">

        <div class="col-md-12">

         



            

            <div class="table-responsive">

                <table class="table">

                    <thead>

                        <tr>

                            <th>Select</th>

                            <th>Quantity</th>

                            <th>Cons. Site</th>

                            <th>Service Name</th>

                            <th>Product Name</th>

                            <th>Unit Price</th>

                            <!--<th>Image</th>-->

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($products as $product)

                            <tr>

                                <td>

                                    <div class="">

                                        <input class="" name="product_ids[]" value="{{$product->id}}" type="checkbox">

                                    </div>

                                  

                                </td>

                                <td>

                                    <input style="width: 50px" class="" id="quantity" type="number" min="1" name="quantity[{{$product->id}}][]" value="1">

                                </td>

                                <td>{{$product->construction_site}}</td>

                                <td> <a href="{{route('product.show', $product->id)}}" target="_blank">{{$product->service_name}}</a> </td>

                                <td> <a target="_blank" href="{{route('product.show', $product->id)}}">{{$product->product_name}}</a> </td>

                                <td>{{$product->product_price}}</td>

                                <!--<td><img src="{{asset('/')}}{{$product->product_image}}" alt="IMG" style="height: 100px; width:100px"></td>-->

                            </tr>

                        @endforeach

                    </tbody>

                </table>



            </div>



        </div>



    </div>



    <div class="row">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header">

                    <button class="btn btn-primary" id="checkout" type="button">Checkout</button>



                </div>



                <div class="card-body">

                    <div class="row">

                         <div class="form-group col-md-6">

                        <label for="">Customer Name*:</label>

                        <input required class="form-control" type="text" name="name" placeholder="Customer Name">

                    </div>

                    <div class="form-group col-md-6">

                        <label for="">Mobile*:</label>

                        <input required class="form-control" name="mobile" type="text" placeholder="Customer Mobile">

                    </div>

                    <div class="form-group col-md-6">

                        <label for="">Email:</label>

                        <input class="form-control" name="email" type="email" placeholder="Customer Email">

                    </div>

                     <div class="form-group col-md-6">

                        <label for="">Address:</label>

                        <textarea class="form-control" name="address" id="" cols="30" rows="3" placeholder="Customer Address"></textarea>

                    </div>

                        

                    </div>
                    
                    
                    <div class="row">

                        <div class="col-md-6">

                             <label for="">Construction Details:</label>

                        <input class="form-control" type="text" placeholder="Construction Details" name="construction_details">

                        </div>

                           <div class="col-md-6">

                             <label for="">Validity:</label>

                        <input class="form-control" type="text" placeholder="Validity" name="validity">

                        </div>


                    </div>
                    
                    

                    <div class="row">

                        <div class="col-md-6">

                             <label for="">Expenses:</label>

                        <input class="form-control" type="text" placeholder="Expenses" name="expenses">

                        </div>

                           <div class="col-md-6">

                             <label for="">Discount:</label>

                        <input class="form-control" type="text" placeholder="Discount" name="discount">

                        </div>

                              <div class="form-group col-md-6">

                                  <br><br>

                        <button type="submit" class="btn btn-success form-control">Submit</button>

                    </div>

                    </div>

                   



              

                  

                </div>



            </div>



        </div>



    </div>

    

</form>



</div>

    

@endsection





@section('script')



<script>

    $(document).ready(function(){

        $('.card-body').hide();

        $("#checkout").on('click', function(){

            $('.card-body').show();

        })

        

    })

</script>

    

@endsection