@extends('frontend.master')

@section('content')           
           

            
            <!-- slider_section - start
            ================================================== -->
            <section class="slider_section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 offset-lg-3">
                            <div class="main_slider" data-slick='{"arrows": false}'>
                                @foreach(App\Models\banner::all() as $bn)
                                @if($bn->banner_number == 0 || $bn->banner_number == 1)
                                <div class="slider_item set-bg-image" data-background="{{asset('/uploads/banner')}}/{{$bn->banner_image}}">
                                    @if($bn->banner_number == 1)
                                    <a class="btn btn_primary" style="margin-top:50%" href="{{url('/product_details')}}/{{$bn->product_id}}">Start Buying</a>
                                    @endif
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- slider_section - end
            ================================================== -->
            
            <!-- policy_section - start
            ================================================== -->
            <section class="policy_section">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="policy-wrap">
                                <div class="policy_item">
                                    <div class="item_icon">
                                        <i class="icon icon-Truck"></i>
                                    </div>
                                    <div class="item_content">
                                        <h3 class="item_title">Free Shipping</h3>
                                        <p>
                                            Free shipping on all US order
                                        </p>
                                    </div>
                                </div>
        
                                <div class="policy_item">
                                    <div class="item_icon">
                                        <i class="icon icon-Headset"></i>
                                    </div>
                                    <div class="item_content">
                                        <h3 class="item_title">Support 24/ 7</h3>
                                        <p>
                                            Contact us 24 hours a day
                                        </p>
                                    </div>
                                </div>
        
                                <div class="policy_item">
                                    <div class="item_icon">
                                        <i class="icon icon-Wallet"></i>
                                    </div>
                                    <div class="item_content">
                                        <h3 class="item_title">100% Money Back</h3>
                                        <p>
                                            You have 30 days to Return
                                        </p>
                                    </div>
                                </div>
        
                                <div class="policy_item">
                                    <div class="item_icon">
                                        <i class="icon icon-Starship"></i>
                                    </div>
                                    <div class="item_content">
                                        <h3 class="item_title">90 Days Return</h3>
                                        <p>
                                            If goods have problems
                                        </p>
                                    </div>
                                </div>
        
                            </div>
                        </div>
                    </div>
                </div>

            </section>
            <!-- policy_section - end
            ================================================== -->
        
            
            <!-- products-with-sidebar-section - start
            ================================================== -->
            <section class="products-with-sidebar-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 order-lg-3">
                            <div class="best-selling-products">
                                <div class="sec-title-link">
                                    <h3>Best selling</h3>
                                    <div class="view-all"><a href="{{url('/shop')}}">View all<i class="fal fa-long-arrow-right"></i></a></div>
                                </div>
                                <div class="product-area clearfix">
                                    
                                    @foreach(App\Models\product::all()->take(10) as $pro)
                                    @if($pro->total_sold > 10)
                                    <div class="grid">
                                        <div class="product-pic">
                                            <a href="{{url('product_details')}}/{{$pro->id}}">
                                                <img src="{{asset('/uploads/products/preview')}}/{{$pro->product_image}}" alt>
                                            </a>
                                            @if($pro->discount != 0 )
                                            <span class="theme-badge-2">{{$pro->discount}}% off</span>
                                            @endif
                                            <div class="actions">
                                                <ul>
                                                    <li>
                                                        @auth('logan')
                                                        <button class="wishlist" value="{{$pro->id}}">
                                                            @if(App\Models\wishlist::where('product_id',$pro->id)->exists())
                                                            <svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="#f02757" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/></svg>
                                                            @else
                                                            <svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/></svg>
                                                            @endif 
                                                        </button>
                                                        @else
                                                        <button class="loging_alert"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" @if(1) fill="#f02757" @endif color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg></button>
                                                        @endauth
                                                    </li>
                                                    
                                                    <li>
                                                        <button  data-bs-toggle="modal" href="#all{{$pro->id}}" role="button" tabindex="0"><svg width="48px" height="48px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Visible (eye)</title> <path d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z"/> <circle cx="12" cy="12" r="3"/> </svg></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="details">
                                            <h4><a href="{{url('product_details')}}/{{$pro->id}}">{{$pro->product_name}}</a></h4>
                                            
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                            </div>
                                            
                                            <span class="price">
                                                
                                                <ins>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi>
                                                            <span class="woocommerce-Price-currencySymbol">BDT </span>{{$pro->discount_price}}
                                                        </bdi>
                                                    </span>
                                                </ins>
                                                @if($pro->discount !=0)
                                                <del aria-hidden="true">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi>
                                                            <span class="woocommerce-Price-currencySymbol">BDT </span>{{$pro->product_price}}
                                                        </bdi>
                                                    </span>
                                                </del>
                                                @endif
                                            </span>
                                            

                                            <!-- <div class="add-cart-area">
                                                <button class="add-to-cart">Add to cart</button>
                                                
                                            </div> -->
                                        </div>
                                    </div>
