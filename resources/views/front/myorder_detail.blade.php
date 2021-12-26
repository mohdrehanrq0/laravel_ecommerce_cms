@extends('front.layout')
@section('title','Daily Shopping | My Order Page')
@section('content')

  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    <img src="{{ asset('front_asset/img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
       <div class="aa-catg-head-banner-content">
         <h2>Order Page</h2>
         <ol class="breadcrumb">
           <li><a href="{{url('/')}}">Home</a></li>                   
           <li class="active">Order</li>
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
            <div class="row" style="padding: 30px;padding-bottom:0px;">
                <div class="col-md-6">
                    <h2>{{$order_details[0]->name}}</h2>
                    <b style="line-height: 25px;">Mobile:</b> {{$order_details[0]->mobile}}<br/> 
                    <b style="line-height: 25px;">Email:</b> {{$order_details[0]->email}} <br/> 
                    <b style="line-height: 25px;">{{$order_details[0]->address}}  {{$order_details[0]->city}}</b><br/> 
                    <b style="line-height: 25px;">{{$order_details[0]->state}}</b><br/> 
                    <b style="line-height: 25px;">{{$order_details[0]->country}}, {{$order_details[0]->zip}}</b><br/> 
                </div>
                <div class="col-md-6">
                    <h3>Payment Details</h3>
                    <b style="line-height: 25px;">Payment Type:</b> {{$order_details[0]->payment_type}} <br/> 
                    <b style="line-height: 25px;">Payment status:</b> {{$order_details[0]->payment_status}} <br/> 
                    <b style="line-height: 25px;">Payment ID:</b> {{$order_details[0]->payment_id}} <br/> 
                    <b style="line-height: 25px;">Order Status:</b> {{$order_details[0]->order_status}} <br/> 
                    <b style="line-height: 25px;">Track Detail:</b> {{$order_details[0]->track_detail}} <br/>  

                </div>
            </div>
            <div class="cart-view-table">
              <form action="">
                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>
                         <th>Product Image</th>
                         <th>Product Name</th>
                         <th>Size</th>
                         <th>Color</th>
                         <th>Price</th>
                         <th>Quantity</th>
                         <th>Total Amount</th>
                       </tr>
                     </thead>
                     <tbody>
                         @php
                             $total = 0;
                         @endphp
                    @foreach ($order_details as $list)
                    @php
                        $total += $list->order_price * $list->order_qty; 
                    @endphp
                        <tr>
                          <td><img src="{{asset('upload/media/product/'.$list->image_attr)}}" /></td>
                          <td>{{$list->product_name}}</td>
                          <td>{{$list->size}}</td>
                          <td>{{$list->color}}</td>
                          <td>{{$list->order_price}}</td>
                          <td>{{$list->order_qty}}</td>
                          <td>{{$list->order_price * $list->order_qty}}</td>
                        </tr>
                    @endforeach
                    
                       </tbody>
                       <tfoot>
                        <tr>
                            <th colspan="4"></th>
                            <th colspan="2"><b>Total</b></th>
                            <th colspan="5" style="text-align:center;"> {{$total}}</th>
                        </tr>
                        <tr>
                            <th colspan="4"></th>
                            <th colspan="2"><b>Coupon Amount</b></th>
                            <th colspan="5" style="text-align:center;"> {{$order_details[0]->coupon_value}}</th>
                        </tr>
                           <tr>
                               <th colspan="4"></th>
                               <th colspan="2"><b>Final Total</b></th>
                               <th colspan="5" style="text-align:center;"> {{$total - $order_details[0]->coupon_value}}</th>
                           </tr>
                       </tfoot>
                   </table>
                 </div>
              </form>
              <!-- Cart Total view -->
              
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Cart view section -->
 
 
  

@endsection
