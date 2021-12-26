@extends('admin/layout')
@section('title','Size')
@section('size_active','active')




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
            <h2 class="title-4 ">Size</h2>
        </div>
        <div class="table-data__tool-right">
            <a href="{{url('/admin/size/manage-size')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-plus"></i>add size</button></a>
        </div>
    </div>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>ID</th>
                            <th>Size</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
               
                        <?php
                         $data_count = $data->count();
                         ?>
                    @if ($data_count == 0) 
                        <tr>
                            <td colspan="6" class="text-center">No Data found</td>
                        </tr>

                    @else
                            <?php 
                                $sno = 1;
                            ?>
                        @foreach ($data as $list)
                                                       
                                <tr>
                                    <td><strong>{{$sno++}}</strong></td>
                                    <td>{{$list->id}}</td>
                                    <td>{{$list->size}}</td>
                                    <td>
                                        @if($list->status == 0)
                                            <a href="{{ url('/admin/size/status/1/'.$list->id)}}" class="btn btn-sm btn-primary">Active</a>
                                        @elseif($list->status == 1)
                                            <a href="{{ url('/admin/size/status/0/'.$list->id)}}" class="btn btn-sm btn-warning">Deactive</a>
                                        @endif
                                        <a href="{{ url('/admin/size/manage-size/'.$list->id)}}" class="btn btn-sm btn-success">Edit</a>
                                        <a href="{{ url('/admin/size/delete/'.$list->id)}}" class="btn btn-sm btn-danger">Delete</a>
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