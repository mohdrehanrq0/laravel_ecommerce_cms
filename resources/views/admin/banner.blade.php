@extends('admin/layout')
@section('title','Banner')
@section('banner_active','active')




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
            <h2 class="title-4 ">Banner</h2>
        </div>
        <div class="table-data__tool-right">
            <a href="{{url('/admin/banner/manage-banner')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-plus"></i>add banner</button></a>
        </div>
    </div>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3 text-nowrap" >
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Banner Image</th>
                            <th>Button Text</th>
                            <th>Button Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
               
                        <?php
                         $data_count = $data->count();
                         ?>
                    @if ($data_count == 0) 
                        <tr>
                            <td colspan="8" class="text-center">No Data found</td>
                        </tr>

                    @else
                            <?php 
                                $sno = 1;
                            ?>
                        @foreach ($data as $list)
                                                       
                                <tr>
                                    <td><strong>{{$sno++}}</strong></td>
                                    <td>{{$list->id}}</td>
                                    <td>{{$list->title}}</td>
                                    <td>{{$list->description}}</td>
                                    <td>
                                        @if($list->image  != '')
                                            <img src="{{asset('/upload/media/banner/'.$list->image)}}" alt="{{$list->image}}" width="50px">
                                        @else
                                            <img src="{{asset('/upload/media/banner/no-image.png')}}" alt="{{$list->image}}" width="50px">
                                        @endif  
                                    </td>
                                    <td>{{$list->btn_text}}</td>
                                    <td>{{$list->btn_link}}</td>
                                    <td>
                                        @if($list->status == 0)
                                            <a href="{{url('/admin/banner/status/1/'.$list->id)}}" class="btn btn-sm btn-primary">Active</a>
                                        @elseif($list->status == 1)
                                            <a href="{{url('/admin/banner/status/0/'.$list->id)}}" class="btn btn-sm btn-warning">Deactive</a>
                                        @endif
                                        <a href="{{url('/admin/banner/manage-banner/'.$list->id)}}" class="btn btn-sm btn-success">Edit</a>
                                        <a href="{{url('/admin/banner/delete/'.$list->id)}}" class="btn btn-sm btn-danger">Delete</a>
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