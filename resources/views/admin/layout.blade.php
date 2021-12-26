<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    {{-- ckeditor script link  --}}
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>


    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin_asset/css/font-face.css') }}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('admin_asset/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin_asset/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin_asset/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_asset/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_asset/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_asset/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_asset/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_asset/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_asset/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin_asset/css/theme.css') }}" rel="stylesheet" media="all">
    <style>
        .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable, .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
            height: 115px !important;
        }
    </style>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="{{url('/')}}">
                            <img src="{{ asset('admin_asset/images/icon/logo.png') }}" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="@yield('dashboard_active')">
                            <a href="{{url('admin/dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="@yield('order_active')">
                            <a href="{{url('admin/order')}}">
                                <i class="fas fa-shopping-basket"></i>Order</a>
                        </li>
                        <li class="@yield('reviews_active')">
                            <a href="{{url('admin/reviews')}}">
                                <i class="fas fa-comments"></i>Reviews</a>
                        </li>
                        <li class="@yield('category_active')">
                            <a href="{{url('admin/category')}}">
                                <i class="fas fa-th-list"></i>Category</a>
                        </li>
                        <li class="@yield('coupon_active')">
                            <a href="{{url('admin/coupon')}}">
                                <i class="fas fa-tags"></i>Coupon</a>
                        </li>
                        <li class="@yield('banner_active')">
                            <a href="{{url('admin/banner')}}">
                                <i class="far fa-file-powerpoint"></i>Banner</a>
                        </li>
                        <li class="@yield('color_active')">
                            <a href="{{url('admin/color')}}">
                                <i class="fas fa-paint-brush"></i>Color</a>
                        </li>
                        <li class="@yield('brand_active')">
                            <a href="{{url('admin/brand')}}">
                                <i class="fas fa-hashtag"></i>Brands</a>
                        </li>
                        <li class="@yield('tax_active')">
                            <a href="{{url('admin/tax')}}">
                                <i class="fas fa-percent"></i>Tax</a>
                        </li>
                        <li class="@yield('product_active')">
                            <a href="{{url('admin/product')}}">
                                <i class="fab fa-product-hunt"></i>Products</a>
                        </li>
                        <li class="@yield('customer_active')">
                            <a href="{{url('admin/customer')}}">
                                <i class="fas fa-users"></i>Customer</a>
                        </li>
                        
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{url('/')}}">
                    <img src="{{ asset('admin_asset/images/icon/logo.png') }}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="@yield('dashboard_active')">
                            <a href="{{url('admin/dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="@yield('order_active')">
                            <a href="{{url('admin/order')}}">
                                <i class="fas fa-shopping-basket"></i>Order</a>
                        </li>
                        <li class="@yield('reviews_active')">
                            <a href="{{url('admin/reviews')}}">
                                <i class="fas fa-comments"></i>Reviews</a>
                        </li>
                        <li class="@yield('category_active')">
                            <a href="{{url('admin/category')}}">
                                <i class="fas fa-th-list"></i>Category</a>
                        </li>
                        <li class="@yield('coupon_active')">
                            <a href="{{url('admin/coupon')}}">
                                <i class="fas fa-tags"></i>Coupon</a>
                        </li>
                        <li class="@yield('banner_active')">
                            <a href="{{url('admin/banner')}}">
                                <i class="far fa-file-powerpoint"></i>Banner</a>
                        </li>
                        <li class="@yield('size_active')">
                            <a href="{{url('admin/size')}}">
                                <i class="fab fa-quinscape"></i>Size</a>
                        </li>
                        <li class="@yield('color_active')">
                            <a href="{{url('admin/color')}}">
                                <i class="fas fa-paint-brush"></i>Color</a>
                        </li>
                        <li class="@yield('brand_active')">
                            <a href="{{url('admin/brand')}}">
                                <i class="fas fa-hashtag"></i>Brands</a>
                        </li>
                        <li class="@yield('tax_active')">
                            <a href="{{url('admin/tax')}}">
                                <i class="fas fa-percent"></i>Tax</a>
                        </li>
                        <li class="@yield('product_active')">
                            <a href="{{url('admin/product')}}">
                                <i class="fab fa-product-hunt"></i>Products</a>
                        </li>
                        <li class="@yield('customer_active')">
                            <a href="{{url('admin/customer')}}">
                                <i class="fas fa-users"></i>Customer</a>
                        </li>
                        
                        
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    
                                   
                                
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">

                                        <div class="content">
                                            <a class="js-acc-btn" href="javascript:void(0)">Welcome Admin</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="account-dropdown__footer">
                                                <a href="{{ url('/admin/logout')}}">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>
                                    <button class="au-btn au-btn-icon au-btn--blue">
                                        <i class="zmdi zmdi-plus"></i>add item</button>
                                </div>
                            </div>
                        </div> --}}
                        @yield('content')
                        
                      
                        <div class="row fixed-bottom footer_admin">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © {{date('Y')}} Mohd Rehan Qureshi. All rights reserved. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
        

    <!-- Jquery JS-->
    <script src="{{ asset('admin_asset/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin_asset/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('admin_asset/vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ asset('admin_asset/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ asset('admin_asset/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ asset('admin_asset/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/select2/select2.min.js') }}">
    </script>

    <!-- Main JS-->
    <script src="{{ asset('admin_asset/js/main.js') }}"></script>

</body>

</html>
<!-- end document-->
