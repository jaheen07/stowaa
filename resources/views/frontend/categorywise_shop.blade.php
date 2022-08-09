 @extends('frontend.master')
 @section('content')
 

            <!-- breadcrumb_section - start
            ================================================== -->
            <div class="breadcrumb_section">
                <div class="container">
                    <ul class="breadcrumb_nav ul_li">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li>Product Grid</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb_section - end
            ================================================== -->

            <!-- product_section - start
            ================================================== -->
            <section class="product_section section_space">
                <h2 class="hidden">Product sidebar</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <aside class="sidebar_section p-0 mt-0">
                                <div class="sb_widget sb_category">
                                    <h2 class="sb_widget_title">Categories</h2>
                                    <ul class="sb_category_list ul_li_block">
                                        <li>
                                            <p><b> >> {{App\Models\category::where('id',$jk_id)->get()->first()->category_name}} </b></p>
                                        </li>
                                        @foreach(App\Models\subcategory::where('under_category',$jk_id)->get() as $subcategory)
                                        <li>
                                               <a href="{{url('/selected_subcategory')}}/{{$jk_id}}/{{$subcategory->subcategory_name}}" class="active">{{$subcategory->subcategory_name}} <span>({{App\Models\product::where('subcategory_name',$subcategory->subcategory_name)->get()->count()}})</span></a>
                                        </li>
                                            @endforeach
                                            
                                        </ul>
                                        
                                </div>


                                <div class="sb_widget">
                                    <h3 class="sb_widget_title">Your Filter</h3>
                                    <div class="filter_sidebar">
                                        <div class="fs_widget">
                                            @if($jk_sub_id == "sub")
                                            <h3 class="fs_widget_title">All products</h3>
                                            @else
                                            <h3 class="fs_widget_title">{{$jk_sub_id}}</h3>
                                            @endif
                                        </div>
                                        

                                        

                                        <!-- <div class="fs_widget">
                                            <h3 class="fs_widget_title">Filter by Color</h3>
                                            <ul class="filter_memory_list ul_li_block">
                                                <li>
                                                    <a href="#!">Red <span>(12)</span></a>
                                                </li>
                                                <li>
                                                    <a href="#!">Green<span>(12)</span></a>
                                                </li>
                                                <li>
                                                    <a href="#!">Blue<span>(6)</span></a>
                                                </li>
                                                <li>
                                                    <a href="#!">Yellow<span>(7)</span></a>
                                                </li>
                                                <li>
                                                    <a href="#!">Black<span>(9)</span></a>
                                                </li>
                                            </ul>
                                        </div> -->
                                    </div>
                                </div>
                            </aside>
                        </div>

                        <div class="col-lg-9">
                            <div class="filter_topbar">
                                <div class="row align-items-center">
                                    <div class="col col-md-4">
                                        <ul class="layout_btns nav" role="tablist">
                                            <li>
                                                <button class="active" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="fal fa-bars"></i></button>
                                            </li>
                                            <li>
                                                <button data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                                    <i class="fal fa-th-large"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col col-md-4">
                                        @if($jk_sub_id == "sub")
                                        <h4 clas="text-center" style="color:#fc034e">All {{App\Models\category::where('id',$jk_id)->get()->first()->category_name}} List</h4>
                                        @else
                                        <h4 clas="text-center" style="color:#fc034e">{{$jk_sub_id}} Product List</h4>
                                        @endif
                                        <!-- <form action="#">
                                            <div class="select_option clearfix">
                                                <select>
                                                    <option data-display="Defaul Sorting">Select Your Option</option>
                                                    <option value="1">Sorting By Name</option>
                                                    <option value="2">Sorting By Price</option>
                                                    <option value="3">Sorting By Size</option>
                                                </select>
                                            </div>
                                        </form> -->
                                    </div>

                                    <div class="col col-md-4">
                                        <div class="result_text">Showing {{$product->count()}} of {{App\Models\product::count()}} results</div>
                                    </div>
                                </div>
                            </div>

                            <hr />

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="home" role="tabpanel">
                                    <div class="shop-product-area shop-product-area-col">
                                        <div class="product-area shop-grid-product-area clearfix">
                                            @if($jk_sub_id == "sub")
                                            @foreach($product as $pro)
                                             <div class="grid">
                                                <div class="product-pic">
                                                    <a href="{{url('product_details')}}/{{$pro->id}}">
                                                        <img src="{{asset('uploads/products/preview')}}/{{$pro->product_image}}" />
                                                    </a>
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
                                                    
                                                    <h4><a href="{{url('/product_details')}}/{{$pro->id}}">{{$pro->product_name}}</a></h4>
                                                    
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
                                                                <bdi> <span class="woocommerce-Price-currencySymbol">BDT {{$pro->product_price}} </bdi>
                                                            </span>
                                                        </ins>
                                                    </span>
                                                    <!-- <div class="add-cart-area">
                                                        <button class="">Add to cart</button>
                                                        
                                                    </div> -->
                                                </div>
                                            </div>


                                            <!-- product quick view modal - start
                                            ================================================== -->
                                            <div class="modal fade" id="all{{$pro->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalToggleLabel2">Product Quick View</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="product_details">
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
                                                                                @if($pro->discount != 0)
                                                                                <span>BDT {{$pro->discount_price}}</span>
                                                                                <del>BDT {{$pro->product_price}}</del>
                                                                                @else
                                                                                <span>BDT {{$pro->product_price}}</span>
                                                                                @endif
                                                                                </div>
                                                                                <hr>

                                                                                <div class="item_attribute">
                                                                                    <form action="#">
                                                                                        <div class="row">
                                                                                            @if($pro->size != NULL)
                                                                                            <div class="col col-md-6">
                                                                                                <div class="select_option clearfix">
                                                                                                    <h4 class="input_title">Size *</h4>
                                                                                                    <p>{{$pro->size}}</p>
                                                                                                </div>
                                                                                            </div>
                                                                                            @endif

                                                                                            @if($pro->color != NULL)
                                                                                            <div class="col col-md-6">
                                                                                                <div class="select_option clearfix">
                                                                                                    <h4 class="input_title">Color *</h4>
                                                                                                    <h5>{{$pro->color}}</h5>
                                                                                                </div>
                                                                                            </div>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div> 
                                                                                </div>
                                                                            </form>
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
                                           
                                           
                                            @else
                                            @foreach($product as $pro)
                                            @if($pro->subcategory_name == $jk_sub_id) 
                                            <div class="grid">
                                                <div class="product-pic">
                                                    <a href="{{url('product_details')}}/{{$pro->id}}">
                                                        <img src="{{asset('uploads/products/preview')}}/{{$pro->product_image}}" />
                                                    </a>
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
                                                    
                                                    <h4><a href="{{url('/product_details')}}/{{$pro->id}}">{{$pro->product_name}}</a></h4>
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
                                                                <bdi> <span class="woocommerce-Price-currencySymbol">BDT </span>{{$pro->product_price}} </bdi>
                                                            </span>
                                                        </ins>
                                                    </span>
                                                    <!-- <div class="add-cart-area">
                                                        <button class="add-to-cart">Add to cart</button>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <!-- product quick view modal - start
                                            ================================================== -->
                                            <div class="modal fade" id="all{{$pro->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalToggleLabel2">Product Quick View</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="product_details">
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
                                                                                @if($pro->discount != 0)
                                                                                <span>BDT {{$pro->discount_price}}</span>
                                                                                <del>BDT {{$pro->product_price}}</del>
                                                                                @else
                                                                                <span>BDT {{$pro->product_price}}</span>
                                                                                @endif
                                                                                </div>
                                                                                <hr>

                                                                                <div class="item_attribute">
                                                                                    <form action="#">
                                                                                        <div class="row">
                                                                                            @if($pro->size != NULL)
                                                                                            <div class="col col-md-6">
                                                                                                <div class="select_option clearfix">
                                                                                                    <h4 class="input_title">Size *</h4>
                                                                                                    <p>{{$pro->size}}</p>
                                                                                                </div>
                                                                                            </div>
                                                                                            @endif

                                                                                            @if($pro->color != NULL)
                                                                                            <div class="col col-md-6">
                                                                                                <div class="select_option clearfix">
                                                                                                    <h4 class="input_title">Color *</h4>
                                                                                                    <h5>{{$pro->color}}</h5>
                                                                                                </div>
                                                                                            </div>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div> 
                                                                                </div>
                                                                            </form>
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

                                            @endif    
                                        </div>
                                    </div>

                                    <div class="pagination_wrap">
                                        <ul class="pagination_nav">
                                            <li class="prev_btn">
                                                
                                                {{$product->links()}}
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="profile" role="tabpanel">
                                    <div class="product_layout2_wrap">
                                        <div class="product-area-row">
                                            @if($jk_sub_id == "sub")
                                            @foreach($product as $pro)
                                            <div class="modal fade" id="all_{{$pro->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalToggleLabel2">Product Quick View</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="product_details">
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
                                                                                @if($pro->discount != 0)
                                                                                <span>BDT {{$pro->discount_price}}</span>
                                                                                <del>BDT {{$pro->product_price}}</del>
                                                                                @else
                                                                                <span>BDT {{$pro->product_price}}</span>
                                                                                @endif
                                                                                </div>
                                                                                <hr>

                                                                                <div class="item_attribute">
                                                                                    <form action="#">
                                                                                        <div class="row">
                                                                                            @if($pro->size != NULL)
                                                                                            <div class="col col-md-6">
                                                                                                <div class="select_option clearfix">
                                                                                                    <h4 class="input_title">Size *</h4>
                                                                                                    <p>{{$pro->size}}</p>
                                                                                                </div>
                                                                                            </div>
                                                                                            @endif

                                                                                            @if($pro->color != NULL)
                                                                                            <div class="col col-md-6">
                                                                                                <div class="select_option clearfix">
                                                                                                    <h4 class="input_title">Color *</h4>
                                                                                                    <h5>{{$pro->color}}</h5>
                                                                                                </div>
                                                                                            </div>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div> 
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grid clearfix">
                                                <div class="product-pic">
                                                    <a href="{{url('product_details')}}/{{$pro->id}}">
                                                        <img src="{{asset('uploads/products/preview')}}/{{$pro->product_image}}" alt />
                                                    </a>
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
                                                                <button class="quickview_btn" data-bs-toggle="modal" href="#all_{{$pro->id}}" role="button" tabindex="0"><svg width="48px" height="48px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Visible (eye)</title> <path d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z"/> <circle cx="12" cy="12" r="3"/> </svg></button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="details">
                                                <h4><a href="{{url('/product_details')}}/{{$pro->id}}">{{$pro->product_name}}</a></h4>
                                                    
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
                                                                <bdi> <span class="woocommerce-Price-currencySymbol">BDT {{$pro->product_price}}</bdi>
                                                            </span>
                                                        </ins>
                                                    </span>
                                                    
                                                </div>
                                            </div>
                                            
                                            @endforeach

                                            @else
                                            @foreach($product as $pro)
                                            @if($pro->subcategory_name == $jk_sub_id) 
                                            <div class="grid clearfix">
                                                <div class="product-pic">
                                                    <a href="{{url('product_details')}}/{{$pro->id}}">
                                                        <img src="{{asset('uploads/products/preview')}}/{{$pro->product_image}}" alt />
                                                    </a>
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
                                                                <button class="quickview_btn" data-bs-toggle="modal" href="#all_{{$pro->id}}" role="button" tabindex="0"><svg width="48px" height="48px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke="#2329D6" stroke-width="1" stroke-linecap="square" stroke-linejoin="miter" fill="none" color="#2329D6"> <title>Visible (eye)</title> <path d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z"/> <circle cx="12" cy="12" r="3"/> </svg></button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="details">
                                                    <h4><a href="{{url('/product_details')}}/{{$pro->id}}">{{$pro->product_name}}</a></h4>
                                                    
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
                                                                <bdi> <span class="woocommerce-Price-currencySymbol">BDT {{$pro->product_price}} </bdi>
                                                            </span>
                                                        </ins>
                                                    </span>
                                                    <!-- <div class="add-cart-area">
                                                    <a class="btn btn_primary add-to-cart" href="{{url('product_details')}}/{{$pro->id}}">Add To Cart</a>
                                                    </div> -->
                                                </div>
                                            </div>


                                            <div class="modal fade" id="all_{{$pro->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalToggleLabel2">Product Quick View</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="product_details">
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
                                                                                @if($pro->discount != 0)
                                                                                <span>BDT {{$pro->discount_price}}</span>
                                                                                <del>BDT {{$pro->product_price}}</del>
                                                                                @else
                                                                                <span>BDT {{$pro->product_price}}</span>
                                                                                @endif
                                                                                </div>
                                                                                <hr>

                                                                                <div class="item_attribute">
                                                                                    <form action="#">
                                                                                        <div class="row">
                                                                                            @if($pro->size != NULL)
                                                                                            <div class="col col-md-6">
                                                                                                <div class="select_option clearfix">
                                                                                                    <h4 class="input_title">Size *</h4>
                                                                                                    <p>{{$pro->size}}</p>
                                                                                                </div>
                                                                                            </div>
                                                                                            @endif

                                                                                            @if($pro->color != NULL)
                                                                                            <div class="col col-md-6">
                                                                                                <div class="select_option clearfix">
                                                                                                    <h4 class="input_title">Color *</h4>
                                                                                                    <h5>{{$pro->color}}</h5>
                                                                                                </div>
                                                                                            </div>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div> 
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                            @endif
                                            
                                        </div>
                                    </div>

                                    <div class="pagination_wrap">
                                        <ul class="pagination_nav">
                                        {{$product->links()}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- product_section - end
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