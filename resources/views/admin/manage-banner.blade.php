@extends('admin/layout')
@section('title','Manage Banner page')
@section('banner_active','active')



@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-header">
                <div class="table-data__tool m-0">
                    <div class="table-data__tool-left">
                        <h2 class="title-4 ">Manage Banner</h2>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{url('/admin/banner')}}"><button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-chevron-left"></i>&nbsp;Back</button></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
              
                
                <form action="{{route('banner.banner_process')}}" method="post" enctype="multipart/form-data">
                    @csrf  
                    <input type="hidden" name="id" value="{{$id}}" />
                    <div class="form-group">
                        <label for="title" class="control-label mb-1">Title</label>
                        <input id="title" name="title" type="text" value="{{$title}}" class="form-control" required>
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
                        <label for="description" class="control-label mb-1">Description</label>
                        <input id="description" name="description" type="text" value="{{$description}}" class="form-control" required>
                        @error('description')
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
                        <label for="image" class="control-label mb-1">Banner Image</label>
                        <input id="image" name="image" type="file" class="form-control" {{$image=='' ? 'required' : ''}}>
                        @error('image')
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
                        <label for="btn_text" class="control-label mb-1">Button Text</label>
                        <input id="btn_text" name="btn_text" type="text" value="{{$btn_text}}" class="form-control" required>
                        @error('btn_text')
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
                        <label for="btn_link" class="control-label mb-1">Button Link</label>
                        <input id="btn_link" name="btn_link" type="text" value="{{$btn_link}}" class="form-control" required>
                        @error('btn_link')  
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