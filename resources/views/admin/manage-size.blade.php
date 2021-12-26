@extends('admin/layout')
@section('title','Manage Size page')
@section('size_active','active')



@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-header">
                <div class="table-data__tool m-0">
                    <div class="table-data__tool-left">
                        <h2 class="title-4 ">Manage Size</h2>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{url('/admin/size')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-chevron-left"></i>&nbsp;Back</button></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
              
                
                <form action="{{route('size.size_process')}}" method="post" >
                    @csrf  
                    <input type="hidden" name="id" value="{{$id}}" />
                    <div class="form-group">
                        <label for="size" class="control-label mb-1">Size</label>
                        <input id="size" name="size" type="text" value="{{$size}}" class="form-control" required>
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