@extends('front.layout')
@section('title','Daily Shopping | Order Page')
@section('content')
 
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12" style="text-align: center;">
        <br><br>
                <h1 style="text-align: center;color:#ff6666;font-weight:600;">Your Order is placed successfully.Your Order ID is {{$order_id}}</h1>
        <br><br>
       </div>
     </div>
   </div>
 </section>

@endsection