@extends('admin/layout')
@section('title','Manage Brand page')
@section('brand_active','active')



@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-header">
                <div class="table-data__tool m-0">
                    <div class="table-data__tool-left">
                        <h2 class="title-4 ">Manage Brand</h2>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{url('/admin/brand')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-chevron-left"></i>&nbsp;Back</button></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
              
                
                <form action="{{route('brand.brand_process')}}" method="post" enctype="multipart/form-data">
                    @csrf  
                    <input type="hidden" name="id" value="{{$id}}" />
                    <div class="form-group">
                        <label for="brand" class="control-label mb-1">Brand</label>
                        <input id="brand" name="brand" type="text" value="{{$brand}}" class="form-control" required>
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
                    <div class="form-group">
                        <label for="brand_image" class="control-label mb-1">Brand Image</label>
                        <input id="brand_image" name="brand_image" type="file" class="form-control" {{$brand_image == '' ? 'required' : ''}}>
                        @error('brand_image')
                            <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Error</span>
                                {{$message}}  
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @enderror
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