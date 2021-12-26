@extends('front.layout')
@section('title','Daily Shopping | Register and Login Page')
@section('content')
 
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    <img src="{{ asset('front_asset/img/fashion/fashion-header-bg-8.jpg')}}" alt="fashion img">
    <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Account Page</h2>
        <ol class="breadcrumb">
          <li><a href="{{url('/')}}">Home</a></li>                   
          <li class="active">Account</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">           
            <div class="row">
              <div class="col-md-6">
                <div class="aa-myaccount-login">
                <h4>Login</h4>
                <div id="login_done"></div>
                 <form id="frmLogin" class="aa-login-form" autocomplete="off">
                   @csrf
                  <label for="">Email address<span>*</span></label>
                   <input type="text" name="lemail" placeholder="Email ">
                   <div id="lemail_error" class="error_field"></div>
                   <label for="">Password<span>*</span></label>
                    <input type="password" name="lpass" placeholder="Password">
                    <div id="lpass_error" class="error_field"></div>
                    <button type="button" id="frmLoginBtn" class="aa-browse-btn">Login</button>
                    <label class="rememberme" for="rememberme"><input type="checkbox" name="rememberme" id="rememberme"> Remember me </label>
                    <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
                  </form>
                </div>
              </div>
              <div class="col-md-6">
                <div class="aa-myaccount-register">                 
                 <h4>Register</h4>
                 <div id="reg_done"></div>
                 <form id="frmRegistration" class="aa-login-form">
                   @csrf
                    <label for="">Name<span>*</span></label>
                    <input type="text" name="name" placeholder="Enter your name">
                    <div id="name_error" class="error_field"></div>
                    <label for="">email<span>*</span></label>
                    <input type="email" name="email" placeholder="Enter your email address">
                    <div id="email_error" class="error_field"></div>
                    <label for="">Mobile<span>*</span></label>
                    <input type="number" name="mobile" placeholder="Enter your mobile number">
                    <div id="mobile_error" class="error_field"></div>
                    <label for="">Country<span>*</span></label>
                    <select id="country" name="country" class="form-select">
                      <option value="null">Select Country</option>
                      @foreach($country as $list)
                      <option value="{{ $list->id}}">{{ $list->name}}</option>
                      @endforeach
                    </select>
                    <div id="country_error" class="error_field"></div>
                    <label for="">State<span>*</span></label>
                    <select id="states" name="state" class="form-select">
                      <option>Select State</option>
                    </select>
                    <div id="state_error" class="error_field"></div>
                    <label for="">City<span>*</span></label>
                    <select id="cities" name="city" class="form-select">
                      <option>Select City</option>
                    </select>
                    <div id="city_error" class="error_field"></div>
                    <label for="">Zip Code<span>*</span></label>
                    <input type="number" name="zip" placeholder="Enter your Postal code">
                    <div id="zip_error" class="error_field"></div>
                    <label for="">Address<span>*</span></label>
                    <textarea name="address"></textarea>
                    <div id="address_error" class="error_field"></div>
                    <label for="">Company</label>
                    <input type="text" name="company" >
                    <label for="">GSTIN</label>
                    <input type="text" name="gstin" >
                    <br>
                    <label for="">Password</label>
                    <input type="password" name="pwd" placeholder="Password">
                    <label for="">Confirm Password</label>
                    <input type="password" name="cpwd" placeholder="Confirm Password">
                    <div id="errorpwd" class="error_field"></div>
                    <button type="button" id="frmRegistrationBtn" class="aa-browse-btn">Register</button>                    
                  </form>
                </div>
              </div>
            </div>          
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