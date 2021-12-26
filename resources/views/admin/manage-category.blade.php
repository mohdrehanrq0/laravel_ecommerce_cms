@extends('admin/layout')
@section('title','manage category page')
@section('category_active','active')



@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-header">
                <div class="table-data__tool m-0">
                    <div class="table-data__tool-left">
                        <h2 class="title-4 ">Manage Categories</h2>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ url('/admin/category')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-chevron-left"></i>&nbsp;Back</button></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
              
                
                <form action="{{route('category.category_process')}}" method="post" enctype="multipart/form-data" >
                    @csrf  
                    <input type="hidden" name="id" value="{{$id}}" />
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="category_name" class="control-label mb-1">Category Name</label>
                                <input id="category_name" name="category_name" type="text" value="{{$cat_name}}" class="form-control" required>
                                @error('category_name')
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
                                <label for="category_slug" class="control-label mb-1">Category Slug</label>
                                <input id="category_slug" name="category_slug" value="{{$cat_slug}}" type="text" class="form-control" required>
                                @error('category_slug')
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
                                <label for="category_image" class="control-label mb-1">Category Image</label>
                                <input id="category_image" name="category_image" type="file" class="form-control" >
                                @if($category_image != '')
                                    <img src="{{ asset('upload/media/category/'.$category_image)}}" width="100px" alt="{{$category_image}}" />
                                @endif
                                @error('category_image')
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
                                <label for="parent_category_id" class="control-label mb-1">Parent Category</label>
                                <select name="parent_category_id" class="form-control" id="parent_category_id" required>
                                    <option value="0">Select Parent Category</option>
                                @foreach ($cat_table as $list)
                                    @if ($list->id == $parent_category_id)
                                        <option selected value="{{ $list->id }}">{{ $list->category_name }}</option>
                                    @else
                                        <option value="{{ $list->id }}">{{ $list->category_name }}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <label for="is_home" class="control-label mb-1">Show in homepage</label>
                                @if($is_home == 1) 
                                    <input type="checkbox" id="is_home" name="is_home" checked value="1" />
                                @else 
                                    <input type="checkbox" id="is_home" name="is_home" value="1" />
                                @endif
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