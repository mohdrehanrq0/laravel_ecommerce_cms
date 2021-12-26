@extends('front.layout')
@section('title','Daily Shopping | Checkout Page')
@section('content')
 
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    <img src="{{ asset('front_asset/img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
    <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>CHECKOUT PAGE</h2>
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}">Home</a></li>                   
          <li class="active">Checkout</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

   <!-- Cart view section -->
 <section id="checkout">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
         <div class="checkout-area">
           <form id="frmCheckout">
             <div class="row">
               <div class="col-md-8">
                 <div class="checkout-left">
                   @if(session()->has('FRONT_LOGGEDIN') && session()->has('FRONT_USERID'))
                    <br><br>
                   @else
                    <input type="button" data-toggle="modal" data-target="#login-modal" value="Login" class="aa-browse-btn">
                    <br><br>
                    <p>OR</p>
                  @endif
                    <h3><b>Fill your detail here</b></h3>
                    <div class="row aa-login-form">
                      <div class="col-6">
                        <label for="">Name<span>*</span></label>
                        <input type="text" id="checkname" name="name" placeholder="Enter your name" value="{{$name}}" required>
                        <div id="error_name" class="error_field"></div>
                      </div>
                      <div class="col-6">
                        <label for="">Email<span>*</span></label>
                        <input type="email" id="checkemail" name="email" placeholder="Enter your email" value="{{$email}}" required>
                        <div id="error_email" class="error_field"></div>

                      </div>
                      <div class="col-6">
                        <label for="">Mobile<span>*</span></label>
                        <input type="number" id="checkmobile" name="mobile" placeholder="Enter your mobile number" value="{{ $mobile}}" required>
                        <div id="error_mobile" class="error_field"></div>
                      </div>
                      <div class="col-6">
                        <label for="">Country<span>*</span></label>
                        <select id="country" name="country" class="form-select" required>
                          <option value="0">Select Country</option>
                          @foreach($country as $list) 
                          <option value="{{ $list->id}}">{{ $list->name}}</option>
                          @endforeach
                        </select>
                        <div id="countryerror" class="error_field"></div>
                        <div id="error_country" class="error_field"></div>
                      </div>
                      <div class="col-6">
                        <label for="">State<span>*</span></label>
                        <select id="states" name="state" class="form-select" required>
                          <option value="0">Select State</option>
                        </select>
                        <div id="stateerror" class="error_field"></div>
                        <div id="error_state" class="error_field"></div>
                      </div>
                      <div class="col-6">
                        <label for="">City<span>*</span></label>
                        <select id="cities" name="city" class="form-select" required>
                          <option value="0">Select City</option>
                        </select>
                        <div id="cityerror" class="error_field"></div>
                        <div id="error_city" class="error_field"></div>
                      </div>
                      <div class="col-6">
                        <label for="">Zip Code<span>*</span></label>
                        <input type="number" id="checkzip" name="zip" placeholder="Enter your Postal code" value="{{$zip}}" required>
                        <div id="error_zip" class="error_field"></div>
                      </div>
                      <div class="col-6">
                        <label for="">Company</label>
                        <input type="text"  name="company" value="{{$company}}" required>
                      </div>
                      <div class="col-12">
                        <label for="">Address<span>*</span></label>
                        <textarea name="address" id="checkaddress" required>{{$address}}</textarea>
                        <div id="error_address" class="error_field"></div>
                      </div>
                    </div>
                 </div>
               </div>
               <div class="col-md-4">
                 <div class="checkout-right">
                   <h4>Order Summary</h4>
                   <div class="aa-order-summary-area">
                     <table class="table table-responsive">
                       <thead>
                         <tr>
                           <th>Product</th>
                           <th>Total</th>
                         </tr>
                       </thead>
                       <tbody>
                         @php
                             $subtotal = 0;
                         @endphp
                        @foreach($cart_list as $list)
                        @php
                            $subtotal += $list->qty*$list->price;
                        @endphp
                          <tr>
                            <td>{{$list->name}} <strong> x  {{$list->qty}}</strong><br><p class="cart_color">{{$list->color!=''?$list->color:''}}</p></td>
                            <td>${{$list->price}}</td>
                          </tr>
                         @endforeach
                       </tbody>
                       <tfoot>
                         <tr class="hide couponBox">
                           <td>Coupon &nbsp;<a href="javascript:void(0)" class="couponRemoveBtn"><i class="far fa-trash-alt"></i></a></td>
                           <td id="couponText"></td>
                         </tr>
                         <tr>
                           <th>Subtotal</th>
                           <td>${{$subtotal}}</td>
                         </tr>
                          <tr>
                           <th>Tax</th>
                           <td>$0</td>
                         </tr>
                          <tr>
                           <th>Total</th>
                           <td id="totalAmt">${{$subtotal}}</td>
                         </tr>
                       </tfoot>
                     </table>
                   </div>
                   <!-- Coupon section -->
                   <div class="panel panel-default aa-checkout-coupon">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                          Have a Coupon?
                        </a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                        <input type="text" placeholder="Coupon Code" name="couponInput" id="couponInput" class="aa-coupon-code">
                        <input type="button" value="Apply Coupon" id="CouponBtn" class="aa-browse-btn">
                        <div class="error_field" id="CouponError" style="margin-top:12px;"></div>
                      </div>
                    </div>
                  </div>
                   <h4>Payment Method</h4>
                   <div class="aa-payment-method">                    
                     <label for="cod"><input type="radio" id="cod" value="COD" name="payment_type" checked required> Cash on Delivery </label>
                     <label for="online"><input type="radio" id="online" name="payment_type" value='ONLINE' required> Via Instamojo </label>
                     <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" border="0" alt="PayPal Acceptance Mark">    
                     <input type="button" value="Place Order" id="frmCheckoutBtn" style="width:100%;" class="aa-browse-btn">                
                      <div id="checkout_error" class="error_field"></div>
                    </div>
                 </div>
               </div>
             </div>
             @csrf
            <input type="hidden" id="couponValhide" name="couponValhide">
           </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Cart view section -->

  @section('js_script')

  jQuery('#country').change(function(){
    jQuery('#cities').html('<option>Select City</option>');
     cid = jQuery(this).val();
     jQuery.ajax({
       url: '/statefinder',
       type: 'POST',
       data: 'cid='+cid+'&_token={{csrf_token()}}',
       success: function(result){
         jQuery('#states').html(result);
       }
 
     });
   });
   jQuery('#states').change(function(){
     sid = jQuery(this).val();
     jQuery.ajax({
       url: '/cityfinder',
       type: 'POST',
       data: 'sid='+sid+'&_token={{csrf_token()}}',
       success: function(result){
         jQuery('#cities').html(result)
       }
 
     });
   });
  @endsection

@endsection