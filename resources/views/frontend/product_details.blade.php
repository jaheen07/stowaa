@extends('frontend.master')
@section('content')
            <!-- breadcrumb_section - start
            ================================================== -->
            <div class="breadcrumb_section">
                <div class="container">
                    <ul class="breadcrumb_nav ul_li">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li>Product Details</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb_section - end
            ================================================== -->

            <!-- product_details - start
            ================================================== -->
            <section class="product_details section_space pb-0">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-6">
                            <div class="product_details_image">
                                <div class="details_image_carousel">
                                   @foreach(App\Models\productThumbnail::where('product_id',$jk_id)->get() as $thumb) 
                                    <div class="slider_item">
                                        <img src="{{asset('/uploads/products/thumbnails')}}/{{$thumb->product_thumbnail_name}}" alt="image_not_found">
                                    </div>
                                    @endforeach
                                    
                                </div>

                                <div class="details_image_carousel_nav">
                                    @foreach(App\Models\productThumbnail::where('product_id',$jk_id)->get() as $thumb) 
                                    <div class="slider_item">
                                        <img src="{{asset('/uploads/products/thumbnails')}}/{{$thumb->product_thumbnail_name}}" alt="image_not_found">
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="product_details_content">
                                <h2 class="item_title">{{$product->product_name}}</h2>
                                <p></p>
                                <div class="item_review">
                                    <ul class="rating_star ul_li">
                                        <li><i class="fas fa-star"></i>></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star-half-alt"></i></li>
                                    </ul>
                                    <span class="review_value">{{$star}} Rating(s)</span>
                                </div>

                                <div class="item_price">
                                    @if($product->discount == 0)
                                    <span>Tk {{$product->product_price}}</span>
                                    @else
                                    <span>Tk {{$product->discount_price}}</span>
                                    <del>Tk {{$product->product_price}}</del>
                                    @endif
                                </div>
                                <hr>

                                <div class="item_attribute">
                                    <form action="{{url('/cart')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" class="id" value="{{$jk_id}}">
                                        <div class="row">
                                            @if($product->size_exists == 'Y' && $product->color !=NULL)
                                                <div class="col col-md-6">
                                                    <div class="select_option clearfix">
                                                        <h4 class="input_title">Color* <span style="color:red">(select color to choose size)</span> </h4>
                                                        
                                                        <select name="color" class="selector color_selector" >
                                                            @foreach($color as $key=>$col)
                                                            <option value="{{$col}}">{{$col}}</option>
                                                             @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col col-md-6">
                                                    <div class=" select_option clearfix ">
                                                        <h4 class="input_title">Size *</h4>
                                                        <select class="selector size_selector" id="size_selector">
                                                            <option data-display="- Please select -">Choose A Option</option>  
                                                        </select>
                                                        <input type="hidden" id="size" name="size" value="">
                                                    </div>
                                                </div>
                                            @else
                                                @if($product->size != NULL)
                                                <div class="col col-md-6">
                                                    <div class="select_option clearfix">
                                                        <h4 class="input_title">Size *</h4>
                                                        <select name="size" class="size_selector">
                                                            @foreach($size as $siz)
                                                            @if(App\Models\inventory::where('product_id',$jk_id)->where('size',$siz)->first()->quantity == '0')
                                                            @else
                                                                <option value="{{$siz}}">{{$siz}}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" class="color_selector" value="{{$product->color}}">
                                                        
                                                    </div>
                                                </div>
                                                @endif
                                                @if($product->color != NULL)
                                                <div class="col col-md-6">
                                                    <div class="select_option clearfix">
                                                        <h4 class="input_title">Color *</h4>
                                                        <select name="color" class="color2_selector">
                                                            <!-- <option data-display="- Please select -">Choose A Option</option> -->
                                                            @foreach($color as $col)
                                                            @if(App\Models\inventory::where('product_id',$jk_id)->where('color',$col)->first()->quantity == '0')
                                                            @else
                                                            <option value="{{$col}}">{{$col}}</option>
                                                            @endif
                                                        @endforeach
                                                        </select>
                                                        <input type="hidden" class="size2_selector" value="{{$product->size}}">
                                                    </div>
                                                </div>
                                                @endif
                                            @endif
                                            
                                        </div>
                                    </div>
                                    @if($product->size_exists == 'N' && $product->color == NULL)
                                    <p><strong>Your choice in stock: <span>{{$product->quantity}}</span> </strong></p>
                                    @else
                                    <p><strong>Your choice in stock: <span class="stock"></span> </strong></p>
                                    @endif
                                    <div class="quantity_wrap">
                                        <div class="quantity_input">
                                            <button type="button"  onclick = "changecounter('minus')">
                                                <i class="fal fa-minus"></i>
                                            </button>
                                            
                                            <input type="text" id="counter" value="1" readonly name="qnty">
                                            <button  type="button" class="plus" onclick ="changecounter('plus')" >
                                                <i class="fal fa-plus"></i>
                                            </button>
                                        </div>
                                        
                                        <div class="total_price">
                                            Total:
                                            @if($product->discount == 0)
                                            <input type="hidden" id="hidevalue" value="{{$product->product_price}}">
                                            <span id="price">{{$product->product_price}}</span> Tk
                                            <input type="text" hidden id="price2" name ="price" value="{{$product->product_price}}">
                                            @else
                                            <input type="hidden" id="hidevalue" value="{{$product->discount_price}}">
                                            <span id="price">{{$product->discount_price}}</span> Tk
                                            <input type="text" hidden id="price2" name="price" value="{{$product->product_price}}">
                                            @endif
                                        </div>
                                    </div>
                                    <span hidden class="excide"></span>
                                    <p style="color:red"> <span class="mssg"></span>  </p>
                                    <ul class="default_btns_group ul_li">
                                        @auth('logan')
                                        <li><button title="Add To Cart" class="btn btn_primary addtocart_btn">Add To Cart</button></li>
                                        @endauth
                                    </ul> 
                                </form>      
                                @auth('logan')
                                @else
                                <form action="{{url('/log_reg')}}" method="GET">
                                    <!-- <li><a class="btn btn_primary addtocart_btn" href="{{ url('/log_reg') }}">Add To Cart</a></li> -->
                                    @php
                                    $currentUrl = url()->current();
                                    @endphp
                                    <input type="hidden" name="get_url" value="{{$currentUrl}}">
                                    <button title="Add To Cart" class="btn btn_primary addtocart_btn">Add To Cart</button>
                                </form>
                                @endauth
                            </div>  
                        </div>
                    </div>

                    <div class="details_information_tab">
                        <ul class="tabs_nav nav ul_li" role=tablist>
                            <li>
                                <button class="active" data-bs-toggle="tab" data-bs-target="#description_tab" type="button" role="tab" aria-controls="description_tab" aria-selected="true">
                                Description
                                </button>
                            </li>
                            
                            <li>
                                <button data-bs-toggle="tab" data-bs-target="#reviews_tab" type="button" role="tab" aria-controls="reviews_tab" aria-selected="false">
                                Reviews
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="description_tab" role="tabpanel">
                                <p>{{$product->description}}</p>
                                
                            </div>

                            

                            <div class="tab-pane fade" id="reviews_tab" role="tabpanel">
                                <div class="average_area">
                                    <div class="row align-items-center">
                                        <div class="col-md-12 order-last">
                                            <div class="average_rating_text">
                                                <ul class="rating_star ul_li_center">
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                </ul>
                                                <p class="mb-0">
                                                Average Star Rating: <span>4 out of 5</span> (2 vote)
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach(App\Models\review::where('product_id',$jk_id)->get() as $rv)
                                <div class="customer_reviews">
                                    <div class="customer_review_item clearfix">
                                        <div class="customer_content">
                                            <div class="customer_info">
                                                <h4 class="customer_name mx-0">{{$rv->user_name}}  </h4>
                                                <span class="comment_date mx-2">{{$rv->created_at->format('M d,Y')}}</span>
                                                
                                                
                                            </div>
                                            <ul class="rating_star ul_li">
                                                    @for($i=1;$i<=$rv->stars;$i++)
                                                    <li><i class="fas fa-star"></i></li>
                                                    @endfor
                                                    <span>({{$rv->stars}} stars)</span>
                                                </ul>
                                            <p class="mb-0">{{$rv->comment}}</p>
                                        </div>
                                    </div>  
                                </div>
                                @endforeach
                                @auth('logan')
                                
                                <div class="customer_review_form">
                                    <h4 class="reviews_tab_title">Add a review</h4>
                                    <form action="{{url('/review')}}" method="POST">
                                        @csrf
                                        <div class="your_ratings">
                                            <h5>Your Ratings:</h5>
                                            <i name="1" class="s fal fa-star" id="star1"></i>
                                            <i name="2" class="s fal fa-star" id="star2"></i>
                                            <i name="3" class="s fal fa-star" id="star3"></i>
                                            <i name="4" class="s fal fa-star" id="star4"></i>
                                            <i name="5" class="s fal fa-star" id="star5"></i>
                                        </div>
                                        <input type="text" hidden name="id" value="{{ $jk_id }}">
                                        <input hidden type="text" value="" id="star_id" name="star">
                                        <div class="form_item">
                                            <!-- this is another style to force a user to sign in and then comment. -->
                                          <!-- <a href="" style="display:block"><textarea name="comment" placeholder="Your Review*"></textarea></a> -->
                                          <textarea name="comment" placeholder="Your Review*" style="resize:none"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn_primary">Submit Now</button>
                                    </form>
                                </div>
                                @else
                                <h2 style="color:red"> <i> please login to give review and comment </i></h2>
                                <a href="{{url('/log_reg')}}" class="btn btn_primary">log in</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- product_details - end
            ================================================== -->

            <!-- related_products_section - start
            ================================================== -->
            <section class="related_products_section section_space">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="best-selling-products related-product-area">
                                <div class="sec-title-link">
                                    <h3>Related products</h3>
                                    <div class="view-all"><a href="{{url('/categorywise_shop')}}/{{App\models\category::where('category_name',App\Models\product::where('id',$jk_id)->get()->first()->category_name)->get()->first()->id}}/{{'sub'}}">View all<i class="fal fa-long-arrow-right"></i></a></div>
                                </div>
                                <div class="product-area clearfix">
                                    @foreach(App\models\product::where('category_name',App\Models\product::where('id',$jk_id)->get()->first()->category_name)->get()->take(4) as $pro)
                                    @if($pro->id == $jk_id)

                                    @else
                                    <div class="grid">
                                        <div class="product-pic">
                                            <a href="{{url('product_details')}}/{{$pro->id}}">
                                                <img src="{{asset('uploads/products/preview')}}/{{$pro->product_image}}" />
                                            </a>
                                            <div class="actions">
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <svg
                                                                role="img"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="48px"
                                                                height="48px"
                                                                viewBox="0 0 24 24"
                                                                stroke="#2329D6"
                                                                stroke-width="1"
                                                                stroke-linecap="square"
                                                                stroke-linejoin="miter"
                                                                fill="none"
                                                                color="#2329D6"
                                                            >
                                                                <title>Favourite</title>
                                                                <path
                                                                    d="M12,21 L10.55,19.7051771 C5.4,15.1242507 2,12.1029973 2,8.39509537 C2,5.37384196 4.42,3 7.5,3 C9.24,3 10.91,3.79455041 12,5.05013624 C13.09,3.79455041 14.76,3 16.5,3 C19.58,3 22,5.37384196 22,8.39509537 C22,12.1029973 18.6,15.1242507 13.45,19.7149864 L12,21 Z"
                                                                />
                                                            </svg>
                                                        </a>
                                                    </li>
                                                    
                                                    <li>
                                                        <a class="quickview_btn" data-bs-toggle="modal" href="#all{{$pro->id}}" role="button" tabindex="0">
                                                            <svg
                                                                width="48px"
                                                                height="48px"
                                                                viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                stroke="#2329D6"
                                                                stroke-width="1"
                                                                stroke-linecap="square"
                                                                stroke-linejoin="miter"
                                                                fill="none"
                                                                color="#2329D6"
                                                            >
                                                                <title>Visible (eye)</title>
                                                                <path d="M22 12C22 12 19 18 12 18C5 18 2 12 2 12C2 12 5 6 12 6C19 6 22 12 22 12Z" />
                                                                <circle cx="12" cy="12" r="3" />
                                                            </svg>
                                                        </a>
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
                                                                        <div class="main_slider" data-slick='{"arrows": false}'>
                                                                        @foreach(App\Models\productThumbnail::where('product_id',$pro->id)->get() as $prt)
                                                                        @if(App\Models\productThumbnail::where('product_id',$pro->id)->count() == 1)
                                                                        <img src="{{asset('/uploads/products/preview')}}/{{$pro->product_image}}" alt>
                                                                        @else
                                                                        <img class="product_details_image p-0" src="{{asset('/uploads/products/thumbnails')}}/{{$prt->product_thumbnail_name}}" alt>
                                                                        <!-- <div  data-background="{{asset('frontend_assets/images/slider/slide-3.jpg')}}"></div> -->
                                                                        @endif                                                                        
                                                                        @endforeach
                                                                        </div>
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
                                </div>
                            </div>        
                        </div>
                    </div>
                </div>
            </section>
            <!-- related_products_section - end
            ================================================== -->


