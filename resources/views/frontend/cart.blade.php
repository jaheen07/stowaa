@extends('frontend.master')

@section('content')


            <!-- breadcrumb_section - start
            ================================================== -->
            <div class="breadcrumb_section">
                <div class="container">
                    <ul class="breadcrumb_nav ul_li">
                        <li><a href="index.html">Home</a></li>
                        <li>Cart</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb_section - end
            ================================================== -->

            <!-- cart_section - start
            ================================================== -->
            <section class="cart_section section_space">
                <div class="container">
                
                    <div class="cart_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Color</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $total = 0;
                                @endphp
                                
                                 @forelse(App\Models\cart::where('user_id',Auth::guard('logan')->id())->get() as $cr)

                                <tr>
                                    <td>
                                        <div class="cart_product">
                                            <img src="{{asset('/uploads/products/preview')}}/{{App\Models\product::find($cr->product_id)->product_image}}" alt="image_not_found">
                                            <h3><a href="{{url('/product_details')}}/{{$cr->product_id}}">{{App\Models\product::find($cr->product_id)->product_name}}</a></h3>
                                        </div>
                                    </td>
                                    <td class="text-center">{{$cr->size}}</td>
                                    <td class="text-center">{{$cr->color}}</td>
                                    <td class="text-center"><span class="price_text">{{App\Models\product::find($cr->product_id)->product_price}} Tk</span></td>
                                    <td class="text-center">
                                      {{$cr->quantity}}
                                        
                                    </td>
                                    <td class="text-center"><span class="price_text">{{$cr->total_price}} tk</span></td>
                                    <td class="text-center"><a href="{{url('/remove')}}/{{$cr->id}}" class="remove_btn"><i class="fal fa-trash-alt"></i></a></td>
                                </tr>

                                @php
                                $total += $cr->total_price;
                                @endphp

                                @empty
                                    
                                    <tr>
                                        <td colspan="6"><h3 class="text-center">Nothing to show.Cart is empty</h3></td>
                                    </tr>

                                @endforelse
                               
                                @if($total == 0)
                                
                                @else
                                <tr>
                                    <td  class="text-center" colspan="3"> <h4 >Cart Total:</h3></td>
                                    @if($discount > 0)
                                    <td class="text-center"><h4 class="total_price price_text">{{$total - ($total*($discount/100))}} Tk</h3></td>
                                    
                                    @else
                                    <td class="text-center"><h4 class="total_price price_text">{{$total}} Tk</h3></td>
                                    
                                    @endif
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    @if($total == 0)
                                <div class="m-auto">
                                    <ul class="btns_group ul_li_right">
                                    <li><a class="btn border_black" href="{{url('/shop')}}">Add More to cart</a></li> 
                                    </ul>
                                </div>
                    @else
                    <div class="cart_btns_wrap">
                        <div class="row">
                            <div class="col col-lg-6">
                                <form action="{{url('/apply_coupon')}}" method="POST">
                                    @csrf
                                    <div class="coupon_form form_item mb-0">
                                        <input type="text" name="coupon_code" placeholder="Coupon Code...">
                                        <button type="submit" class="btn btn_dark">Apply Coupon</button>
                                        <div class="info_icon">
                                            <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Your Info Here"></i>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col col-lg-6">
                                
                                <form action="{{url('/checkout')}}" method="POST">    
                                        @csrf
                                            <!-- <div class="calculate_shipping">
                                                <h3 class="wrap_title">delivery charge</h3>
                                                <div class="select_option clearfix">
                                                    <select name="delivery">
                                                        <option value="50">Inside Dhaka (50 Tk)</option>
                                                        
                                                        <option value="100">Outside Dhaka (100 Tk)</option>
                                                    </select>
                                                </div>
                                                <br>
                                            </div> -->
                                        
                                    

                                
                                    <input type="hidden" name="total" value="{{$total}}">
                                    <input type="hidden" name="discount" value="{{$discount}}">
                                    
                                    <div class="col col-lg-6">
                                        <ul class="btns_group ul_li_right">
                                            <li><a class="btn border_black" href="{{url('/shop')}}">Add More to cart</a></li>
                                            <li><button class="btn btn_dark">Prceed To Checkout</button></li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif     
                </div>
            </section>
            <!-- cart_section - end
            ================================================== -->
@endsection