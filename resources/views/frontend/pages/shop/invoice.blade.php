<!doctype html>

<html lang="en">

  <head>

    <!-- Required meta tags -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">



    <title>ES Creative Invoice</title>

  </head>

  <body>

      @php

          $subtotal = 0;

          $total = 0;

      @endphp

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="responsive-table">

                    <table class="table table-bordered">

                        <thead>

                            <tr>

                                <td colspan="7" class="text-right">

                                    <!--平成   26年   5月   29日-->

                                    <input type="date">

                                </td>

                            </tr>

                            <tr>

                                <td colspan="7" class="text-center">

                                    御　見　積　書

                                </td>

                            </tr>

                            <tr>

                                <td colspan="2">

                                    <table style="width: 100%">

                                        <tr>

                                            <td colspan="2" class="text-center" >
                                                @if ($customer)
                                                <strong> {{$customer->name }}</strong>

                                                @endif
                                            </td>

                                        </tr>

                                        <tr>

                                            <td>工事内容</td>

                                            <td>{{$order->construction_details}}</td>

                                        </tr>

                                        <tr>

                                            <td>合計金額</td>

                                            <td>

                                              <p id="vtotal"></p>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td>場所</td>

                                            <td>
                                                @if ($customer)
                                                {{$customer->address}}

                                                @endif
                                            </td>

                                        </tr>

                                        <tr>

                                            <td>有効期限：</td>

                                            <td> {{$order->validity}} </td>

                                        </tr>

                                    </table>

                                </td>

                                <td colspan="5" class="text-center">

                                    <div class="pl-5">

                                     <div class="text-center">

                                        <select class="">

                                          <option value="">お客様控え</option>

                                          <option value="">会社控え</option>

                                        </select>

                                     </div>



                                    <!--<p class="text-center">会社控え</p>-->

                                    <h6 class="text-danger text-center">人・住まい・環境に優しい</h6>

                                    <h4 class="text-success text-center"><strong>快適ライフサポート</strong> </h4>



                                    <strong class="text-success">ES Creative 工業株式会社</strong> <br>

                                    <span>〒343-0035</span><br>

                                    <span>埼玉県越谷市大字大道510番地１階</span><br>

                                    <span>TEL:048-940-3935 FAX:048-940-3953</span><br>

                                    <span>E-mail: contact@escreative-industry.com</span><br>

                                    <span>www.escreative-industry.com</span><br>

                                    <span>担当（手書きサイン）：</span>



                                      </div>





                                </td>

                            </tr>

                            <tr>

                                <td>施工箇所</td>

                                <td>施　　　工　　　内　　　容</td>

                                <td>商　品</td>

                                <td>単価</td>

                                <td>単位</td>

                                <td>数量</td>

                                <td>金　　　額</td>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($carts as $cart)

                            @php

                                $product= DB::table('products')->where('id', $cart->product_id)->first();

                            @endphp

                            <tr>

                                <td>

                                    @if (isset($product->construction_site))

                                        {{$product->construction_site}}

                                    @endif

                                </td>

                                <td>

                                    @if (isset($product->service_name))

                                        {{$product->service_name}}

                                    @endif

                                </td>

                                <td>

                                    @if (isset($product->product_name))

                                    {{$product->product_name}}

                                @endif

                                </td>

                                <td>

                                    @if (isset($cart->price))

                                        {{$cart->price}}

                                    @endif

                                </td>



                                <td>



                                </td>

                                <td>{{$cart->quantity}} </td>

                                <td>

                                    @php

                                        $subtotal = $subtotal + ($cart->quantity * $cart->price)

                                    @endphp



                                    &#165; {{$cart->quantity * $cart->price }} </td>

                            </tr>

                            @endforeach

                        </tbody>

                        <tfoot>

                            <tr>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td colspan="2">小計</td>

                                <td></td>

                                <td>&#165; {{$subtotal}}</td>

                            </tr>

                            <tr>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td colspan="2">諸経費</td>

                                <td></td>

                                <td>&#165; {{$order->expenses}}</td>

                            </tr>

                            <tr>

                                <td></td>

                                <td>ご紹介値引き</td>

                                <td></td>

                                <td colspan="2"> <span class="text-danger">値引き</span></td>

                                <td><span class="text-danger">&#916;</span></td>

                                <td>&#165; {{$order->discount}}</td>

                            </tr>

                            <tr>

                                <td></td>

                                <td></td>

                                <td></td>

                                <td colspan="2">消費税</td>

                                <td>10%</td>

                                @php
                                $roundfigure = ($subtotal + $order->expenses) - $order->discount;


                                  $vat =  ($roundfigure * 10)/100;

                                  $total = $vat + $roundfigure;

                                @endphp

                                <td>&#165; {{$vat }}</td>

                            </tr>

                            <tr>

                                <td colspan="6" class="text-center">合　　　　　　　　　　　　　計</td>



                                <td>&#165; {{$total}} <input id="itotal" value="{{$total}}" type="hidden"></td>

                            </tr>

                        </tfoot>

                    </table>



                </div>

            </div>

        </div>

    </div>



    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>



    <script>

        $(document).ready(function(){

            var abc = $("#itotal").val();

            $("#vtotal").html(abc);

        })

    </script>

  </body>

</html>
