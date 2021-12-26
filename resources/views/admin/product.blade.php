@extends('admin/layout')
@section('title','Product')
@section('product_active','active')




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
            <h2 class="title-4 ">Product</h2>
        </div>
        <div class="table-data__tool-right">
            <a href="{{url('/admin/product/manage-product')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-plus"></i>add product</button></a>
        </div>
    </div>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3 text-nowrap">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Short Description</th>
                            <th>Description</th>
                            <th>Keywords</th>
                            <th>Technical Specification</th>
                            <th>Uses</th>
                            <th>Warranty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
               
                        <?php
                        use Illuminate\Support\Facades\DB;
                         $data_count = $data->count();
                         ?>
                    @if ($data_count == 0) 
                        <tr>
                            <td colspan="15" class="text-center">No Data found</td>
                        </tr>

                    @else
                            <?php 
                                $sno = 1;
                            ?>
                        @foreach ($data as $list)
                                <?php 
                                    $cat = DB::table('categories')->where(['id'=>$list->category_id])->get();
                                    $brand = DB::table('brands')->where(['id'=>$list->brand_id])->get();

                                    if (!empty($list->image)) {
                                        $image = $list->image;
                                    }else {
                                        $image = 'no-image.png';
                                    }
                                    
                                ?>
                                <tr>
                                    <td><strong>{{$sno++}}</strong></td>
                                    <td>{{$list->id}}</td>
                                    <td>{{$cat['0']->category_name}}</td>
                                    <td>{{$list->name}}</td>
                                    <td>{{$list->slug}}</td>
                                    <td><img src="{{ asset('/upload/media/product/'.$image)}}" height="50px" /></td>
                                    <td>{{$brand['0']->brand}}</td>
                                    <td>{{$list->model}}</td>
                                    <td class="short_desc">{{$list->short_desc}}</td>
                                    <td class="desc">{{$list->description}}</td>
                                    <td class="keywords">{{$list->keywords}}</td>
                                    <td class="technical_specification">{{$list->technical_specification}}</td>
                                    <td class="uses">{{$list->uses}}</td>
                                    <td>{{$list->warranty}}</td>
                                    <td>
                                        @if($list->status == 0)
                                            <a href="{{ url('/admin/product/status/1/'.$list->id) }}" class="btn btn-sm btn-primary">Active</a>
                                        @elseif($list->status == 1)
                                            <a href="{{ url('/admin/product/status/0/'.$list->id)}}" class="btn btn-sm btn-warning">Deactive</a>
                                        @endif
                                        <a href="{{ url('/admin/product/manage-product/'.$list->id)}}" class="btn btn-sm btn-success">Edit</a>
                                        <a href="{{ url('/admin/product/delete/'.$list->id)}}" class="btn btn-sm btn-danger">Delete</a>
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