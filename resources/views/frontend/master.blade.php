
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>S T O W A A</title>

    <link rel="shortcut icon" href="{{asset('frontend_assets/images/logo/favourite_icon_1.png')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend_assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet"  href="{{asset('frontend_assets/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/stroke-gap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/icofont.css')}}">
    
    <link rel="stylesheet" href="{{asset('frontend_assets/css/animate.css')}}">
    
    
    <link rel="stylesheet" href="{{asset('frontend_assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/slick-theme.css')}}">
    
    <link rel="stylesheet" href="{{asset('frontend_assets/css/magnific-popup.css')}}">
    
   
    <link rel="stylesheet" href="{{asset('frontend_assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/tracking.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/nice-select.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('frontend_assets/css/woocommerce.css')}}"> -->
    <link rel="stylesheet" href="{{asset('frontend_assets/css/jquery-ui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend_assets/css/woocommerce-2.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    
     
</head>

<body>

    <!-- body_wrap - start -->
    <div class="body_wrap">
        
        <!-- backtotop - start -->
        <div class="backtotop">
            <a href="#" class="scroll">
                <i class="fa-solid fa-arrow-up"></i>
            </a>
        </div>
        <!-- backtotop - end -->

        <!-- preloader - start -->
        <div id="preloader"></div>
        <!-- preloader - end -->

        
        <!-- header_section - start
        ================================================== -->
        <header class="header_section header-style-no-collapse">
            <div class="header_top">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-md-4">
                            <ul class="header_select_options ul_li">
                                <li>
                                    <div class="select_option" id="google_element">
                                        <!-- <div class="flug_wrap">
                                            <img src="{{asset('frontend_assets/images/flug/flug_uk.png')}}" alt="image_not_found">  
                                        </div>
                                        <select>
                                            <option data-display="Select Option">Select Your Language</option>
                                            <option value="1" selected>English</option>
                                            <option value="2">Bangla</option>
                                            <option value="3" disabled>Arabic</option>
                                            <option value="4">Hebrew</option>
                                        </select> -->
                                    </div>
                                </li>

                                
                                
                            </ul>
                        </div>
                    
                        <div class="col col-md-4">
                            <p class="textcenter" style="color:red">**This site is just for demo perpose. Any product shown here is not actually for sell. These are just some demo.**</p>
                        </div>
                                    
                        <div class="col col-md-4">
                            
                            <p class="header_hotline">Call us toll free: <strong><a href="tel:01995536898" style="color:white; text-decoration: none"> 01995536898</a></strong></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header_middle">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-lg-3 col-md-3 col-sm-12">
                            <div class="brand_logo">
                                <a class="brand_link" href="{{url('/')}}">
                                    <img src="{{asset('frontend_assets/images/logo/logo_1x.png')}}" srcset="{{asset('frontend_assets/images/logo/logo_2x.png 2x')}}" alt>
                                </a>
                            </div>
                        </div>
                        <div class="col col-lg-6 col-md-6 col-sm-12">
                            <form action="{{url('/search')}}" method="POST">
                                @csrf
                                <div class="advance_serach">
                                    <div class="select_option mb-0 clearfix">
                                        <select name="search_cat">
                                            <option data-display="All Categories" value="all">Select A Category</option>
                                            @foreach(App\Models\category::all() as $category)
                                            <option value="{{$category->category_name}} ">{{$category->category_name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form_item">
                                        <input type="text" name="search" placeholder="Search Prudcts...">
                                        <button type="submit" class="search_btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </div>
                            </form>
                            

                        </div>

                            

                        <div class="col col-lg-3 col-md-3 col-sm-12">
                            <button class="mobile_menu_btn2 navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_menu_dropdown" aria-controls="main_menu_dropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fal fa-bars"></i>
                            </button>
                            

                            <button>
                            <ul class="header_icons_group ul_li_right">
                                @auth('logan')
                                <a href="{{url('/wishlist')}}">
                                    <svg role="img" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" stroke="#051d43" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg>
                                    <!-- @if(App\Models\wishlist::where('user_id',Auth::guard('logan')->id())->count()>0)
                                    <span class="wishlist_counter">
                                        {{App\Models\wishlist::where('user_id',Auth::guard('logan')->id())->count()}}
                                    </span>
                                    @endif -->
                                </a>
                                @else
                                <a href="{{url('/log_reg')}}">
                                    <svg role="img" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" stroke="#051d43" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg> 
                                </a>
                                @endauth
                            </ul>
                            </button>


                            <button class="cart_btn">
                                <ul class="header_icons_group ul_li_right">
                                    <li>
                                        <span class="cart_icon">

                                            <i class="icon icon-ShoppingCart"></i>
                                            @auth('logan')
                                            @if(App\Models\cart::where('user_id',Auth::guard('logan')->id())->count()>0)
                                            <small class="cart_counter">
                                                {{App\Models\cart::where('user_id',Auth::guard('logan')->id())->count()}}
                                            </small>
                                            @endif
                                            @endauth
                                        </span>
                                    </li>
                               </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            


            <div class="header_bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-md-3">
                            <div class="allcategories_dropdown">
                                <a class="allcategories_btn" type="button" data-bs-toggle="collapse" href="#allcategories_collapse" aria-expanded="false" aria-controls="allcategories_collapse">
                                    <svg role="img" xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" viewBox="0 0 24 24" aria-labelledby="statsIconTitle" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none" color="#000"> <title id="statsIconTitle">Stats</title> <path d="M6 7L15 7M6 12L18 12M6 17L12 17"/> </svg>
                                    Browse categories
                                </a>
                                <div class="allcategories_collapse collapse" id="allcategories_collapse">
                                    <div class="card card-body">
                                        <ul class="allcategories_list ul_li_block">
                                                @foreach(App\Models\category::all() as $category)
                                                <li><a href="{{url('/categorywise_shop')}}/{{$category->id}}/{{'sub'}}"><i class="{{$category->icons}}"></i>{{$category->category_name}} </a></li>
                                                @endforeach
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col col-md-6">
                            <nav class="main_menu navbar navbar-expand-lg">
                                <div class="main_menu_inner collapse navbar-collapse" id="main_menu_dropdown">
                                    <button type="button" class="offcanvas_close">
                                        <i class="fal fa-times"></i>
                                    </button>
                                    <ul class="main_menu_list ul_li">
                                        <li><a class="nav-link" href="{{url('/')}}">Home</a></li>
                                        <li><a class="nav-link" href="{{url('/about_us')}}">About us</a></li>
                                        <li><a class="nav-link" href="{{url('/shop')}}">Shop</a></li>
                                        <li><a class="nav-link" href="{{url('/contact_us')}}">Contact Us</a></li>
                                        <li><a class="nav-link" href="{{url('/track-order')}}">Track order</a></li>
                                    </ul>
                                </div>
                            </nav>
                            <div class="offcanvas_overlay"></div>
                        </div>

                        <div class="col col-md-3">
                            <ul class="header_icons_group ul_li_right">
                                <li>
                                    @Auth('logan')
                                    <a href="{{url('/account')}}">
                                        {{Auth::guard('logan')->user()->name }}
                                        <svg role="img" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" stroke="#051d43" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title id="personIconTitle">Person</title> <path d="M4,20 C4,17 8,17 10,15 C11,14 8,14 8,9 C8,5.667 9.333,4 12,4 C14.667,4 16,5.667 16,9 C16,14 13,14 14,15 C16,17 20,17 20,20"/> </svg>
                                    </a>
                                    @else
                                    <a href="{{url('/log_reg')}}">
                                        Sign in
                                        <svg role="img" xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24" stroke="#051d43" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title id="personIconTitle">Person</title> <path d="M4,20 C4,17 8,17 10,15 C11,14 8,14 8,9 C8,5.667 9.333,4 12,4 C14.667,4 16,5.667 16,9 C16,14 13,14 14,15 C16,17 20,17 20,20"/> </svg>
                                    </a>
                                    @endAuth

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header_section - end
        ================================================== -->
        <main>
        <!-- sidebar cart - start
            ================================================== -->
            <div class="sidebar-menu-wrapper">
                <div class="cart_sidebar">
                    <button type="button" class="close_btn"><i class="fal fa-times"></i></button>
                    <ul class="cart_items_list ul_li_block mb_30 clearfix">
                        @php
                        $record=0;
                        @endphp
                        @foreach(App\Models\cart::where('user_id',Auth::guard('logan')->id())->get() as $cr)
                        <li>
                            <div class="item_image">
                                <img src="{{asset('/uploads/products/preview')}}/{{App\Models\product::find($cr->product_id)->product_image}}" alt="image_not_found">
                            </div>
                            <div class="item_content">
                                <h4 class="item_title">{{App\Models\product::find($cr->product_id)->product_name}}</h4>
                                <span>x {{$cr->quantity}}</span>
                                <span class="item_price">BDT {{$cr->total_price}} </span><br>
                                
                            </div>
                            <!-- <a href="{{url('/remove')}}/{{$cr->id}}" class="remove_btn"><i class="fal fa-trash-alt"></i></a> -->
                        </li>
                        @php
                        $record+=1;
                        @endphp
                        @endforeach
                        
                    </ul>

                    
                    <!-- <ul class="total_price ul_li_block mb_30 clearfix">
                        <li>
                            <span>Subtotal:</span>
                            <span>$90</span>
                        </li>
                        <li>
                            <span>Vat 5%:</span>
                            <span>$4.5</span>
                        </li>
                        <li>
                            <span>Discount 20%:</span>
                            <span>- $18.9</span>
                        </li>
                        <li>
                            <span>Total:</span>
                            <span>$75.6</span>
                        </li>
                    </ul> -->

                    @if($record==0)
                    <h5 class="text-center">Nothing to show.Cart is empty</h5>
                    @else
                    <br><br>
                    <ul class="btns_group ul_li_block clearfix">
                        <li><a class="btn btn_primary" href="{{url('/cart/list')}}">View Cart</a></li>
                        <!-- <li><a class="btn btn_secondary" href="{{url('/checkout')}}">Checkout</a></li> -->
                    </ul>
                    @endif
                </div>
                <div class="cart_overlay"></div>
            </div>
            <!-- sidebar cart - end
            ================================================== -->

            @yield('content')
                    <!-- newsletter_section - start
            ================================================== -->
            <section class="newsletter_section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-lg-6">
                            <h2 class="newsletter_title text-white">Sign Up for Newsletter </h2>
                            <p>Get E-mail updates about our latest products and special offers.</p>
                        </div>
                        <div class="col col-lg-6">
                            <form action="{{url('/newsletter')}}" method="POST">
                                @csrf
                                <div class="newsletter_form">
                                    <input type="email" name="email" placeholder="Enter your email address">
                                    <button type="submit" class="btn btn_secondary">Submit</button>
                                    
                                </div>
                                @if(session('success2'))
                                    <p style="color:red">{{session('success2')}}</p>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- newsletter_section - end
            ================================================== -->
        
        </main>
        <!-- main body - end
        ================================================== -->
        
        <!-- footer_section - start
        ================================================== -->
        <footer class="footer_section">
            <div class="footer_widget_area">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-4 col-md-6 col-sm-6">
                            <div class="footer_widget footer_about">
                                <div class="brand_logo">
                                    <a class="brand_link" href="{{url('/')}}">
                                        <img src="{{asset('frontend_assets/images/logo/logo_1x.png')}}" srcset="assets/images/logo/logo_2x.png 2x" alt="logo_not_found">
                                    </a>
                                </div>
                                <ul class="social_round ul_li">
                                    
                                    <li><a href="https://www.instagram.com" target="_blank"><i class="icofont-instagram"></i></a></li>
                                    <li><a href="https://www.twitter.com" target="_blank"><i class="icofont-twitter"></i></a></li>
                                    <li><a href="https://www.facebook.com" target="_blank"><i class="icofont-facebook"></i></a></li>
                                    <li><a href="https://www.linkedin.com" target="_blank"><i class="icofont-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col col-lg-2 col-md-3 col-sm-6">
                            <div class="footer_widget footer_useful_links">
                                <h3 class="footer_widget_title text-uppercase">Quick Links</h3>
                                <ul class="ul_li_block">
                                    <li><a href="{{url('/about_us')}}">About Us</a></li>
                                    <li><a href="{{url('/contact_us')}}">Contact Us</a></li>
                                    <li><a href="{{url('/shop')}}">Products</a></li>
                                    <li><a href="{{url('/about_us')}}">Team</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col col-lg-2 col-md-3 col-sm-6">
                            <div class="footer_widget footer_useful_links">
                                <h3 class="footer_widget_title text-uppercase">Custom area</h3>
                                <ul class="ul_li_block">
                                    @auth('logan')
                                    <li><a href="{{url('/account')}}">My Account</a></li>
                                    @else
                                    <li><a href="{{url('/log_reg')}}">My Account</a></li>
                                    <li><a href="{{url('/log_reg')}}">Login</a></li>
                                    <li><a href="{{url('/log_reg')}}">register</a></li>
                                    @endauth
                                    <li><a href="{{url('about_us')}}">Privacy Policy</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col col-lg-4 col-md-6 col-sm-6">
                            <div class="footer_widget footer_contact">
                                <h3 class="footer_widget_title text-uppercase">Contact Info</h3>
                                <h6>
                                    You can find us on this location.
                                </h6>
                                <b>house#44,uttara,section#7,road#12,dhaka-1350</b>
                                <div class="hotline_wrap">
                                    <div class="footer_hotline">
                                        <div class="item_icon">
                                            <i class="icofont-headphone-alt"></i>
                                        </div>
                                        <div class="item_content">
                                            <h4 class="item_title">Have any question?</h4>
                                            <span class="hotline_number">+1234567890</span>
                                        </div>
                                    </div>
                                    <div class="livechat_btn clearfix">
                                        <a class="btn border_primary" href="#!">Live Chat</a>
                                    </div>
                                </div>
                                <ul class="store_btns_group ul_li">
                                    <li><a href="https://www.apple.com/app-store/" target="_blank"><img src="{{asset('frontend_assets/images/app_store.png')}}" alt="app_store"></a></li>
                                    <li><a href="https://play.google.com/store/games" target="_blank"><img src="{{asset('frontend_assets/images/play_store.png')}}" alt="play_store"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="footer_bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col col-md-6">
                            <p class="copyright_text">
                                ©2021 <a href="#!">stowaa</a>. All Rights Reserved.
                            </p>
                        </div>
                        
                        <div class="col col-md-6">
                            <div class="payment_method">
                                <h4>Payment:</h4>
                                <img src="{{asset('frontend_assets/images/payments_icon.png')}}" alt="image_not_found">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </footer>
        <!-- footer_section - end
        ================================================== -->
    
    </div>
    <!-- body_wrap - end -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- fraimwork - jquery include -->
    <script src="{{asset('frontend_assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/popper.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/bootstrap.min.js')}}"></script>

    <!-- carousel - jquery plugins collection -->
    <script src="{{asset('frontend_assets/js/jquery-plugins-collection.js')}}"></script>

    <!-- custom - main-js -->
    <script src="{{asset('frontend_assets/js/main.js')}}"></script>
    

    <script src="https://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
    <script>
        function loadGoogleTranslate(){
            new google.translate.TranslateElement(
                "google_element");
        }
    </script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
@yield('footer')
</body>
</html>