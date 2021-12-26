@extends('front.layout')
@section('title','Daily Shopping | Forgot Password Page')
@section('content')
 
 
 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">           
            <div class="row">
              <div class="col-md-6">
                <div class="aa-myaccount-login">
                <h4>Reset your password</h4>
                <div id="pass_change"></div>
                 <form id="updatePass" class="aa-login-form" autocomplete="off">
                   @csrf
                    <label for="">Enter your new password<span>*</span></label>
                   <input type="password" name="npass" placeholder="Type your new password ">
                   <label for="">Retype your new password<span>*</span></label>
                    <input type="password" name="ncpass" placeholder="Retype your new password ">
                    <button type="button" id="updatePassBtn" class="aa-browse-btn">Update password</button>
                    <br><br><br><br>
                    <div id="msg_error" class="error_field"></div>
                  </form>
                </div>
              </div>
            
            </div>          
         </div>
       </div>
     </div>
   </div>
 </section>

@endsection