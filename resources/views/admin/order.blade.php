@extends('admin/layout')
@section('title','Orders')
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
            <h2 class="title-4 ">Orders</h2>
        </div>
        
    </div>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Customer Details</th>
                            <th>Order Status</th>
                            <th>Payment Status</th>
                            <th>Payment Type</th>
                            <th>Added on</th>
                        </tr>
                    </thead>
                    <tbody>
               
                        @foreach ($order as $list)
                                                       
                                <tr>
                                    <td><a href="{{url('admin/order_detail/'.$list->id)}}" class="btn btn-primary">View</a></td>
                                    
                                    <td>{{$list->id}}</td>
                                    <td>{{$list->name}}</td>
                                    <td>{{$list->order_status}}</td>
                                    <td>{{$list->payment_status}}</td>
                                    <td>{{$list->payment_type}}</td>
                                    <td>{{$list->added_on}}</td>
                                                                       
                                </tr>
                        @endforeach
                    
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
@endsection