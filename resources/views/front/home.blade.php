@extends('front.layout')
@section('title','Daily Shopping | Home')
@section('content')

 <!-- Start slider -->
 <section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">
            <!-- single slide item -->
            @foreach($banner as $list)
            <li>
              <div class="seq-model">
                <img data-seq src="{{ asset('upload/media/banner/' . $list->image) }}" alt="{{$list->title}}" />
              </div>
              <div class="seq-title">                
                <h2 data-seq>{{$list->title}}</h2>                
                <p data-seq>{{$list->description}}</p>
                <a data-seq href="{{$list->btn_link}}" target="_blank" class="aa-shop-now-btn aa-secondary-btn">{{$list->btn_text}}</a>
              </div>
            </li> 
            @endforeach          
          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
  <!-- / slider -->
  <!-- Start Promo section -->
  <section id="aa-promo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-area">
            <div class="row">
              <!-- promo left -->
              {{-- <div class="col-md-5 no-padding">                
                <div class="aa-promo-left">
                  <div class="aa-promo-banner">                    
                    <img src="{{ asset('front_asset/img/promo-banner-1.jpg') }}" alt="img">                    
                    <div class="aa-prom-content">
                      <span>75% Off</span>
                      <h4><a href="#">For Women</a></h4>                      
                    </div>
                  </div>
                </div>
              </div> --}}
              <!-- promo right -->
              <div class="col-md-12 no-padding">
                <div class="aa-promo-right">
                 @foreach($category as $list)
                    <div class="aa-single-promo-right">
                    <div class="aa-promo-banner">                      
                      <img src="{{ asset('upload/media/category/'.$list->category_image) }}" alt="img">                      
                      <div class="aa-prom-content">
                        {{-- <span>Exclusive Item</span> --}}
                        <h4><a href="{{url('category/'.$list->category_slug)}}">{{$list->category_name}}</a></h4>                        
                      </div>
                    </div>
                  </div>
                  @endforeach
                 
                 
                 
                  {{-- <div class="aa-single-promo-right">
                    <div class="aa-promo-banner">                      
                      <img src="{{ asset('front_asset/img/promo-banner-2.jpg') }}" alt="img">                      
                      <div class="aa-prom-content">
                        <span>Sale Off</span>
                        <h4><a href="#">On Shoes</a></h4>                        
                      </div>
                    </div>
                  </div>
                  <div class="aa-single-promo-right">
                    <div class="aa-promo-banner">                      
                      <img src="{{ asset('front_asset/img/promo-banner-4.jpg') }}" alt="img">                      
                      <div class="aa-prom-content">
                        <span>New Arrivals</span>
                        <h4><a href="#">For Kids</a></h4>                        
                      </div>
                    </div>
                  </div>
                  <div class="aa-single-promo-right">
                    <div class="aa-promo-banner">                      
                      <img src="{{ asset('front_asset/img/promo-banner-5.jpg') }}" alt="img">                      
                      <div class="aa-prom-content">
                        <span>25% Off</span>
                        <h4><a href="#">For Bags</a></h4>                        
                      </div>
                    </div>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Promo section -->
  <!-- Products section -->
  <section id="aa-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner">
                <!-- start prduct navigation -->
                 <ul class="nav nav-tabs aa-products-tab">
                  @php
                  $count_num = 1;
                  @endphp
                   @foreach($category as $list)
                   @php
                   $active_class = '';
                   if ($count_num == 1) {
                     $active_class = 'active';
                     $count_num++;
                   }
                 @endphp
                    <li class="{{$active_class}}"><a href="#cat{{$list->category_name}}" data-toggle="tab">{{$list->category_name}}</a></li>
                  @endforeach
                    {{-- <li><a href="#women" data-toggle="tab">Women</a></li>
                    <li><a href="#sports" data-toggle="tab">Sports</a></li>
                    <li><a href="#electronics" data-toggle="tab">Electronics</a></li> --}}
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    @php
                    $count_num = 1;
                    @endphp
                    @foreach($category as $list)
                    @php
                      $active_class = '';
                      if ($count_num == 1) {
                        $active_class = 'active in';
                        $count_num++;
                      }
                    @endphp
                    <!-- Start {{$list->category_name}} product category -->
                    <div class="tab-pane fade {{$active_class}}" id="cat{{$list->category_name}}">
                      <ul class="aa-product-catg ">
                        <!-- start single product item -->
                        
                        @if(isset($product_home[$list->id]['0']))
                            @foreach($product_home[$list->id] as $productArr)
                            <li>
                              <figure>
                                <a class="aa-product-img" href="{{url('products/'.$productArr->slug)}}"><img src="{{asset('upload/media/product/'.$productArr->image)}}" alt="polo shirt img" style="min-height:300px;max-height:300px;"></a>
                                <a class="aa-add-card-btn" href="javascipt:void(0)" onclick='home_addCart("{{$productArr->id}}","{{$product_attr[$productArr->id][0]->color}}","{{$product_attr[$productArr->id][0]->size}}")'><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                  <figcaption>
                                  <h4 class="aa-product-title"><a href="{{url('products/'.$productArr->slug)}}">{{$productArr->name}}</a></h4>
                                  <span class="aa-product-price">Rs {{$product_attr[$productArr->id][0]->price}}</span><span class="aa-product-price"><del>Rs {{$product_attr[$productArr->id][0]->mrp}}</del></span>
                                </figcaption>
                              </figure>                        
                              
                              <!-- product badge -->
                            </li>
                            @endforeach
                            
                        @else 
                            <div class="aa-contact-top">
                              <h2>Sorry, No data found</h2>
                              <p>Please search for other category...</p>
                            </div>
                        @endif
                                              
                      </ul>
                      
                    </div>
                    <!-- / {{$list->category_name}} product category -->
                    @endforeach
                   
                    <!-- / electronic product category -->
                  </div>
                  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Products section -->
  <!-- banner section -->
  <section id="aa-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12">        
          <div class="row">
            <div class="aa-banner-area">
            <a href="#"><img src="{{asset('front_asset/img/fashion-banner.jpg')}}" alt="fashion banner img"></a>
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- popular section -->
  <section id="aa-popular-category">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-popular-category-area">
              <!-- start prduct navigation -->
             <ul class="nav nav-tabs aa-products-tab">
                <li class="active"><a href="#featured" data-toggle="tab">Featured</a></li>
                <li><a href="#discounted" data-toggle="tab">Discounted</a></li>
                <li><a href="#trending" data-toggle="tab">Trending</a></li>                    
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <!-- Start men popular category -->
                <div class="tab-pane fade in active" id="featured">
                  <ul class="aa-product-catg   aa-featured-slider">
                   
                    
                     <!-- start single product item -->
                    
                     @if(isset($featured_home[$list->id]['0']))
                     
                     @foreach($featured_home[$list->id] as $productArr)
                     <li>
                       <figure>
                         <a class="aa-product-img" href="{{url('products/'.$productArr->slug)}}"><img src="{{asset('upload/media/product/'.$productArr->image)}}" alt="polo shirt img" style="min-height:300px;max-height:300px;"></a>
                         <a class="aa-add-card-btn" href="javascipt:void(0)" onclick='home_addCart("{{$productArr->id}}","{{$featured_home_arr[$productArr->id][0]->color}}","{{$featured_home_arr[$productArr->id][0]->size}}")'><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                           <figcaption>
                           <h4 class="aa-product-title"><a href="{{url('products/'.$productArr->slug)}}">{{$productArr->name}}</a></h4>
                           <span class="aa-product-price">Rs {{$featured_home_arr[$productArr->id][0]->price}}</span><span class="aa-product-price"><del>Rs {{$featured_home_arr[$productArr->id][0]->mrp}}</del></span>
                         </figcaption>
                       </figure>    
                       <!-- product badge -->
                     </li>
                     @endforeach
                     
                 @else 
                     <div class="aa-contact-top">
                       <h2>Sorry, No data found</h2>
                       <p>Please search for other offers...</p>
                     </div>
                 @endif
                                                                                                     
                  </ul>
                 
                </div>
                <!-- / popular product category -->

                                
                <!-- start featured product category -->
                <div class="tab-pane fade" id="discounted">
                 <ul class="aa-product-catg aa-discounted-slider">
                  @if(isset($discounted_home[0]))
                    @foreach($discounted_home as $productdArr)
                      <!-- start single product item -->
                      <li>
                        <figure>
                          <a class="aa-product-img" href="{{url('products/'.$productdArr->slug)}}"><img src="{{asset('upload/media/product/'.$productdArr->image)}}" alt="{{$productdArr->name}}" style="min-height:300px;max-height:300px;"></a>
                          <a class="aa-add-card-btn" href="javascipt:void(0)" onclick='home_addCart("{{$productArr->id}}","{{$discounted_home_arr[$productArr->id][0]->color}}","{{$discounted_home_arr[$productArr->id][0]->size}}")'><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                          <figcaption>
                            <h4 class="aa-product-title"><a href="{{url('products/'.$productdArr->slug)}}">Polo T-Shirt</a></h4>
                            <span class="aa-product-price">Rs {{$discounted_home_arr[$productdArr->id][0]->price}}</span><span class="aa-product-price"><del>Rs {{$discounted_home_arr[$productdArr->id][0]->mrp}}</del></span>
                          </figcaption>
                        </figure>                     
                        
                        <!-- product badge -->
                        <span class="aa-badge aa-sale" href="#">Discounted</span>
                      </li>

                    @endforeach
                  @else 
                    <div class="aa-contact-top">
                      <h2>Sorry, No data found</h2>
                      <p>Please search for other offers...</p>
                    </div>

                  @endif
                    
                                                                                                
                  </ul>
                 
                </div>
                <!-- / featured product category -->

                <!-- start latest product category -->
                <div class="tab-pane fade" id="trending">
                  <ul class="aa-product-catg aa-trending-slider">
                   <!-- start single product item -->
                    
                   @if(isset($trending_home['0']))
                     
                   @foreach($trending_home as $productArr)
                        <li>
                          <figure>
                            <a class="aa-product-img" href="{{url('products/'.$productArr->slug)}}"><img src="{{asset('upload/media/product/'.$productArr->image)}}" alt="polo shirt img" style="min-height:300px;max-height:300px;"></a>
                            <a class="aa-add-card-btn" href="javascipt:void(0)" onclick='home_addCart("{{$productArr->id}}","{{$trending_home_arr[$productArr->id][0]->color}}","{{$trending_home_arr[$productArr->id][0]->size}}")'><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <figcaption>
                              <h4 class="aa-product-title"><a href="{{url('products/'.$productArr->slug)}}">{{$productArr->name}}</a></h4>
                              <span class="aa-product-price">Rs {{$trending_home_arr[$productArr->id][0]->price}}</span><span class="aa-product-price"><del>Rs {{$trending_home_arr[$productArr->id][0]->mrp}}</del></span>
                            </figcaption>
                          </figure>    
                          <!-- product badge -->
                        </li>
                      
                        @endforeach
                        
                    @else 
                        <div class="aa-contact-top">
                          <h2>Sorry, No data found</h2>
                          <p>Please search for other offers...</p>
                        </div>
                    @endif
                                                                                                     
                  </ul>
                   
                </div>
                <!-- / latest product category -->              
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </section>
  <!-- / popular section -->
  <!-- Support section -->
  <section id="aa-support">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-support-area">
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-truck"></span>
                <h4>FREE SHIPPING</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-clock-o"></span>
                <h4>30 DAYS MONEY BACK</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
            <!-- single support -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="aa-support-single">
                <span class="fa fa-phone"></span>
                <h4>SUPPORT 24/7</h4>
                <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, nobis.</P>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Support section -->
  <!-- Testimonial -->
  <section id="aa-testimonial">  
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-testimonial-area">
            <ul class="aa-testimonial-slider">
              <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="img/testimonial-img-2.jpg" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                  <div class="aa-testimonial-info">
                    <p>Allison</p>
                    <span>Designer</span>
                    <a href="#">Dribble.com</a>
                  </div>
                </div>
              </li>
              <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="img/testimonial-img-1.jpg" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                  <div class="aa-testimonial-info">
                    <p>KEVIN MEYER</p>
                    <span>CEO</span>
                    <a href="#">Alphabet</a>
                  </div>
                </div>
              </li>
               <!-- single slide -->
              <li>
                <div class="aa-testimonial-single">
                <img class="aa-testimonial-img" src="img/testimonial-img-3.jpg" alt="testimonial img">
                  <span class="fa fa-quote-left aa-testimonial-quote"></span>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui!consectetur adipisicing elit. Sunt distinctio omnis possimus, facere, quidem qui.</p>
                  <div class="aa-testimonial-info">
                    <p>Luner</p>
                    <span>COO</span>
                    <a href="#">Kinatic Solution</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Testimonial -->

  <!-- Latest Blog -->
  {{-- <section id="aa-latest-blog">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-latest-blog-area">
            <h2>LATEST BLOG</h2>
            <div class="row">
              <!-- single latest blog -->
              <div class="col-md-4 col-sm-4">
                <div class="aa-latest-blog-single">
                  <figure class="aa-blog-img">                    
                    <a href="#"><img src="img/promo-banner-1.jpg" alt="img"></a>  
                      <figcaption class="aa-blog-img-caption">
                      <span href="#"><i class="fa fa-eye"></i>5K</span>
                      <a href="#"><i class="fa fa-thumbs-o-up"></i>426</a>
                      <a href="#"><i class="fa fa-comment-o"></i>20</a>
                      <span href="#"><i class="fa fa-clock-o"></i>June 26, 2016</span>
                    </figcaption>                          
                  </figure>
                  <div class="aa-blog-info">
                    <h3 class="aa-blog-title"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, ad? Autem quos natus nisi aperiam, beatae, fugiat odit vel impedit dicta enim repellendus animi. Expedita quas reprehenderit incidunt, voluptates corporis.</p> 
                    <a href="#" class="aa-read-mor-btn">Read more <span class="fa fa-long-arrow-right"></span></a>
                  </div>
                </div>
              </div>
              <!-- single latest blog -->
              <div class="col-md-4 col-sm-4">
                <div class="aa-latest-blog-single">
                  <figure class="aa-blog-img">                    
                    <a href="#"><img src="img/promo-banner-3.jpg" alt="img"></a>  
                      <figcaption class="aa-blog-img-caption">
                      <span href="#"><i class="fa fa-eye"></i>5K</span>
                      <a href="#"><i class="fa fa-thumbs-o-up"></i>426</a>
                      <a href="#"><i class="fa fa-comment-o"></i>20</a>
                      <span href="#"><i class="fa fa-clock-o"></i>June 26, 2016</span>
                    </figcaption>                          
                  </figure>
                  <div class="aa-blog-info">
                    <h3 class="aa-blog-title"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, ad? Autem quos natus nisi aperiam, beatae, fugiat odit vel impedit dicta enim repellendus animi. Expedita quas reprehenderit incidunt, voluptates corporis.</p> 
                     <a href="#" class="aa-read-mor-btn">Read more <span class="fa fa-long-arrow-right"></span></a>         
                  </div>
                </div>
              </div>
              <!-- single latest blog -->
              <div class="col-md-4 col-sm-4">
                <div class="aa-latest-blog-single">
                  <figure class="aa-blog-img">                    
                    <a href="#"><img src="img/promo-banner-1.jpg" alt="img"></a>  
                      <figcaption class="aa-blog-img-caption">
                      <span href="#"><i class="fa fa-eye"></i>5K</span>
                      <a href="#"><i class="fa fa-thumbs-o-up"></i>426</a>
                      <a href="#"><i class="fa fa-comment-o"></i>20</a>
                      <span href="#"><i class="fa fa-clock-o"></i>June 26, 2016</span>
                    </figcaption>                          
                  </figure>
                  <div class="aa-blog-info">
                    <h3 class="aa-blog-title"><a href="#">Lorem ipsum dolor sit amet</a></h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, ad? Autem quos natus nisi aperiam, beatae, fugiat odit vel impedit dicta enim repellendus animi. Expedita quas reprehenderit incidunt, voluptates corporis.</p> 
                    <a href="#" class="aa-read-mor-btn">Read more <span class="fa fa-long-arrow-right"></span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>    
      </div>
    </div>
  </section> --}}
  <!-- / Latest Blog -->

  <!-- Client Brand -->
  <section id="aa-client-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-client-brand-area">
            <ul class="aa-client-brand-slider">
              @foreach($home_brands as $list)
              <li><a href="#" title="{{$list->brand}}"><img src="{{asset('upload/brands/'.$list->brand_image)}}" alt="{{$list->brand}}"></a></li>
              @endforeach
              {{-- <li><a href="#"><img src="img/client-brand-jquery.png" alt="jquery img"></a></li>
              <li><a href="#"><img src="img/client-brand-html5.png" alt="html5 img"></a></li>
              <li><a href="#"><img src="img/client-brand-css3.png" alt="css3 img"></a></li>
              <li><a href="#"><img src="img/client-brand-wordpress.png" alt="wordPress img"></a></li>
              <li><a href="#"><img src="img/client-brand-joomla.png" alt="joomla img"></a></li>
              <li><a href="#"><img src="img/client-brand-java.png" alt="java img"></a></li>
              <li><a href="#"><img src="img/client-brand-jquery.png" alt="jquery img"></a></li>
              <li><a href="#"><img src="img/client-brand-html5.png" alt="html5 img"></a></li>
              <li><a href="#"><img src="img/client-brand-css3.png" alt="css3 img"></a></li>
              <li><a href="#"><img src="img/client-brand-wordpress.png" alt="wordPress img"></a></li> --}}
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Client Brand -->




  <input type="hidden" id="qty" value="1" /> 
  <form id="frm-cart" method="post">
    @csrf
    <input type="hidden" id="size_id_hidden" name="size_id_hidden"> 
    <input type="hidden" id="color_id_hidden" name="color_id_hidden"> 
    <input type="hidden" id="pqty" name="pqty"> 
    <input type="hidden" id="product_id" name="product_id"> 
</form>


@endsection
