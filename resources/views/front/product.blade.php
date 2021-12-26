@extends('front.layout')
@section('title', $product[0]->name . ' | Daily Shopping')

@section('content')
    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <img src="{{ asset('front_asset/img/fashion/fashion-header-bg-8.jpg') }}" alt="fashion img">
        <div class="aa-catg-head-banner-area">
            <div class="container">
                <div class="aa-catg-head-banner-content">
                    <h2>{{ $product[0]->name }}</h2>
                    <ol class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li><a href="#">Product</a></li>
                        <li class="active">{{ $product[0]->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- / catg header banner section -->

    <!-- product category -->
    <section id="aa-product-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-product-details-area">
                        <div class="aa-product-details-content">
                            <div class="row">
                                <!-- Modal view slider -->
                                <div class="col-md-5 col-sm-5 col-xs-12 ">
                                    <div class="aa-product-view-slider">
                                        <div id="demo-1" class="simpleLens-gallery-container">
                                            <div class="simpleLens-container">
                                                <div class="simpleLens-big-image-container"><a
                                                        data-lens-image="{{ asset('upload/media/product/' . $product[0]->image) }}"
                                                        class="simpleLens-lens-image"><img
                                                            src="{{ asset('upload/media/product/' . $product[0]->image) }}"
                                                            class="simpleLens-big-image"></a></div>
                                            </div>
                                            <div class="simpleLens-thumbnails-container">
                                                <a data-big-image="{{ asset('upload/media/product/' . $product[0]->image) }}"
                                                    data-lens-image="{{ asset('upload/media/product/' . $product[0]->image) }}"
                                                    class="simpleLens-thumbnail-wrapper" href="javascript:void(0)">
                                                    <img src="{{ asset('upload/media/product/' . $product[0]->image) }}"
                                                        width="50px">
                                                </a>

                                                @foreach ($product_arr[$product[0]->id] as $arr)
                                                    @if ($arr->image_attr != '')
                                                        <a data-big-image="{{ asset('upload/media/product/' . $arr->image_attr) }}"
                                                            data-lens-image="{{ asset('upload/media/product/' . $arr->image_attr) }}"
                                                            class="simpleLens-thumbnail-wrapper" href="javascript:void(0)">
                                                            <img src="{{ asset('upload/media/product/' . $arr->image_attr) }}"
                                                                width="50px">
                                                        </a>
                                                    @endif
                                                @endforeach
                                                @foreach ($product_image[$product[0]->id] as $arr)
                                                    @if ($arr->image != '')
                                                        <a data-big-image="{{ asset('upload/media/product/' . $arr->image) }}"
                                                            data-lens-image="{{ asset('upload/media/product/' . $arr->image) }}"
                                                            class="simpleLens-thumbnail-wrapper" href="javascript:void(0)">
                                                            <img src="{{ asset('upload/media/product/' . $arr->image) }}"
                                                                width="50px">
                                                        </a>
                                                    @endif
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal view content -->
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <div class="aa-product-view-content">
                                        <h3>{{ $product[0]->name }}</h3>
                                        <div class="aa-price-block">
                                            <span class="aa-product-view-price">Rs
                                                {{ $product_arr[$product[0]->id][0]->price }}</span>&nbsp;&nbsp;
                                            <span class="aa-product-view-price"><del>Rs
                                                    {{ $product_arr[$product[0]->id][0]->mrp }}</del></span>
                                            <p class="aa-product-avilability m-0">Avilability: <span>In stock</span></p>
                                            @if ($product[0]->lead_time != '')
                                                <p class="aa-lead-time">{{ $product[0]->lead_time }}</p>
                                            @endif
                                        </div>
                                        <p>{!! $product[0]->short_desc !!}</p>
                                        @if ($product_arr[$product[0]->id][0]->size_id > 0)
                                            <h4>Size</h4>
                                            <div class="aa-prod-view-size">
                                                @php
                                                    $sizeArr = [];
                                                    foreach ($product_arr[$product[0]->id] as $arr) {
                                                        $sizeArr[] = $arr->size;
                                                    }
                                                    $sizeArr = array_unique($sizeArr);
                                                @endphp
                                                @foreach ($sizeArr as $arr)
                                                    @if ($arr != '')
                                                        <a href="javascript:void(0)"
                                                            onclick='showColor("{{ $arr }}")'
                                                            id="size_name_{{ $arr }}"
                                                            class="size_btn">{{ $arr }}</a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                        @if ($product_arr[$product[0]->id][0]->color_id > 0)
                                            <h4>Color</h4>
                                            <div class="aa-color-tag">
                                                @foreach ($product_arr[$product[0]->id] as $arr)
                                                    @if ($arr->color != '')
                                                        <a href="javascript:void(0)"
                                                            onclick='show_attr_image("{{ asset('upload/media/product/' . $arr->image_attr) }}","{{ $arr->size }}","{{ strtolower($arr->color) }}")'
                                                            class="aa-color-green color_pallete_{{ $arr->size }}"
                                                            style="background-color:{{ $arr->color }}"></a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                        <div class="aa-prod-quantity">
                                            <form action="">
                                                <select id="qty" name="qty">
                                                    @for ($i = 1; $i < 11; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </form>
                                            <p class="aa-prod-category">
                                                Model:&nbsp; <a href="javascript:void(0)">{{ $product[0]->model }}</a>
                                            </p>
                                            <p class="aa-prod-category">
                                                Brand:&nbsp; <a href="javascript:void(0)">{{ $product[0]->brand }}</a>
                                            </p>
                                            <p class="aa-prod-category">
                                                Warranty:&nbsp; <a
                                                    href="javascript:void(0)">{{ $product[0]->warranty }}</a>
                                            </p>
                                        </div>
                                        <div class="aa-prod-view-bottom">
                                            <a class="aa-add-to-cart-btn" href="javascipt:void(0)"
                                                onclick='addCart("{{ $product[0]->id }}","{{ $product_arr[$product[0]->id][0]->color_id }}","{{ $product_arr[$product[0]->id][0]->size_id }}")'>Add
                                                To Cart</a>
                                            <div class="cart_error"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="aa-product-details-bottom">
                            <ul class="nav nav-tabs" id="myTab2">
                                <li><a href="#description" data-toggle="tab">Description</a></li>
                                @if ($product[0]->technical_specification != '')
                                    <li><a href="#technical_specification" data-toggle="tab">Technical Specification</a>
                                    </li>
                                @endif
                                @if ($product[0]->uses != '')
                                    <li><a href="#uses" data-toggle="tab">Uses</a></li>
                                @endif
                                <li><a href="#review" data-toggle="tab">Reviews</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="description">
                                    {!! $product[0]->description !!}
                                </div>
                                @if ($product[0]->technical_specification != '')
                                    <div class="tab-pane fade" id="technical_specification">
                                        {!! $product[0]->technical_specification !!}
                                    </div>
                                @endif
                                @if ($product[0]->uses != '')
                                    <div class="tab-pane fade" id="uses">
                                        {!! $product[0]->uses !!}
                                    </div>
                                @endif
                                <div class="tab-pane fade " id="review">
                                    <div class="aa-product-review-area">
                                        @if(isset($review[0]))
                                        <h4>{{count($review)}} Reviews for T-Shirt</h4>
                                        <ul class="aa-review-nav">
                                            @foreach ($review as $list)
                                                <li>
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="javascript:void(0)">
                                                                <img class="media-object" src="{{asset('upload/media/product/no-image.png')}}"
                                                                    alt="girl image">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h4 class="media-heading"><strong>{{$review_customer[$list->id][0]->name}}</strong> - <span>{{\Carbon\Carbon::parse($list->added_on)->format('M d, Y')}}</span></h4>
                                                            <div class="aa-product-rating">
                                                                @php
                                                                    $uncheck = 5 - $list->rating;
                                                                @endphp
                                                                @for($i = 1;$i<=$list->rating;$i++ )
                                                                    <span class="fa fa-star checked_star"></span>
                                                                @endfor
                                                                @if($uncheck > 0)
                                                                     @for($i = 1;$i<=$uncheck;$i++ )
                                                                        <span class="fa fa-star"></span>
                                                                    @endfor
                                                                @endif
                                                            </div>
                                                            <p>{{$list->reviews}}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                            
                                        </ul>
                                        @else
                                        <h4 style="text-align:center;">No Review for this product be the first to give your review.</h4>
                                        <br>
                                        @endif
                                        @if(isset($verify[0]))
                                        <h4>Add a review</h4>
                                        <form id="reviewFrm" class="aa-review-form">
                                            <div class="aa-your-rating">
                                                <p>Your Rating</p>
                                                <input type="radio" name="star_rating" id="star1" value="1" required>
                                                <label for="star1"><span class="fa fa-star-o" id="st1"></span></label>
                                                <input type="radio" name="star_rating" id="star2" value="2" required>
                                                <label for="star2"><span class="fa fa-star-o" id="st2"></span></label>
                                                <input type="radio" name="star_rating" id="star3" value="3" required>
                                                <label for="star3"><span class="fa fa-star-o" id="st3"></span></label>
                                                <input type="radio" name="star_rating" id="star4" value="4" required>
                                                <label for="star4"><span class="fa fa-star-o" id="st4"></span></label>
                                                <input type="radio" name="star_rating" id="star5" value="5" required>
                                                <label for="star5"><span class="fa fa-star-o" id="st5"></span></label>
                                            </div>
                                            <!-- review form -->

                                            <div class="form-group">
                                                <label for="message">Your Review</label>
                                                <textarea class="form-control" name="review" rows="3" id="review_message"
                                                    required></textarea>
                                            </div>
                                            <input type="hidden" name="product_id" value="{{ $product[0]->id }}">
                                            @csrf

                                            <button type="submit" class="btn btn-default aa-review-submit"
                                                id="reviewFrmBtn">Submit</button>
                                            <div id="reviewError" class="error_field" style="margin-top:5px;"></div>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Related product -->
                        <div class="aa-product-related-item">
                            <h3>Related Products</h3>
                            @if (isset($related_product['0']))
                                <ul class="aa-product-catg aa-related-item-slider">
                                    @foreach ($related_product as $productArr)
                                        <li>
                                            <figure>
                                                <a class="aa-product-img"
                                                    href="{{ url('products/' . $productArr->slug) }}"><img
                                                        src="{{ asset('upload/media/product/' . $productArr->image) }}"
                                                        alt="polo shirt img" style="min-height:300px;max-height:300px;"></a>
                                                <a class="aa-add-card-btn"
                                                    href="{{ url('products/' . $productArr->slug) }}"><span
                                                        class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                <figcaption>
                                                    <h4 class="aa-product-title"><a
                                                            href="{{ url('products/' . $productArr->slug) }}">{{ $productArr->name }}</a>
                                                    </h4>
                                                    <span class="aa-product-price">Rs
                                                        {{ $related_product_arr[$productArr->id][0]->price }}</span><span
                                                        class="aa-product-price"><del>Rs
                                                            {{ $related_product_arr[$productArr->id][0]->mrp }}</del></span>
                                                </figcaption>
                                            </figure>

                                            <!-- product badge -->
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="aa-contact-top">
                                    <h2>Sorry, No Product found</h2>
                                    <p>Please search for other product...</p>
                                </div>
                            @endif



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / product category -->




    <form id="frm-cart" method="post">
        @csrf
        <input type="hidden" id="size_id_hidden" name="size_id_hidden">
        <input type="hidden" id="color_id_hidden" name="color_id_hidden">
        <input type="hidden" id="pqty" name="pqty">
        <input type="hidden" id="product_id" name="product_id">
    </form>
@endsection
