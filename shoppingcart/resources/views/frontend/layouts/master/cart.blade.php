@extends('frontend.layouts.master')
@section('title')
<title>Cart</title>
@endsection
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url('{{asset('/frontend/images/bg_1.jpg')}}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
                <h1 class="mb-0 bread">My Cart</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-cart">
          <div class="container">
              <div class="row">
              <div class="col-md-12 ftco-animate">
                  <div class="cart-list">
                      <table class="table">
                          <thead class="thead-primary">
                            <tr class="text-center">
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>Product name</th>
                              <th>Price</th>
                              <th>Quantity</th>
                              <th>Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if (Session::has('cart'))
                                @foreach ($products as $product)
                                <tr class="text-center">
                                    <td class="product-remove"><a href="{{route('remove_from_cart',$product['product_id'])}}"><span class="ion-ios-close"></span></a></td>

                                    <td class="image-prod"><div class="img">
                                        <img src="{{!empty($product['image'])? url('/shoppingcart/public/upload/product_image/'.$product['image']):url('/shoppingcart/public/upload/noImage.jpg')}}" height="100px" width="130px" alt="Prduct Image">
                                    </div></td>

                                    <td class="product-name">
                                        <h3>{{$product['product_name']}}</h3>
                                        <p>Far far away, behind the word mountains, far from the countries</p>
                                    </td>

                                    <td class="price">${{$product['product_price']}}</td>
                                    <form action="{{route('update_qty',$product['product_id'])}}" method="POST">
                                        @csrf
                                        <td class="quantity">
                                            <div class="input-group mb-3">
                                            <input type="number" name="quantity" class="quantity form-control input-number" value="{{$product['qty']}}" min="1" max="100">
                                            </div>
                                            <input type="submit" class="btn btn-success" value="Validate">
                                        </td>
                                    </form>


                                    <td class="total">${{$product['qty']*$product['product_price']}}</td>
                                </tr><!-- END TR-->
                                @endforeach
                            @else
                                @if (Session::has('status'))
                                    <div class="alert alert-success">
                                          {{Session::get('status')}}
                                    </div>
                                @endif
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
              <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                  <div class="cart-total mb-3">
                      <h3>Coupon Code</h3>
                      <p>Enter your coupon code if you have one</p>
                        <form action="#" class="info">
                <div class="form-group">
                    <label for="">Coupon code</label>
                  <input type="text" class="form-control text-left px-3" placeholder="">
                </div>
              </form>
                  </div>
                  <p><a href="{{route('frontend.layouts.checkout')}}" class="btn btn-primary py-3 px-4">Apply Coupon</a></p>
              </div>
              <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                  <div class="cart-total mb-3">
                      <h3>Estimate shipping and tax</h3>
                      <p>Enter your destination to get a shipping estimate</p>
                        <form action="#" class="info">
                            <div class="form-group">
                                <label for="">Country</label>
                            <input type="text" class="form-control text-left px-3" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="country">State/Province</label>
                            <input type="text" class="form-control text-left px-3" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="country">Zip/Postal Code</label>
                            <input type="text" class="form-control text-left px-3" placeholder="">
                            </div>
                        </form>
                  </div>
                  <p><a href="{{route('frontend.layouts.checkout')}}" class="btn btn-primary py-3 px-4">Estimate</a></p>
              </div>
              <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                  <div class="cart-total mb-3">
                      <h3>Cart Totals</h3>
                      <p class="d-flex">
                          <span>Subtotal</span>
                          <span>$20.60</span>
                      </p>
                      <p class="d-flex">
                          <span>Delivery</span>
                          <span>$0.00</span>
                      </p>
                      <p class="d-flex">
                          <span>Discount</span>
                          <span>$3.00</span>
                      </p>
                      <hr>
                      <p class="d-flex total-price">
                          <span>Total</span>
                          <span>${{Session::has('cart')?Session::get('cart')->totalPrice:00}}</span>
                      </p>
                  </div>
                  <p><a href="{{route('frontend.layouts.checkout')}}" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
              </div>
          </div>
        </div>
    </section>


@endsection
