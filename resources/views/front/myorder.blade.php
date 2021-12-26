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
            <div class="cart-view-table">
              <form action="">
                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>
                         <th></th>
                         <th>Order ID</th>
                         <th>Order Status</th>
                         <th>Payment Type</th>
                         <th>Payment Status</th>
                         <th>Payment ID</th>
                         <th>Total Amount</th>
                         <th>Coupon Value</th>
                         <th>Final Total</th>
                       </tr>
                     </thead>
                     <tbody>
                    @foreach ($order as $list)
                        <tr>
                          <td><a href="{{url('/order_detail/'.base64_encode($list->id))}}" class="aa-shop-now-btn aa-secondary-btn">View</a></td>
                          <td>{{$list->id}}</td>
                          <td>{{$list->order_status}}</td>
                          <td>{{$list->payment_type}}</td>
                          <td>{{$list->payment_status}}</td>
                          <td>{{$list->payment_id}}</td>
                          <td>{{$list->total_amt}}</td>
                          <td>{{$list->coupon_value}}</td>
                          <td>{{$list->coupon_total_amt}}</td>
                        </tr>
                    @endforeach
                    
                       </tbody>
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
