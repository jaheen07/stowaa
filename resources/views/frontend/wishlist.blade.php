@extends('frontend.master')

@section('content')

            <!-- breadcrumb_section - start
            ================================================== -->
            <div class="breadcrumb_section">
                <div class="container">
                    <ul class="breadcrumb_nav ul_li">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li>Wishlist</li>
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
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th class="text-center">PRODUCT IMAGE</th>
                                    <th class="text-center">PRODUCT NAME</th>
                                    <th class="text-center">PRICE</th>
                                    <th class="text-center">STOCK STATUS</th>
                                    <th class="text-center">PRODUCT DETAILS</th>
                                    <th class="text-center">REMOVE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wishlist->where('user_id',Auth::guard('logan')->user()->id) as $key=>$wish)
                                <tr>
                                    <td>
                                        {{$key+1}}
                                    </td>
                                    <td>
                                        <div class="cart_product">
                                            <img src="{{asset('uploads/products/preview')}}/{{App\Models\product::where('id',$wish->product_id)->first()->product_image}}" alt="image_not_found" />
                                        </div>
                                    </td>
                                    <td class="text-center">{{App\Models\product::where('id',$wish->product_id)->first()->product_name}}</td>
                                    <td class="text-center"><span class="price_text">BDT {{App\Models\product::where('id',$wish->product_id)->first()->product_price}}</span></td>
                                    @if(App\Models\product::where('id',$wish->product_id)->first()->quantity > 0)
                                    <td class="text-center"><span class="price_text text-success">In Stock</span></td>
                                    @else
                                    <td class="text-center"><span class="price_text text-danger">Out of Stock</span></td>
                                    @endif
                                    <td class="text-center">
                                        <a href="{{url('/product_details')}}/{{$wish->product_id}}" class="btn btn_primary">View Product Details</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{url('/delete/wishlist')}}/{{$wish->id}}" class="remove_btn"><i class="fal fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <!-- cart_section - end
            ================================================== -->

@endsection