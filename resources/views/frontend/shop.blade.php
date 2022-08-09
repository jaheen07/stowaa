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
                        <div class="col-lg">
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
                                        <h4 class="text-center">All product's</h4>
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

                            <hr>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="home" role="tabpanel">
                                    <div class="shop-product-area shop-product-area-col">
                                        <div class="product-area shop-grid-product-area clearfix">
                                            
                                            @foreach($product as $pro)
                                            
                                                <div class="grid w-15">
                                                    <div class="product-pic">
                                                        <a href="{{url('product_details')}}/{{$pro->id}}">
                                                            <img src="{{asset('uploads/products/preview')}}/{{$pro->product_image}}" alt />
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
                                            @foreach($product as $pro)    
                                            <div class="grid clearfix">
                                                <div class="product-pic">
                                                    <a  href="{{url('product_details')}}/{{$pro->id}}">
                                                        <img src="{{asset('uploads/products/preview')}}/{{$pro->product_image}}" alt />
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
                                                        
                                                    </div> -->
                                                </div>
                                            </div>


                                            <!-- product quick view modal - start
                                            ================================================== -->
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
                                                                                    
                                                                                        <div class="row">
                                                                                            @if($pro->size != NULL)
                                                                                            <div class="col col-md-6">
                                                                                                <div class="select_option clearfix">
                                                                                                    <h3 class="input_title">Size *</h3>
                                                                                                    <h6>{{$pro->size}}</h6>
                                                                                                </div>
                                                                                            </div>
                                                                                            @endif
                                                                                            @if($pro->color !=NULL)
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

                                    <!-- <div class="pagination_wrap">
                                        <ul class="pagination_nav">
                                            <li class="active"><a href="#!">01</a></li>
                                            <li><a href="#!">02</a></li>
                                            <li><a href="#!">03</a></li>
                                            <li class="prev_btn">
                                                <a href="#!"><i class="fal fa-angle-left"></i></a>
                                            </li>
                                            <li class="next_btn">
                                                <a href="#!"><i class="fal fa-angle-right"></i></a>
                                            </li>
                                        </ul>
                                    </div> -->
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