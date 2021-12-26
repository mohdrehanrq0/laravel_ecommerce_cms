@extends('front.layout')
@section('title', 'Daily Shopping | Category')
@section('body_class', 'productPage')
@section('content')

    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <img src="{{ asset('front_asset/img/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">
                    <h2>Fashion</h2>
                    <ol class="breadcrumb">
                        <li><a href="index.html">Home</a></li>
                        <li class="active">{{ $cat_name[0]->category_name }}</li>
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
                <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
                    <div class="aa-product-catg-content">
                        <div class="aa-product-catg-head">
                            <div class="aa-product-catg-head-left">
                                <form class="aa-sort-form">
                                    <label for="">Sort by</label>
                                    <select name="" onchange="sortBy()" id="sort_filter">
                                        <option>Default</option>
                                        <option value="name">Name</option>
                                        <option value="price_desc">Price - DESC</option>
                                        <option value="price_asc">Price - ASC</option>
                                        <option value="date">Date</option>
                                    </select>
                                </form>
                                <div class="sort_filter">
                                    @if($sort_txt!='')
                                        Sorted By: {{$sort_txt}}
                                    @endif
                                </div>
                            </div>
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
                <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
                    <aside class="aa-sidebar">
                        <!-- single sidebar -->
                        <div class="aa-sidebar-widget">
                            <h3>Category</h3>
                            <ul class="aa-catg-nav">
                                @foreach($left_cat as $cat)
                                    @if($slug == $cat->category_slug)
                                        <li><a href="{{url('category/'.$cat->category_slug)}}" class="active_cat">{{$cat->category_name}}</a></li>
                                    @else 
                                        <li><a href="{{url('category/'.$cat->category_slug)}}">{{$cat->category_name}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <!-- single sidebar -->
                        {{-- <div class="aa-sidebar-widget">
                            <h3>Tags</h3>
                            <div class="tag-cloud">
                                <a href="#">Fashion</a>
                                <a href="#">Ecommerce</a>
                                <a href="#">Shop</a>
                                <a href="#">Hand Bag</a>
                                <a href="#">Laptop</a>
                                <a href="#">Head Phone</a>
                                <a href="#">Pen Drive</a>
                            </div>
                        </div> --}}
                        <!-- single sidebar -->
                        <div class="aa-sidebar-widget">
                            <h3>Shop By Price</h3>
                            <!-- price range -->
                            <div class="aa-sidebar-price-range">
                                <form>
                                    <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                                    </div>
                                    <span id="skip-value-lower" class="example-val"></span>
                                    <span id="skip-value-upper" class="example-val">100.00</span>
                                    <button class="aa-filter-btn price_filter_btn" type="button">Filter</button>
                                </form>
                            </div>

                        </div>
                        
                        <!-- single sidebar -->
                        <div class="aa-sidebar-widget">
                            <h3>Shop By Color</h3>
                            <div class="aa-color-tag">
                                @foreach($colors as $color)
                                    @if(in_array($color->id,$colorFilterArr))
                                         <a class="aa-color-{{ $color->color}} active-color-filter" href="javascript:void(0)" onclick="setColor({{$color->id}},1)"></a>
                                    @else
                                        <a class="aa-color-{{ $color->color}}" href="javascript:void(0)" onclick="setColor({{$color->id}},0)"></a>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                    </aside>
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

  <form id="filter_form">
      <input type="hidden" name="sort" id="sort" value="{{$sort}}" />
      <input type="hidden" name="lower_val" id="lower_val" value="{{$lower_val}}" />
      <input type="hidden" name="upper_val" id="upper_val" value="{{$upper_val}}" />
      <input type="hidden" name="color_filter" id="color_filter" value="{{$color_filter}}" />
  </form>

@endsection