@endsection


@section('footer')
<script>
    var p2 = document.querySelector('#price');
    
    let val = parseInt(document.getElementById('hidevalue').value);
    

    function changecounter(button){
        if(button == 'plus'){
            var n1 = parseInt(document.getElementById('counter').value);
            n1+=1;
            if(n1 <=10){
                document.getElementById('counter').value = n1;
                $('.excide').html(n1);
                var p3 = val*n1;
                document.getElementById('price2').value = p3;  
                if(n1==10){
                   $('.plus').prop("disabled",true); 
                }
                var ammount = parseInt($('.excide').html());
                var stock = parseInt($('.stock').html());
                if(ammount > stock){
                    $('.mssg').html("**exciding stock limit**");
                    $('.addtocart_btn').prop("disabled",true);
                }
                
            }
            
            
        }
        else if(button == 'minus'){
            $('.plus').prop("disabled",false);
            if(document.getElementById('counter').value>1){
                document.getElementById('counter').value-=1;
                var p3 = val * parseInt(document.getElementById('counter').value);
                document.getElementById('price2').value = p3;
                $('.excide').html(document.getElementById('counter').value);
                var ammount = parseInt($('.excide').html());
                var stock = parseInt($('.stock').html());
                if(ammount <= stock){
                        $('.mssg').html("");
                        $('.addtocart_btn').prop("disabled",false);
                    }
            }
            else{
                var p3 = val;
                document.getElementById('price2').value = p3;
            }
            
        }
        p2.innerHTML = p3;
    }
