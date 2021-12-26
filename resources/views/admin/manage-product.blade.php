@extends('admin/layout')
@section('title', 'Manage Product page')
@section('product_active', 'active')



@section('content')
    <div class="row">
        <form action="{{ route('product.product_process') }}" class="w-100" method="post"
            enctype="multipart/form-data">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header">
                        <div class="table-data__tool m-0">
                            <div class="table-data__tool-left">
                                <h2 class="title-4 ">Manage Product</h2>
                            </div>
                            <div class="table-data__tool-right">
                                <a href="{{url('/admin/product')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        <i class="zmdi zmdi-chevron-left"></i>&nbsp;Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">


                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}" />


                        <div class="form-group">
                            <label for="name" class="control-label mb-1">Product Name</label>
                            <input id="name" name="name" type="text" value="{{ $name }}" class="form-control"
                                required>
                            @error('name')
                                <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="slug" class="control-label mb-1">Product Slug</label>
                            <input id="slug" name="slug" type="text" value="{{ $slug }}" class="form-control"
                                required>
                            @error('slug')
                                <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="category_id" class="control-label mb-1">Select Category</label>
                                    <select name="category_id" class="form-control" id="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach ($category as $list)
                                            @if ($list->id == $category_id)
                                                <option selected value="{{ $category_id }}">{{ $list->category_name }}
                                                </option>
                                            @else
                                                <option value="{{ $list->id }}">{{ $list->category_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">Error</span>
                                            {{ $message }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="brand" class="control-label mb-1">Select Brand</label>
                                    <select name="brand_id" class="form-control" id="brand" required>
                                        <option value="">Select Brand</option>
                                        @foreach ($brand as $list)
                                            @if ($list->id == $brand_id)
                                                <option selected value="{{ $list->id }}">{{ $list->brand }}</option>
                                            @else
                                                <option value="{{ $list->id }}">{{ $list->brand }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('brand')
                                        <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">Error</span>
                                            {{ $message }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="model" class="control-label mb-1">Product Model</label>
                                    <input id="model" name="model" type="text" value="{{ $model }}"
                                        class="form-control" required>
                                    @error('model')
                                        <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                                            <span class="badge badge-pill badge-danger">Error</span>
                                            {{ $message }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="control-label mb-1">Product image</label>
                            <input id="image" name="image" type="file" class="form-control">
                            @if($image != '')
                                <img src="/upload/media/product/{{$image}}" width="100px" alt="">
                            @endif
                            @error('image')
                                <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label for="model" class="control-label mb-1">Product Model</label>
                            <input id="model" name="model" type="text"  value="{{$model}}" class="form-control"
                            required>
                            @error('model')
                            <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                                <span class="badge badge-pill badge-danger">Error</span>
                                {{$message}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            @enderror
                        </div> --}}

                        <div class="form-group">
                            <label for="short_desc" class="control-label mb-1">Product Short Description</label>
                            <textarea name="short_desc" class="form-control" id="short_desc"
                                rows="3">{{ $short_desc }}</textarea>
                            @error('short_desc')
                                <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description" class="control-label mb-1">Product Description</label>
                            <textarea name="description" class="form-control" id="description"
                                rows="6">{{ $description }}</textarea>
                            @error('description')
                                <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="keywords" class="control-label mb-1">Product Keywords</label>
                            <textarea name="keywords" class="form-control" required id="keywords"
                                rows="6">{{ $keywords }}</textarea>
                            @error('keywords')
                                <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="technical_specification" class="control-label mb-1">Product Technical
                                Specifications</label>
                            <textarea name="technical_specification" class="form-control"
                                id="technical_specification" rows="6">{{ $technical_specification }}</textarea>
                            @error('technical_specification')
                                <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="uses" class="control-label mb-1">Product Uses</label>
                            <textarea name="uses" class="form-control" id="uses"
                                rows="6">{{ $uses }}</textarea>
                            @error('uses')
                                <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="warranty" class="control-label mb-1">Product Warranty</label>
                            <textarea name="warranty" class="form-control" required id="warranty"
                                rows="6">{{ $warranty }}</textarea>
                            @error('warranty')
                                <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="lead_time" class="control-label mb-1">Lead Time</label>
                                    <input id="lead_time" name="lead_time" type="text" value="{{$lead_time }}" class="form-control">
                                    
                                </div>
                                <div class="col-md-4">
                                    <label for="tax_id" class="control-label mb-1">Tax</label>
                                    <select name="tax_id" class="form-control" id="tax_id" required>
                                        <option value="">Select Tax</option>
                                        @foreach ($tax as $list)
                                            @if ($list->id == $tax_id)
                                                <option selected value="{{ $list->id }}">{{ $list->tax_desc }}</option>
                                            @else
                                                <option value="{{ $list->id }}">{{ $list->tax_desc }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="is_promo" class="control-label mb-1">Is Promo</label>
                                    <select name="is_promo" id="is_promo" class="form-control">
                                        @if($is_promo == 1)
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        @else
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                
                                <div class="col-md-4">
                                    <label for="is_featured" class="control-label mb-1">Is Featured</label>
                                    <select name="is_featured" id="is_featured" class="form-control">
                                        @if($is_featured == 1)
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        @else
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="is_discounted" class="control-label mb-1">Is Discounted</label>
                                    <select name="is_discounted" id="is_discounted" class="form-control">
                                        @if($is_discounted == 1)
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        @else
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="is_trending" class="control-label mb-1">Is Trending</label>
                                    <select name="is_trending" id="is_trending" class="form-control">
                                        @if($is_trending == 1)
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        @else
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-data__tool m-0">
                    <div class="table-data__tool-left">
                        <h2 class="title-5 mb-3">Product Attribute</h2>
                    </div>
                </div>
            </div>
            @if(session('msg'))
                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                    <span class="badge badge-pill badge-success">Success</span>
                    {{session('msg')}}  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            @if(session('skuerror'))
                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger">Error</span>
                    {{session('skuerror')}}  
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            @error('image_attr.*')
                <div class="sufee-alert alert my-2 with-close alert-danger alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger">Error</span>
                        {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @enderror
            <div class="col-lg-12" id="product_attr">
                <?php   
                    $loop_count = 1;
                ?>
                @foreach($productattrArr as $key => $value)
                     
                    <?php
                        $typeArr = (array)$value; 
                        // echo '<pre>';
                        // print_r($typeArr);
                        // die();
                    ?>

                    <div class="card" id="card_attr_{{$loop_count++}}">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <input type="hidden" name="pattr_id[]" id="pattr_id" value="{{$typeArr['id']}}" />
                                    <div class="col-md-3">
                                        <label for="sku" class="control-label mb-1">SKU</label>
                                        <input id="sku" value="{{$typeArr['sku']}}" name="sku[]" type="text" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="price" class="control-label mb-1">Price</label>
                                        <input id="price" value="{{$typeArr['price']}}" name="price[]" type="text" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="mrp" class="control-label mb-1">MRP</label>
                                        <input id="mrp" value="{{$typeArr['mrp']}}" name="mrp[]" type="text" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="qty" class="control-label mb-1">Quantity</label>
                                        <input id="qty" value="{{$typeArr['qty']}}" name="qty[]" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="size" class="control-label mb-1">Size</label>
                                        <select name="size[]" class="form-control" id="size">
                                            <option value="">Select </option>
                                            @foreach ($sizes as $list)
                                                @if($list->id == $typeArr['size_id'])
                                                    <option selected value="{{ $list->id }}">{{ $list->size }}</option>
                                                @else   
                                                    <option value="{{ $list->id }}">{{ $list->size }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="color" class="control-label mb-1">Color</label>
                                        <select name="color[]" class="form-control" id="color">
                                            <option value="">Select </option>
                                            @foreach ($colors as $list)
                                                @if($list->id == $typeArr['color_id'])
                                                    <option selected value="{{ $list->id }}">{{ $list->color }}</option>
                                                @else   
                                                    <option value="{{ $list->id }}">{{ $list->color }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="image_attr" class="control-label mb-1">Image</label>
                                        <input id="image_attr" name="image_attr[]" type="file" class="form-control" {{$typeArr['image_attr'] == '' ? 'required' : ''}}>
                                        <img src="/upload/media/product/{{$typeArr['image_attr'] == '' ? 'no-image.png' : $typeArr['image_attr']}}" style="max-height: 100px;" />
                                    </div>
                                    <div class="col-md-3 d-block mt-4">
                                        @if($loop_count == 2)
                                            <a href="javascript:void(0)" class="btn btn-lg btn-primary btn-block text-white"
                                            onclick="add_attr()">
                                                <i class="fas fa-plus"></i>&nbsp;Add
                                            </a>
                                        @else
                                            <a href="/admin/product/manage-product/product_attr_delete/{{$typeArr['id']}}" class="btn btn-lg btn-danger btn-block text-white"
                                            >
                                                <i class="fas fa-minus"></i>&nbsp;Remove
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            <div class="col-lg-12">
                <div class="table-data__tool m-0">
                    <div class="table-data__tool-left">
                        <h2 class="title-5 mb-3">Product Images</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-12" id="product_image">
                <?php   
                    $loop_image_count = 1;
                ?>
                @foreach($productimgArr as $key => $value)
               
                     
                    <?php
                        $pimageArr = (array)$value; 
                        // echo '<pre>';    
                        // print_r($typeArr);
                        // die();
                    ?>
                      

                    <div class="card" id="product_image_{{$loop_image_count++}}">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <input type="hidden" name="pimage_id[]" id="pimage_id" value="{{$pimageArr['id']}}" />

                                    <div class="col-md-3">
                                        <label for="pro_image" class="control-label mb-1">Image</label>
                                        <input id="pro_image" name="pro_image[]" type="file" class="form-control" >
                                    </div>
                                    <div class="col-md-6">
                                        <img src="/upload/media/product/{{$pimageArr['image'] == '' ? 'no-image.png' : $pimageArr['image']}}" style="max-height: 100px;" />
                                    </div>
                                    <div class="col-md-3 d-block mt-4">
                                        @if($loop_image_count == 2)
                                            <a href="javascript:void(0)" class="btn btn-lg btn-primary btn-block text-white" onclick="addimage_attr()">
                                                <i class="fas fa-plus"></i>&nbsp;Add
                                            </a>
                                        @else
                                            <a href="{{ asset('/admin/product/manage-product/product_image_delete/'.$pimageArr['id']) }}" class="btn btn-lg btn-danger btn-block text-white"
                                            >
                                                <i class="fas fa-minus"></i>&nbsp;Remove
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>



            <div class="col-lg-12">
                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                    Submit
                </button>
            </div>
            <br><br>
        </form>
    </div>

    <script>
        let loop_count = 1;

        function add_attr() {
            loop_count++;
            var html = '<input type="hidden" name="pattr_id[]" id="pattr_id" /><div class="card" id="card_attr_' + loop_count +
                '"><div class="card-body"><div class="form-group"><div class="row">';

            html +=
                '<div class="col-md-3"><label for="sku" class="control-label mb-1">SKU</label><input id="sku" name="sku[]" type="text" class="form-control" required></div>';

            html +=
                '<div class="col-md-3"><label for="price" class="control-label mb-1">Price</label><input id="price" name="price[]" type="text" class="form-control" required></div>';

            html +=
                '<div class="col-md-3"><label for="mrp" class="control-label mb-1">MRP</label><input id="mrp" name="mrp[]" type="text" class="form-control" required></div>';

            html +=
                '<div class="col-md-3"><label for="qty" class="control-label mb-1">Quantity</label><input id="qty" name="qty[]" type="text" class="form-control" required></div>';

            var htmlSize = jQuery('#size').html();
            htmlSize = htmlSize.replace('selected','');
            html +=
                '<div class="col-md-3"><label for="size" class="control-label mb-1">Size</label><select name="size[]" class="form-control" id="size">' +
                htmlSize + '</select></div>';

            var htmlColor = jQuery('#color').html();
            htmlColor = htmlColor.replace('selected','');
            html +=
                '<div class="col-md-3"><label for="color" class="control-label mb-1">Color</label><select name="color[]" class="form-control" id="color">' +
                htmlColor + '</select></div>';


            html +=
                '<div class="col-md-3"><label for="image_attr" class="control-label mb-1">Image</label><input id="image_attr" name="image_attr[]" type="file" class="form-control" required></div>';


            html +=
                '<div class="col-md-3 d-block mt-4"><a href="javascript:void(0)" class="btn btn-lg btn-danger btn-block text-white" onclick=remove_attr("'+
                loop_count +'")><i class="fas fa-minus"></i>&nbsp;Remove</a></div>';

            html += '</div></div></div></div>';

            jQuery('#product_attr').append(html);
        }

        function remove_attr(param) {
            jQuery('#card_attr_'+param).remove();
        }



        let loop_image_count = 1;
        
        function addimage_attr(){
            loop_image_count++;
            var html = '<div class="card" id="product_image_'+loop_image_count+'"><div class="card-body"><div class="form-group"><div class="row"><input type="hidden" name="pimage_id[]" id="pimage_id"  />';

            html += '<div class="col-md-3"><label for="pro_image" class="control-label mb-1">Image</label><input id="pro_image" name="pro_image[]" type="file" class="form-control" required></div>';

            html += '<div class="col-md-6"><img src="/upload/media/product/no-image.png" style="max-height: 100px;" /></div>';

            html +=
                '<div class="col-md-3 d-block mt-4"><a href="javascript:void(0)" class="btn btn-lg btn-danger btn-block text-white" onclick=removeimage_attr("'+loop_image_count+'")><i class="fas fa-minus"></i>&nbsp;Remove</a></div>';

            html += '</div></div></div></div>';

            jQuery('#product_image').append(html);
            
        }

        function removeimage_attr(param){
            jQuery('#product_image_'+param).remove();
        }

        ClassicEditor.create( document.querySelector('#technical_specification')).catch(error => {
            console.error(error);
        });

        ClassicEditor.create( document.querySelector('#short_desc')).catch(error => {
            console.error(error);
        });
        
        ClassicEditor.create( document.querySelector('#description')).catch(error => {
            console.error(error);
        });

        ClassicEditor.create( document.querySelector('#uses')).catch(error => {
            console.error(error);
        });
    </script>


@endsection
