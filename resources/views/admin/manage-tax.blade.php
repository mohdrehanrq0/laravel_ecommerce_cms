@extends('admin/layout')
@section('title','Manage Tax page')
@section('tax_active','active')



@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-header">
                <div class="table-data__tool m-0">
                    <div class="table-data__tool-left">
                        <h2 class="title-4 ">Manage Tax</h2>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{url('/admin/tax')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-chevron-left"></i>&nbsp;Back</button></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
              
                
                <form action="{{route('tax.tax_process')}}" method="post" >
                    @csrf  
                    <input type="hidden" name="id" value="{{$id}}" />
                    <div class="form-group">
                        <label for="tax_desc" class="control-label mb-1">Tax Description</label>
                        <input id="tax_desc" name="tax_desc" type="text" value="{{$tax_desc}}" class="form-control" required>
                       
                    </div>

                    <div class="form-group">
                        <label for="tax_value" class="control-label mb-1">Tax Value</label>
                        <input id="tax_value" name="tax_value" type="text" value="{{$tax_value}}" class="form-control" required>
                        @error('tax_value')
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