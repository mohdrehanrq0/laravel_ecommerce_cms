@extends('front.layout')
@section('title','Daily Shopping | Cart')
@section('content')

  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    <img src="{{ asset('front_asset/img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>Cart Page</h2>
         <ol class="breadcrumb">
           <li><a href="{{url('/')}}">Home</a></li>                   
           <li class="active">Cart</li>
         </ol>
       </div>
      </div>
    </div>
   </section>
   <!-- / catg header banner section -->
 
  <!-- Cart view section -->
  <section id="cart-view">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="cart-view-area">
            <div class="cart-view-table">
              <form action="">
                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>
                         <th></th>
                         <th></th>
                         <th>Product</th>
                         <th>Price</th>
                         <th>Quantity</th>
                         <th>Total</th>
                       </tr>
                     </thead>
                     <tbody>
                      @php
                          $subtotal = 0;
                      @endphp
                        @if(isset($list[0]))
                            @foreach($list as $pArr)
                                @php 
                                    $subtotal = $subtotal + ($pArr->price * $pArr->qty);
                                @endphp
                                <tr class="row-{{$pArr->attr_id}}">
                                    <td><a class="remove" href="javascript:void(0)" onclick='deleteQty("{{$pArr->pid}}","{{$pArr->attr_id}}","{{$pArr->size}}","{{$pArr->color}}")'><fa class="fa fa-close"></fa></a></td>
                                    <td><a href="{{url('products/'.$pArr->slug)}}" target="_blank"><img src="{{ asset('upload/media/product/'.$pArr->image)}}" alt="img"></a></td>
                                    <td><a class="aa-cart-title" href="{{url('products/'.$pArr->slug)}}" target="_blank">{{$pArr->name}}</a></td>
                                    <td>$ {{$pArr->price}}</td>
                                    <td><input class="aa-cart-quantity" id="qty{{$pArr->attr_id}}" min="1" type="number" value="{{$pArr->qty}}" onchange='changeQty("{{$pArr->pid}}","{{$pArr->attr_id}}","{{$pArr->size}}","{{$pArr->color}}","{{$pArr->price}}")'></td>
                                    <td id="total{{$pArr->attr_id}}">$ {{($pArr->price * $pArr->qty)}}</td>
                                </tr>
                            @endforeach
                       <tr> 
                         <td colspan="6" class="aa-cart-view-bottom">
                           <div class="aa-cart-coupon">
                             <input class="aa-coupon-code" type="text" placeholder="Coupon">
                             <input class="aa-cart-view-btn" type="button" value="Apply Coupon">
                           </div>
                           
                         </td>
                       </tr>
                       @else
                       <tr>
                           <td colspan="6" class="aa-cart-title">
                                <strong>Cart is Empty</strong> 
                           </td>
                       </tr>
                       @endif
                       </tbody>
                   </table>
                 </div>
              </form>
              <!-- Cart Total view -->
              <div class="cart-view-total">
                <h4>Cart Totals</h4>
                <table class="aa-totals-table">
                  <tbody>
                    <tr>
                      <th>Subtotal</th>
                      <td class="aa-subtotal">$ {{$subtotal}}</td>
                    </tr>
                    <tr>
                      <th>Total</th>
                      <td class="aa-total">$ {{$subtotal}}</td>
                    </tr>
                  </tbody>
                </table>
                <a href="#" class="aa-cart-view-btn">Proced to Checkout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Cart view section -->
 
 
  

   <input type="hidden" id="qty">
   <form id="frm-cart" method="post">
        @csrf
        <input type="hidden" id="size_id_hidden" name="size_id_hidden"> 
        <input type="hidden" id="color_id_hidden" name="color_id_hidden"> 
        <input type="hidden" id="pqty" name="pqty"> 
        <input type="hidden" id="product_id" name="product_id"> 
    </form>

@endsection
