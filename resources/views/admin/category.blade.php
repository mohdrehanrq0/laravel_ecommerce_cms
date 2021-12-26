
<?php
use Illuminate\Support\Facades\DB; 

?>

@extends('admin/layout')
@section('title','Category page')
@section('category_active','active')


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
            <h2 class="title-4 ">Categories</h2>
        </div>
        <div class="table-data__tool-right">
            <a href="{{url('/admin/category/manage-categories')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-plus"></i>add category</button></a>
        </div>
    </div>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40 overflow-hidden">
                <table class="table table-borderless text-nowrap table-responsive table-data3">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Category Slug</th>
                            <th>Category Image</th>
                            <th>Parent Category</th>
                            <th>Show in Homepage</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
               
                        <?php
                         $data_count = $data->count();
                         ?>
                    @if ($data_count == 0) 
                        <tr>
                            <td colspan="5" class="text-center">No Data found</td>
                        </tr>

                    @else
                            <?php 
                                $sno = 1;
                            ?>
                        @foreach ($data as $list)
                                
                                <tr>
                                    <td><strong>{{$sno++}}</strong></td>
                                    <td>{{$list->id}}</td>
                                    <td>{{$list->category_name}}</td>
                                    <td>{{$list->category_slug}}</td>
                                    <td>
                                        @if($list->category_image  != '')
                                            <img src="{{ asset('/upload/media/category/'.$list->category_image) }}" alt="{{$list->category_image}}" width="50px">
                                        @else
                                            <img src="{{ asset('/upload/media/category/no-image.png')}}" alt="{{$list->category_image}}" width="50px">
                                        @endif
                                    </td>
                                    <td>
                                        @php  
                                            $parent = DB::table('categories')->where('id',$list->parent_category_id)->select('category_name')->first();
                                        @endphp
                                        @if ($parent != null)
                                            {{$parent->category_name}}
                                        @else
                                            <p class="text-danger">{{"No Parent Category Exist"}}</p>
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
                                            <a href="{{url('/admin/category/status/1/'.$list->id)}}" class="btn btn-sm btn-primary">Active</a>
                                        @elseif($list->status == 1)
                                            <a href="{{url('/admin/category/status/0/'.$list->id)}}" class="btn btn-sm btn-warning">Deactive</a>
                                        @endif
                                        <a href="{{url('/admin/category/manage-categories/'.$list->id)}}" class="btn btn-sm btn-success">Edit</a>
                                        <a href="{{url('/admin/category/delete/'.$list->id)}}" class="btn btn-sm btn-danger">Delete</a>
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