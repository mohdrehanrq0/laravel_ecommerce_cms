@extends('admin/layout')
@section('title','Manage coupon page')
@section('coupon_active','active')



@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-header">
                <div class="table-data__tool m-0">
                    <div class="table-data__tool-left">
                        <h2 class="title-4 ">Manage Coupon</h2>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ url('/admin/coupon')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-chevron-left"></i>&nbsp;Back</button></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
              
                
                <form action="{{route('coupon.coupon_process')}}" method="post" >
                    @csrf  
                    <input type="hidden" name="id" value="{{$id}}" />
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="title" class="control-label mb-1">Title</label>
                                <input id="title" name="title" type="text" value="{{$title}}" class="form-control" required>
                                @error('title')
                                    <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{$message}}  
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="code" class="control-label mb-1">Code</label>
                                <input id="code" name="code" value="{{$code}}" type="text" class="form-control" required>
                                @error('code')
                                    <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{$message}}  
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
               
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="value" class="control-label mb-1">Value</label>
                                <input id="value" name="value" value="{{$value}}" type="text" class="form-control" required>
                                @error('value')
                                    <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{$message}}  
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="type" class="control-label mb-1">Type</label>
                                    <select name="type" id="type" class="form-control">
                                        @if($type == 'value')
                                            <option>Select</option>
                                            <option value="value" selected>Value</option>
                                            <option value="percentage">Percentage</option>
                                        @elseif($type == 'percentage')
                                            <option>Select</option>
                                            <option value="value">Value</option>
                                            <option value="percentage" selected>Percentage</option>
                                        @else
                                            <option>Select</option>
                                            <option value="value">Value</option>
                                            <option value="percentage" >Percentage</option>

                                        @endif
                                    </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="min_order_amount" class="control-label mb-1">Min Order Amount</label>
                                <input id="min_order_amount" name="min_order_amount" value="{{$min_order_amount}}" type="text" class="form-control" required>
                                @error('min_order_amount')
                                    <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                                        <span class="badge badge-pill badge-danger">Error</span>
                                        {{$message}}  
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="is_one_time" class="control-label mb-1">Is one time</label>
                                    <select name="is_one_time" id="is_one_time" class="form-control">
                                        @if($is_one_time == 1)
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        @else
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>

                                        @endif
                                    </select>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection