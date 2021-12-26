{{-- @php 
use Illuminate\Support\Facades\DB;

$allCategories = DB::table('categories')->get();

$rootCategory = DB::table('categories')->where('parent_category_id', '=', 0)->get();

// foreach ($rootCategory as $rootCategoryArr) {
//   $rootCategoryArr->children = $allCategories->where('parent_category_id', '=', $rootCategoryArr->id); 
// }

function menuTree($categories,$allCategories){
  foreach ($categories as $rootCategoryArr) {
    $rootCategoryArr->children = $allCategories->where('parent_category_id', '=', $rootCategoryArr->id); 
    if ($rootCategoryArr->children->isNotEmpty()) {
        menuTree($rootCategoryArr->children,$allCategories);
    }
  }
  return $categories;
}

echo '<pre>';
print_r(menuTree($rootCategory,$allCategories));
die();

@endphp --}}
@php
if (isset($_COOKIE['lemail']) && $_COOKIE['lpass']) {
    $login_email = $_COOKIE['lemail'];
    $login_pass = $_COOKIE['lpass'];
    $isremember = 'checked';
} else {
    $login_email = '';
    $login_pass = '';
    $isremember = '';
}
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link href="{{ asset('front_asset/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('front_asset/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('front_asset/css/jquery.smartmenus.bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_asset/css/jquery.simpleLens.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_asset/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front_asset/css/nouislider.css') }}">
    <link id="switcher" href="{{ asset('front_asset/css/theme-color/default-theme.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('front_asset/css/sequence-theme.modern-slide-in.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('front_asset/css/style.css') }}" rel="stylesheet">

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body class="@yield('body_class')">
    <!-- wpf loader Two -->
    <div id="wpf-loader-two">
        <div class="wpf-loader-two-inner">
            <span>Loading</span>
        </div>
    </div>
    <!-- / wpf loader Two -->
    <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
    <!-- END SCROLL TOP BUTTON -->


    <!-- Start header section -->
    <header id="aa-header">
        <!-- start header top  -->
        <div class="aa-header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="aa-header-top-area">
                            <!-- start header top left -->
                            <div class="aa-header-top-left">
                                <!-- start language -->
                                <div class="aa-language">
                                    <div class="dropdown">
                                        <a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <img src="{{ asset('front_asset/img/flag/english.jpg') }}"
                                                alt="english flag">ENGLISH
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="#"><img src="{{ asset('front_asset/img/flag/french.jpg') }}"
                                                        alt="">FRENCH</a></li>
                                            <li><a href="#"><img src="{{ asset('front_asset/img/flag/english.jpg') }}"
                                                        alt="">ENGLISH</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- / language -->

                                <!-- start currency -->
                                <div class="aa-currency">
                                    <div class="dropdown">
                                        <a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa fa-usd"></i>USD
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                            <li><a href="#"><i class="fa fa-euro"></i>EURO</a></li>
                                            <li><a href="#"><i class="fa fa-jpy"></i>YEN</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- / currency -->
                                <!-- start cellphone -->
                                <div class="cellphone hidden-xs">
                                    <p><span class="fa fa-phone"></span>99264-88445</p>
                                </div>
                                <!-- / cellphone -->
                            </div>
                            <!-- / header top left -->
                            <div class="aa-header-top-right">
                                <ul class="aa-head-top-nav-right">
                                    @if (session()->has('FRONT_LOGGEDIN'))
                                        <li><a href="{{ url('/order') }}">My Orders</a></li>
                                    @endif
                                    <li class="hidden-xs"><a href="{{ url('/cart') }}">My Cart</a></li>
                                    <li class="hidden-xs"><a href="{{url('/checkout')}}">Checkout</a></li>
                                    @if (session()->has('FRONT_LOGGEDIN'))
                                        <li><a href="{{ url('logout') }}">Logout</a></li>
                                    @else
                                        <li><a href="{{ url('/register') }}">SignUp</a></li>
                                        <li><a href="" data-toggle="modal" data-target="#login-modal">Login</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / header top  -->

        <!-- start header bottom  -->
        <div class="aa-header-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="aa-header-bottom-area">
                            <!-- logo  -->
                            <div class="aa-logo">
                                <!-- Text based logo -->
                                <a href="/">
                                    <span class="fa fa-shopping-cart"></span>
                                    <p>fast<strong>Shop</strong> <span>Your Shopping Partner</span></p>
                                </a>
                                <!-- img based logo -->
                                <!-- <a href="javascript:void(0)"><img src="{{ asset('front_asset/img/logo.jpg') }}" alt="logo img"></a> -->
                            </div>
                            <!-- / logo  -->
                            <!-- cart box -->
                            @php
                                $productCart = getCartNav();
                                $productCount = count($productCart);
                            @endphp
                            <div class="aa-cartbox">
                                <a class="aa-cart-link" href="#">
                                    <span class="fa fa-shopping-basket"></span>
                                    <span class="aa-cart-title">SHOPPING CART</span>
                                    <span class="aa-cart-notify">{{ $productCount }}</span>
                                </a>
                                @if ($productCount > 0)
                                    @php
                                        $subtotal = 0;
                                    @endphp
                                    <div class="aa-cartbox-summary">
                                        <ul>
                                            @foreach ($productCart as $product)
                                                @php
                                                    $subtotal = $subtotal + $product->qty * $product->price;
                                                @endphp
                                                <li id="product-{{ $product->attr_id }}">
                                                    <a class="aa-cartbox-img"
                                                        href="{{ url('/products/' . $product->slug) }}"><img
                                                            src="{{ asset('upload/media/product/' . $product->image) }}"
                                                            alt="img"></a>
                                                    <div class="aa-cartbox-info">
                                                        <h4><a
                                                                href="{{ url('/products/' . $product->slug) }}">{{ $product->name }}</a>
                                                        </h4>
                                                        <p>{{ $product->qty }} x $ {{ $product->price }}</p>
                                                    </div>
                                                    <a class="aa-remove-product" href="javascipt:void(0)"
                                                        onclick='deleteQtyNav("{{ $product->pid }}","{{ $product->attr_id }}","{{ $product->size }}","{{ $product->color }}")'><span
                                                            class="fa fa-times"></span></a>
                                                </li>
                                            @endforeach
                                            <li>
                                                <span class="aa-cartbox-total-title">
                                                    Total
                                                </span>
                                                <span class="aa-cartbox-total-price">
                                                    ${{ $subtotal }}
                                                </span>
                                            </li>
                                        </ul>
                                        <a class="aa-cartbox-checkout aa-primary-btn"
                                            href="{{url('/cart')}}">Cart</a>
                                    </div>
                                @endif
                            </div>
                            <!-- / cart box -->
                            <!-- search box -->
                            <div class="aa-search-box">

                                <input type="text" id="search_str" placeholder="Search here ex. 'man' ">
                                <button type="button" onclick="searchOn()"><span class="fa fa-search"></span></button>

                            </div>
                            <!-- / search box -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / header bottom  -->
    </header>
    <!-- / header section -->
    <!-- menu -->
    <section id="menu">
        <div class="container">
            <div class="menu-area">
                <!-- Navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="navbar-collapse collapse">
                    
                        {!! getNavCat() !!}
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
    </section>
    <!-- / menu -->
    @yield('content')

    <section id="aa-subscribe">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-subscribe-area">
                        <h3>Subscribe our newsletter </h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
                        <form id="frmNewsletter" class="aa-subscribe-form">
                            <input type="email" name="newsletterEmail" id="newsletterEmail" placeholder="Enter your Email" required>
                            <input type="submit" id="frmNewsletterBtn" value="Subscribe">
                            @csrf
                        </form>
                        <div id="errorNewsletter" class="error_field" style="margin-top: 2px;"> </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer id="aa-footer">
        <!-- footer bottom -->
        <div class="aa-footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="aa-footer-top-area">
                            <div class="row">
                                <div class="col-md-3 col-sm-6">
                                    <div class="aa-footer-widget">
                                        <h3>Main Menu</h3>
                                        <ul class="aa-footer-nav">
                                            <li><a href="#">Home</a></li>
                                            <li><a href="#">Our Services</a></li>
                                            <li><a href="#">Our Products</a></li>
                                            <li><a href="#">About Us</a></li>
                                            <li><a href="#">Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="aa-footer-widget">
                                        <div class="aa-footer-widget">
                                            <h3>Knowledge Base</h3>
                                            <ul class="aa-footer-nav">
                                                <li><a href="#">Delivery</a></li>
                                                <li><a href="#">Returns</a></li>
                                                <li><a href="#">Services</a></li>
                                                <li><a href="#">Discount</a></li>
                                                <li><a href="#">Special Offer</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="aa-footer-widget">
                                        <div class="aa-footer-widget">
                                            <h3>Useful Links</h3>
                                            <ul class="aa-footer-nav">
                                                <li><a href="#">Site Map</a></li>
                                                <li><a href="#">Search</a></li>
                                                <li><a href="#">Advanced Search</a></li>
                                                <li><a href="#">Suppliers</a></li>
                                                <li><a href="#">FAQ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="aa-footer-widget">
                                        <div class="aa-footer-widget">
                                            <h3>Contact Us</h3>
                                            <address>
                                                <p> Pithampur, Madhya Pradesh, India</p>
                                                <p><span class="fa fa-phone"></span>+91 9926488445</p>
                                                <p><a href="mailto:mohdrehanrq0@gmail.com" style="color: inherit;"><span
                                                            class="fa fa-envelope"></span>mohdrehanrq0@gmail.com</a></p>
                                            </address>
                                            <div class="aa-footer-social">
                                                <a href="#"><span class="fa fa-facebook"></span></a>
                                                <a href="#"><span class="fa fa-twitter"></span></a>
                                                <a href="#"><span class="fa fa-google-plus"></span></a>
                                                <a href="#"><span class="fa fa-youtube"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bottom -->
        <div class="aa-footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="aa-footer-bottom-area">
                            <p>Developed by <a href="https://mohdrehanrq0.github.io/react_portfolio/"
                                    target="_blank">Rehan</a></p>
                            <div class="aa-footer-payment">
                                <span class="fa fa-cc-mastercard"></span>
                                <span class="fa fa-cc-visa"></span>
                                <span class="fa fa-paypal"></span>
                                <span class="fa fa-cc-discover"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- / footer -->

    <!-- Login Modal -->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">&times;</button>
                    <div id="loginFrmdiv">
                        <h4>Login or Register</h4>
                        <form id="frmLogin" class="aa-login-form" autocomplete="off">
                            @csrf
                            <label for="">Email address<span>*</span></label>
                            <input type="text" name="lemail" placeholder="Email " value="{{ $login_email }}">
                            <div id="lemail_error" class="error_field"></div>
                            <label for="">Password<span>*</span></label>
                            <input type="password" name="lpass" placeholder="Password" value="{{ $login_pass }}">
                            <div id="lpass_error" class="error_field"></div>
                            <button type="button" id="frmLoginBtn" class="aa-browse-btn">Login</button>
                            <label class="rememberme" for="rememberme"><input type="checkbox" name="rememberme"
                                    {{ $isremember }} id="rememberme"> Remember me </label>
                            <p class="aa-lost-password"><a href="javascript:void(0)" onclick="change_pass()">Lost your
                                    password?</a></p>
                            <div class="aa-register-now">
                                Don't have an account?<a href="{{ url('register') }}">Register now!</a>
                            </div>
                        </form>
                    </div>
                    <div id="forgotPassFrmdiv" style="display:none;">
                      <h4>Forgot Password</h4>
                      <form id="frmForgot" class="aa-login-form" autocomplete="off">
                          @csrf
                          <label for="">Email address<span>*</span></label>
                          <input type="text" name="forgot_email_address" placeholder="Email">
                          <div id="forgot_email_address" class="error_field"></div>
                          
                          <button type="button" id="frmForgotBtn" class="aa-browse-btn">Get Email</button>
                          <br><br>
                          <div class="aa-register-now">
                              Want to <a href="javascript:void(0)" onclick="loginFrmShow()">Login !</a>
                          </div>
                      </form>
                  </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('front_asset/js/bootstrap.js') }}"></script>
    <!-- SmartMenus jQuery plugin -->
    <script type="text/javascript" src="{{ asset('front_asset/js/jquery.smartmenus.js') }}"></script>
    <!-- SmartMenus jQuery Bootstrap Addon -->
    <script type="text/javascript" src="{{ asset('front_asset/js/jquery.smartmenus.bootstrap.js') }}"></script>
    <!-- sweet Alert JS  -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- To Slider JS -->
    <script src="{{ asset('front_asset/js/sequence.js') }}"></script>
    <script src="{{ asset('front_asset/js/sequence-theme.modern-slide-in.js') }}"></script>
    <!-- Product view slider -->
    <script type="text/javascript" src="{{ asset('front_asset/js/jquery.simpleGallery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('front_asset/js/jquery.simpleLens.js') }}"></script>
    <!-- slick slider -->
    <script type="text/javascript" src="{{ asset('front_asset/js/slick.js') }}"></script>
    <!-- Price picker slider -->
    <script type="text/javascript" src="{{ asset('front_asset/js/nouislider.js') }}"></script>
    <!-- Custom js -->
    <script src="{{ asset('front_asset/js/custom.js') }}"></script>
    <script>
        @yield('js_script')
    </script>
    @if (session()->has('logoutmsg'))
        <script>
            swal({
                title: "Logout Successful",
                icon: "success",
                button: "Close",
            });
        </script>
    @endif
    @if (session()->has('loginmsg'))
        <script>
            swal({
                title: "Login Successful",
                icon: "success",
                button: "Close",
            });
        </script>
    @endif
    @if (session()->has('verify_msg'))
        <script>
            swal({
                title: "{{ session()->get('verify_msg') }}",
                icon: "warning",
                button: "Close",
            });
        </script>
    @endif
    @if (session()->has('paymentError'))
        <script>
            swal({
                title: "{{ session()->get('paymentError') }}",
                icon: "warning",
                button: "Close",
            });
        </script>
    @endif
    @if (session()->has('msg'))
        <script>
            swal({
                title: "{{ session()->get('msg') }}",
                icon: "warning",
                button: "Close",
            });
        </script>
    @endif
    

</body>

</html>