</script>

<script>
    $('.fa-star').click(function(){
        var star = $(this).attr('name');
        var clas ="s fas fa-star";
        var i;
        for(i=0;i<=star;i++){
            var st = '#star'+i.toString();
            
            if($(st).attr('class') == 's fal fa-star')
            {
            $(st).attr('class',clas);
            }
            else if($(st).attr('class') == 's fas fa-star'){
                $('.s').attr('class',"s fal fa-star");
                $(st).attr('class',clas);
            }
        }
        $('#star_id').attr('value',star);
    });  
</script>
<script>
    $('.color_selector').change(function(){
        var clr = $(this).val();
        var id = $('.id').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/getsize',
            data:{jaheen:clr,khan:id},
            success:function(data){

                var tag = '<span class="current size_current">select size</span><ul class="list">'+data.select+'</ul>'
                $('#size_selector').html(data.select);
                $('.size_selector').html(tag);
            }
        })
    });
</script>

<script>
    $('.size_selector').change(function(){
        $('.size_selector .current').attr("class","current size_current");
        var size= $('.size_selector .size_current').html();
        var color = $('.color_selector').val();
        var id = $('.id').val();
        
        
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/getstock',
            data:{clr:color,siz:size,idd:id},
            success:function(data){

              $('.stock').html(data.detail);
              $('#size').val(data.size);  
            }
        })

        
    });
</script>


<script>

    $('.color2_selector').change(function(){
        $('.color2_selector .current').attr("class","current color_current");
        var color= $('.color2_selector .color_current').html();
        var size = $('.size2_selector').val();
        var id = $('.id').val();
        
        
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/getstock',
            data:{clr:color,siz:size,idd:id},
            success:function(data){

              $('.stock').html(data.detail);
              $('#size').val(data.size);  
            }
        })

        
    })
</script>


@endsection