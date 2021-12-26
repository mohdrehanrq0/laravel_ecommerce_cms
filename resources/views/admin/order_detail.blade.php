@extends('admin/layout')
@section('title','Orders Detail')
@section('order_active','active')




@section('content')
    {{-- s<h1>Category</h1> --}}
    @if(session('msg'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        <span class="badge badge-pill badge-success">Success</span>
        {{session('msg')}}  
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif
    <div class="table-data__tool">
        <div class="table-data__tool-left">
            <h2 class="title-4 ">Orders Detail </h2>
        </div>
        
    </div>
    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="row" style="padding: 20px;background:white;">
                <div class="col-md-12">
                    <label for="updateStatus">Update Order Status</label>
                    <select name="updateStatus" id="updateStatus" class="form-control" style="margin-bottom: 30px;">
                        <option value="">Select Status</option>
                        @php
                            foreach($orderStatus as $list){
                                if($order_details[0]->order_status == $list){
                                    echo '<option value="'.$list.'" selected>'.$list.'</option>';
                                }else{
                                    echo '<option value="'.$list.'">'.$list.'</option>';
                                }
                            }
                        @endphp
                    </select>
                    <label for="updatepayStatus">Update Payment Status</label>
                    <select name="updatepayStatus" id="updatepayStatus" class="form-control" style="margin-bottom: 30px;">
                        <option value="">Select Status</option>
                        @php
                            foreach($paymentStatus as $list){
                                if($order_details[0]->payment_status == $list){
                                    echo '<option value="'.$list.'" selected>'.$list.'</option>';
                                }else{
                                    echo '<option value="'.$list.'">'.$list.'</option>';
                                }
                            }
                        @endphp
                    </select>
                    <hr>
                    <form method="POST">
                        <textarea name="track_detail" id="track_detail" rows="5" placeholder="Please enter a track detail.." class="form-control">{{$order_details[0]->track_detail}}</textarea>
                        <input type="submit" class="btn btn-success" value="Update" style="margin-top:15px;">
                        @csrf
                        <input type="hidden" id='orderId' name="orderId" value='{{$order_details[0]->id}}'>
                    </form>
                </div>
            </div>
            <div class="row" style="padding: 30px;">
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
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
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
                           <td><img src="{{asset('upload/media/product/'.$list->image_attr)}}" height="120px" width="120px" /></td>
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
            <input type="hidden" id='orderID' value='{{$order_details[0]->id}}'>
            <!-- END DATA TABLE-->
        </div>
    </div>
@endsection