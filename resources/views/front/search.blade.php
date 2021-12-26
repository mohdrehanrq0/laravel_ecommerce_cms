@extends('front.layout')
@section('title', 'Daily Shopping | Category')
@section('body_class', 'productPage')
@section('content')
    <style type="text/css">
        #aa-product-category .aa-product-catg-content .aa-product-catg-body .aa-product-catg li{
            width: 22.8%;
        }
        #aa-product-category .aa-product-catg-content .aa-product-catg-body .aa-product-catg.list li{
            width: 100%;
        }
    </style>
    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <img src="{{ asset('front_asset/img/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">
                    <h2>Search Page</h2>
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Search Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- / catg header banner section -->

    <!-- product category -->
    <section id="aa-product-category">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 ">
                    <div class="aa-product-catg-content">
                        <div class="aa-product-catg-head">
                           
                            <div class="aa-product-catg-head-right">
                                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
                            </div>
                        </div>
                        <div class="aa-product-catg-body">
                            @if (isset($product[0]))
                                <ul class="aa-product-catg">
                                    <!-- start single product item -->
                                    @foreach ($product as $Arr)
                                    <li>
                                        <figure>
                                            <a class="aa-product-img" href="{{url('products/'.$Arr->slug)}}"><img src="{{asset('upload/media/product/'.$Arr->image)}}"
                                                    alt="polo shirt img"></a>
                                            <a class="aa-add-card-btn" href="javascipt:void(0)" onclick='home_addCart("{{$Arr->id}}","{{$product_attr[$Arr->id][0]->color}}","{{$product_attr[$Arr->id][0]->size}}")'><span class="fa fa-shopping-cart"></span>Add
                                                To Cart</a>
                                            <figcaption>
                                                <h4 class="aa-product-title"><a href="{{url('products/'.$Arr->slug)}}">{{$Arr->name}}</a></h4>
                                                <p class="aa-product-price">${{$product_attr[$Arr->id][0]->price}}<span
                                                    class="aa-product-price"><del>${{$product_attr[$Arr->id][0]->mrp}}</del></span>
                                                <p class="aa-product-descrip">{!! $Arr->short_desc !!}</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    @endforeach
                                </ul>
                            @else
                                <h2 class="text-center my-4">Oops ! No Product found for this Category</h2>
                            @endif
                        </div>

                    </div>
                </div>
                

            </div>
        </div>
    </section>
    <!-- / product category -->


    
    <input type="hidden" id="qty" value="1" /> 
    <form id="frm-cart" method="post">
      @csrf
      <input type="hidden" id="size_id_hidden" name="size_id_hidden"> 
      <input type="hidden" id="color_id_hidden" name="color_id_hidden"> 
      <input type="hidden" id="pqty" name="pqty"> 
      <input type="hidden" id="product_id" name="product_id"> 
  </form>

@endsection
