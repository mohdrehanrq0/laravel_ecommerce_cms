@extends('admin/layout')
@section('title','Customer')
@section('customer_active','active')




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
    <div class="table-data__tool col-md-8">
        <div class="table-data__tool-left">
            <h2 class="title-4 ">Customer</h2>
        </div>
        <div class="table-data__tool-right">
            <a href="{{url('/admin/customer')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-chevron-left"></i>&nbsp;Back</button></a>
        </div>
        
    </div>
    <div class="row m-t-30">
        <div class="col-md-8">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Value</th>
                            
                        </tr>
                    </thead>
                    <tbody>                       
                        <tr>
                            <td><strong>Name</strong></td>
                            <td>{{$customer_list->name}}</td>   
                        </tr> 
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>{{$customer_list->email}}</td>   
                        </tr>
                        <tr>
                            <td><strong>Mobile</strong></td>
                            <td>{{$customer_list->mobile}}</td>   
                        </tr>
                        <tr>
                            <td><strong>Address</strong></td>
                            <td>{{$customer_list->address}}</td>   
                        </tr>
                        <tr>
                            <td><strong>City</strong></td>
                            <td>{{$customer_list->city}}</td>   
                        </tr>
                        <tr>
                            <td><strong>State</strong></td>
                            <td>{{$customer_list->state}}</td>   
                        </tr>
                        <tr>
                            <td><strong>Zip</strong></td>
                            <td>{{$customer_list->zip}}</td>   
                        </tr>
                        <tr>
                            <td><strong>Company</strong></td>
                            <td>{{$customer_list->company}}</td>   
                        </tr> 
                        <tr>
                            <td><strong>GST IN</strong></td>
                            <td>{{$customer_list->gstin}}</td>   
                        </tr> 
                        <tr>
                            <td><strong>Created At</strong></td>
                            <td>{{\Carbon\Carbon::parse($customer_list->created_at)->format('Y-m-d h:i')}}</td>    
                        </tr> 
                        <tr>
                            <td><strong>Updated At</strong></td>
                            <td>{{\Carbon\Carbon::parse($customer_list->updated_at)->format('Y-m-d h:i')}}</td>    
                        </tr> 
                                             
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
@endsection