<!-- product quick view modal - start
================================================== -->
                                    <div class="modal fade" id="all{{$pro->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered ">
                                            <div class="modal-content ">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalToggleLabel2">Product Quick View</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                               
                                                <div class="modal-body">
                                                    <div class="product_details ">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col col-lg-6">
                                                                    @if(App\Models\productThumbnail::where('product_id',$pro->id)->count() == 1)
                                                                        <div>
                                                                        <img src="{{asset('/uploads/products/preview')}}/{{$pro->product_image}}" alt>
                                                                        </div>
                                                                    @else
                                                                    <div class="main_slider" data-slick='{"arrows": false}'>
                                                                        @foreach(App\Models\productThumbnail::where('product_id',$pro->id)->get() as $prt)
                                                                        <img class="product_details_image p-0" src="{{asset('/uploads/products/thumbnails')}}/{{$prt->product_thumbnail_name}}" alt>                                                                      
                                                                        @endforeach
                                                                    </div>
                                                                    @endif 
                                                                
                                                                        <!-- <div class="product_details_image p-0">
                                                                        <img src="{{asset('/uploads/products/preview')}}/{{$pro->product_image}}" alt>
                                                                        </div> -->
                                                                </div>
                                                                
                                                                <div class="col-lg-6">
                                                                <div class="product_details_content">
                                                                    <h2 class="item_title">{{$pro->product_name}}</h2>
                                                                    <p>{{$pro->description}}</p>
                                                                    <div class="item_review">
                                                                        <ul class="rating_star ul_li">
                                                                            <li><i class="fas fa-star"></i>></li>
                                                                            <li><i class="fas fa-star"></i></li>
                                                                            <li><i class="fas fa-star"></i></li>
                                                                            <li><i class="fas fa-star"></i></li>
                                                                            <li><i class="fas fa-star-half-alt"></i></li>
                                                                        </ul>
                                                                        <span class="review_value">3 Rating(s)</span>
                                                                    </div>

                                                                    <div class="item_price">
                                                                        @if($pro->discount > 0)
                                                                        <span>BDT {{$pro->discount_price}}</span>
                                                                        <del>BDT {{$pro->product_price}}</del>
                                                                        @else
                                                                        <span>BDT {{$pro->product_price}}</span>
                                                                        @endif
                                                                    </div>
                                                                    <hr>

                                                                    <div class="item_attribute">
                                                                        <div class="row">
                                                                            @if($pro->size != NULL)
                                                                            <div class="col col-md-6">
                                                                                <div class="select_option clearfix">
                                                                                    <h3 class="input_title">Size *</h3>
                                                                                    <h6>{{$pro->size}}</h6>
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                            @if($pro->color != NULL)
                                                                            <div class="col col-md-6">
                                                                                <div class="select_option clearfix">
                                                                                    <h3 class="input_title">Color *</h3>
                                                                                    <h6>{{$pro->color}}</h6>
                                                                                </div>
                                                                            </div>
                                                                            @endif
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
                                </div>
