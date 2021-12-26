@extends('admin/layout')
@section('title','Brand')
@section('brand_active','active')




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
            <h2 class="title-4 ">Brand</h2>
        </div>
        <div class="table-data__tool-right">
            <a href="{{url('/admin/brand/manage-brand')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-plus"></i>add brand</button></a>
        </div>
    </div>
    <div class="row m-t-30">
        <div class="col-md-12 overflow-hidden">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless text-nowrap table-data3">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>ID</th>
                            <th>Brand</th>
                            <th>Brand Image</th>
                            <th>Show In Home</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
               
                        <?php
                         $data_count = $data->count();
                         ?>
                    @if ($data_count == 0) 
                        <tr>
                            <td colspan="4" class="text-center">No Data found</td>
                        </tr>

                    @else
                            <?php 
                                $sno = 1;
                            ?>
                        @foreach ($data as $list)
                                                       
                                <tr>
                                    <td><strong>{{$sno++}}</strong></td>
                                    <td>{{$list->id}}</td>
                                    <td>{{$list->brand}}</td>
                                    <td>
                                        @if ($list->brand_image != '')
                                            <img src="{{asset('/upload/brands/'.$list->brand_image)}}" alt="{{$list->brand}}" height="50" width="50"/>
                                        @else  
                                            <img src="{{asset('/upload/brands/no-image.png')}}" alt="{{$list->brand}}" height="50" width="50"/>
                                        @endif
                                    </td>
                                    <td>
                                        @if($list->is_home == 1)
                                            <p class="text-success">Show in Home</p>
                                        @else 
                                            <p class="text-danger">Don't Show in Home</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if($list->status == 0)
                                            <a href="{{ url('/admin/brand/status/1/'.$list->id)}}" class="btn btn-sm btn-primary">Active</a>
                                        @elseif($list->status == 1)
                                            <a href="{{ url('/admin/brand/status/0/'.$list->id)}}" class="btn btn-sm btn-warning">Deactive</a>
                                        @endif
                                        <a href="{{ url('/admin/brand/manage-brand/'.$list->id)}}" class="btn btn-sm btn-success">Edit</a>
                                        <a href="{{ url('/admin/brand/delete/'.$list->id)}}" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>
@endsection