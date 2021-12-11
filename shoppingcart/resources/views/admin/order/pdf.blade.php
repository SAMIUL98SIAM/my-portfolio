<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/frontend/css/style.css')}}">
    <title>Document</title>
</head>
<body>



                        <table class="table">
                            <thead class="thead">
                                <tr class="text-left">
                                    <th>Client Name : {{$name}}<br> Client Address : {{$address}} <br> Date : {{$created_at}}</th>
                                </tr>
                            </thead>
                        </table>
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>Image</th>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($orders as $order){
                                    @foreach($order->cart->items as $item){

                                                    <tr class="text-center">
                                                        <td class="image-prod"><img src="storage/product_images/'.$item['product_image'].'" alt="" style = "height: 80px; width: 80px;"></td>
                                                        <td class="product-name">
                                                            <h3>{{$item['product_name']}}</h3>
                                                        </td>
                                                        <td class="price">$ {{$item['product_price']}}</td>
                                                        <td class="qty">{{$item['qty']}}</td>
                                                        <td class="total">$ {{$item['product_price']*$item['qty']}}</td>
                                                    </tr><!-- END TR-->
                                </tbody>
                                    }

                                    @php
                                    $totalPrice = $order->cart->totalPrice;
                                    @endphp


                                }
                            </table>

                        <table class="table">
                            <thead class="thead">
                                <tr class="text-center">
                                        <th>Total</th>
                                        <th>$ {{$totalPrice}}</th>
                                </tr>
                            </thead>
                        </table>

</body>
</html>