<!-- product quick view modal - end
================================================== -->
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="top_category_wrap">
                                <div class="sec-title-link">
                                    <h3>Top categories</h3>
                                </div>
                                <div class="top_category_carousel2" data-slick='{"dots": false}'>
                                    @php
                                     $n=0;
                                    @endphp
                                    @foreach(App\Models\category::all() as $key=>$ct)
                                    <div class="slider_item">
                                        <div class="category_boxed">
                                            <a href="{{url('/categorywise_shop')}}/{{$ct->id}}/{{'sub'}}">
                                                  <span class="item_image">
                                                      <img src="{{asset('uploads/category')}}/{{$ct->category_image}}" alt="image_not_found">
                                                  </span>
                                                <span class="item_title">{{$ct->category_name}}</span>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach  
                                </div>
                                <div class="carousel_nav carousel-nav-top-right">
                                    <button type="button" class="tc_left_arrow"><i class="fal fa-long-arrow-alt-left"></i></button>
                                    <button type="button" class="tc_right_arrow"><i class="fal fa-long-arrow-alt-right"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 order-lg-9">
                            <div class="product-sidebar">
                                <div class="widget latest_product_carousel">
                                    <div class="title_wrap">
                                        <h3 class="area_title">Latest Products</h3>
                                        <div class="carousel_nav">
                                            <button type="button" class="vs4i_left_arrow"><i class="fal fa-angle-left"></i></button>
                                            <button type="button" class="vs4i_right_arrow"><i class="fal fa-angle-right"></i></button>
                                        </div>
                                    </div>
                                    <div class="vertical_slider_4item" data-slick='{"dots": false}'>
                                      @foreach(App\Models\product::latest()->take(5)->get() as $pro)  
                                        <div class="slider_item">
                                            <div class="small_product_layout">
                                                <a class="item_image" href="{{url('product_details')}}/{{$pro->id}}">
                                                    <img src="{{asset('uploads/products/preview')}}/{{$pro->product_image}}" alt="image_not_found">
                                                </a>
                                                <div class="item_content">
                                                    <h3 class="item_title">
                                                        <a href="{{url('product_details')}}/{{$pro->id}}">{{$pro->product_name}}</a>
                                                    </h3>
                                                    <ul class="rating_star ul_li">
                                                        <li>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star-half-alt"></i>
                                                        </li>
                                                    </ul>
                                                    <div class="item_price">
                                                        @if($pro->discount > 0)
                                                        <del>BDT {{$pro->product_price}}</del>
                                                        <span>BDT {{$pro->discount_price}}</span>
                                                        @else
                                                         <span>BDT {{$pro->product_price}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                      @endforeach     
                                    </div>
                                    
                                </div>

                                <div class="card" style="height:21rem">
                                    <img src="{{asset('uploads/banner')}}/{{App\models\banner::where('banner_number',2)->first()->get()->banner_image}}" width="100%" height="100%">
                                    <div class="card-img-overlay">
                                        <a class="btn btn-danger mx-3 mb-3" href="{{url('/product_details')}}/{{App\models\banner::where('banner_number',3)->get()->first()->product_id}}" style="position:relative;top:80%">Start Buying</a>
                                    </div>
                                </div>

                                <div class="card my-5" style="height:21rem">
                                    <img src="{{asset('uploads/banner')}}/{{App\models\banner::where('banner_number',2)->get()->first()->banner_image}}" width="100%" height="100%">
                                    <div class="card-img-overlay">
                                        <a class="btn btn-danger mx-3 mb-3" href="{{url('/product_details')}}/{{App\models\banner::where('banner_number',3)->get()->first()->product_id}}" style="position:relative;top:80%">Start Buying</a>
                                    </div>
                                </div>
                                <!-- <div class="widget product-add p-0">
                                    <a class="btn btn-danger mx-3 mb-3" href="{{url('/product_details')}}/{{App\models\banner::where('banner_number',2)->get()->first()->product_id}}" style="z-index:1">Start Buying</a>  
                                </div> -->

                                <!-- <div class="widget product-add my-3 p-0">

                                    <img src="{{asset('uploads/banner')}}/{{App\models\banner::where('banner_number',2)->get()->first()->banner_image}}" width="100%" height="100%">
                                    <div class="jaheen">
                                       <a class="btn btn-danger mx-3 mb-3" href="{{url('/product_details')}}/{{App\models\banner::where('banner_number',3)->get()->first()->product_id}}" style="z-index:1">Start Buying</a> 
                                    </div>
                                      
                                </div> -->
                                
                            </div>
                        </div>
                    </div>
                </div> <!-- end container  -->
            </section>
            <!-- products-with-sidebar-section - end
            ================================================== -->
            
            
            <!-- promotion_section - start
            ================================================== -->
            <section class="promotion_section">
                <div class="container">
                    <div class="row promotion_banner_wrap">
                        <div class="col col-lg-6">
                            <div class="promotion_banner">
                                    <img src="{{asset('uploads/banner')}}/{{App\models\banner::where('banner_number',4)->get()->first()->banner_image}}" height="100%">
                                    
                               <div class="item_content">
                               <a class="btn btn-danger mb-3" href="{{url('/product_details')}}/{{App\models\banner::where('banner_number',4)->get()->first()->product_id}}" style="z-index:1">Start Buying</a>
                               </div>
                            </div>
                        </div>
                        
                        <div class="col col-lg-6">
                            <div class="promotion_banner">
                                
                                <img src="{{asset('uploads/banner')}}/{{App\models\banner::where('banner_number',5)->get()->first()->banner_image}}">
                                <div class="item_content">
                                    <a class="btn btn-danger mb-3" href="{{url('/product_details')}}/{{App\models\banner::where('banner_number',5)->get()->first()->product_id}}">Start Buying</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- promotion_section - end
            ================================================== -->
            
            <!-- new_arrivals_section - start
            ================================================== -->
            <section class="new_arrivals_section section_space">
                <div class="container">
                    <div class="sec-title-link">
                        <h3>New Arrivals</h3>
                    </div>
                    
                    <div class="row newarrivals_products">
                        <div class="col col-lg-5">
                            <div class="deals_product_layout1">
                                <div class="bg_area"style="
                                 background: url('{{asset('/uploads/banner')}}/{{App\Models\banner::where('banner_number',6)->get()->first()->banner_image}}') center center/cover no-repeat local;">
                                
                                    <h3 class="item_title">Best <span>Product</span> Deals</h3>
                                    <p>
                                        Get a 20% Cashback when buying TWS Product From SoundPro Audio Technology.
                                    </p>
                                    <a class="btn btn_primary" href="{{url('/product_details')}}/{{App\models\banner::where('banner_number',6)->get()->first()->product_id}}">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col col-lg-7">
                            <div class="new-arrivals-grids clearfix">
                                @foreach(App\Models\product::latest()->take(4)->get() as $pro)
                                <div class="grid">
                                        <div class="product-pic">
                                            <a href="{{url('product_details')}}/{{$pro->id}}">
                                                <img src="{{asset('/uploads/products/preview')}}/{{$pro->product_image}}" alt>
                                            </a>
                                            @if($pro->discount != 0 )
                                            <span class="theme-badge-2">{{$pro->discount}}% off</span>
                                            @endif
                                            <div class="actions">
                                                <ul>
                                                    <li>
                                                        @auth('logan')
                                                        <button class="wishlist" value="{{$pro->id}}">
                                                            @if(App\Models\wishlist::where('product_id',$pro->id)->exists())
                                                            <svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="#f02757" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/></svg>
                                                            @else
                                                            <svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/></svg>
                                                            @endif 
                                                        </button>
                                                        @else
                                                        <button class="loging_alert"><svg role="img" xmlns="http://www.w3.org/2000/svg" width="48px" height="48px" viewBox="0 0 24 24"  stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" @if(1) fill="#f02757" @endif color="#2329D6"> <title>Favourite</title> <path d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"/> </svg></button>
                                                        @endauth
                                                    </li>
                                                    
                                                    <li>
                                                        <button class="quickview_btn" data-bs-toggle="modal" href="#all{{$pro->id}}" role="button" tabindex="0"><svg width="48px" height="48px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Visible (eye)</title> <path d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z"/> <circle cx="12" cy="12" r="3"/> </svg></button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="details">
                                            <h4><a href="{{url('product_details')}}/{{$pro->id}}">{{$pro->product_name}}</a></h4>
                                            
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                            </div>
                                            
                                            <span class="price">
                                                
                                                <ins>
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi>
                                                            <span class="woocommerce-Price-currencySymbol">BDT </span>{{$pro->discount_price}}
                                                        </bdi>
                                                    </span>
                                                </ins>
                                                @if($pro->discount !=0)
                                                <del aria-hidden="true">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <bdi>
                                                            <span class="woocommerce-Price-currencySymbol">BDT </span>{{$pro->product_price}}
                                                        </bdi>
                                                    </span>
                                                </del>
                                                @endif
                                            </span>
                                            

                                            <!-- <div class="add-cart-area">
                                                <button class="add-to-cart">Add to cart</button>
                                                
                                            </div> -->
                                        </div>
                                    </div>
<!-- product quick view modal - start
================================================== -->
                                    <div class="modal fade" id="all{{$pro->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered ">
                                            <div class="modal-content ">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalToggleLabel2">Product Quick View</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                               
                                                <div class="modal-body">
                                                    <div class="product_details ">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col col-lg-6">
                                                                    @if(App\Models\productThumbnail::where('product_id',$pro->id)->count() == 1)
                                                                        <div>
                                                                        <img src="{{asset('/uploads/products/preview')}}/{{$pro->product_image}}" alt>
                                                                        </div>
                                                                    @else
                                                                    <div class="main_slider" data-slick='{"arrows": false}'>
                                                                        @foreach(App\Models\productThumbnail::where('product_id',$pro->id)->get() as $prt)
                                                                        <img class="product_details_image p-0" src="{{asset('/uploads/products/thumbnails')}}/{{$prt->product_thumbnail_name}}" alt>                                                                      
                                                                        @endforeach
                                                                    </div>
                                                                    @endif 
                                                                
                                                                        <!-- <div class="product_details_image p-0">
                                                                        <img src="{{asset('/uploads/products/preview')}}/{{$pro->product_image}}" alt>
                                                                        </div> -->
                                                                </div>
                                                                
                                                                <div class="col-lg-6">
                                                                <div class="product_details_content">
                                                                    <h2 class="item_title">{{$pro->product_name}}</h2>
                                                                    <p>{{$pro->description}}</p>
                                                                    <div class="item_review">
                                                                        <ul class="rating_star ul_li">
                                                                            <li><i class="fas fa-star"></i>></li>
                                                                            <li><i class="fas fa-star"></i></li>
                                                                            <li><i class="fas fa-star"></i></li>
                                                                            <li><i class="fas fa-star"></i></li>
                                                                            <li><i class="fas fa-star-half-alt"></i></li>
                                                                        </ul>
                                                                        <span class="review_value">3 Rating(s)</span>
                                                                    </div>

                                                                    <div class="item_price">
                                                                        @if($pro->discount > 0)
                                                                        <span>BDT {{$pro->discount_price}}</span>
                                                                        <del>BDT {{$pro->product_price}}</del>
                                                                        @else
                                                                        <span>BDT {{$pro->product_price}}</span>
                                                                        @endif
                                                                    </div>
                                                                    <hr>

                                                                    <div class="item_attribute">
                                                                        <div class="row">
                                                                            @if($pro->size != NULL)
                                                                            <div class="col col-md-6">
                                                                                <div class="select_option clearfix">
                                                                                    <h3 class="input_title">Size *</h3>
                                                                                    <h6>{{$pro->size}}</h6>
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                            @if($pro->color != NULL)
                                                                            <div class="col col-md-6">
                                                                                <div class="select_option clearfix">
                                                                                    <h3 class="input_title">Color *</h3>
                                                                                    <h6>{{$pro->color}}</h6>
                                                                                </div>
                                                                            </div>
                                                                            @endif
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
                                </div>
<!-- product quick view modal - end
================================================== -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- new_arrivals_section - end
            ================================================== -->
            
            <!-- brand_section - start
            ================================================== -->
            <div class="brand_section pb-0">
                <div class="container">
                    <div class="brand_carousel">
                        <div class="slider_item">
                            <a class="product_brand_logo" href="https://graphicriver.net/" target="_blank">
                                <img src="{{asset('frontend_assets/images/brand/brand_1.png')}}" alt="image_not_found">
                                <img src="{{asset('frontend_assets/images/brand/brand_1.png')}}" alt="image_not_found">
                            </a>
                        </div>
                        <div class="slider_item">
                            <a class="product_brand_logo" href="https://www.themeforest.net/" target="_blank">
                                <img src="{{asset('frontend_assets/images/brand/brand_2.png')}}" alt="image_not_found">
                                <img src="{{asset('frontend_assets/images/brand/brand_2.png')}}" alt="image_not_found">
                            </a>
                        </div>
                        <div class="slider_item">
                            <a class="product_brand_logo" href="https://www.codecanyon.net/" target="_blank" >
                                <img src="{{asset('frontend_assets/images/brand/brand_3.png')}}" alt="image_not_found">
                                <img src="{{asset('frontend_assets/images/brand/brand_3.png')}}" alt="image_not_found">
                            </a>
                        </div>
                        <div class="slider_item">
                            <a class="product_brand_logo" href="https://photodune.net/" target="_blank" >
                                <img src="{{asset('frontend_assets/images/brand/brand_4.png')}}" alt="image_not_found">
                                <img src="{{asset('frontend_assets/images/brand/brand_4.png')}}" alt="image_not_found">
                            </a>
                        </div>
                        <div class="slider_item">
                            <a class="product_brand_logo" href="https://videohive.net/" target="_blank" >
                                <img src="{{asset('frontend_assets/images/brand/brand_5.png')}}" alt="image_not_found">
                                <img src="{{asset('frontend_assets/images/brand/brand_5.png')}}" alt="image_not_found">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- brand_section - end
            ================================================== -->
            
         

@endsection

@section('footer')

<script>
    $('.loging_alert').click(function(){
        alert('you have to sign-in first to add the product into wishlist ');
    });
</script>
<script>
    $('.wishlist').click(function(){
        var wish_id = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            type:'GET',
            url:'/getbooked',
            data:{jaheen:wish_id},
            success:function(data,wish_id){
                alert(data);
                
            }
        })
    });
</script>
@endsection