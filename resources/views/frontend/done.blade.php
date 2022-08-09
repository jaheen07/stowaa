@extends('frontend.master')

@section('content')
 <!-- empty_cart_section - start
================================================== -->
            <section class="empty_cart_section section_space">
                <div class="container">
                    <div class="empty_cart_content text-center">
                        <span class="cart_icon">
                            <i class="icon icon-ShoppingCart"></i>
                        </span>
                        <h3>Thank you</h3>
                        <h3>Your order is been placed. Your order Id is <p style="color:red">"{{$order_number}}"</p></h3>
                        <a class="btn btn_danger" href="{{url('/tracking')}}/{{$order_number}}">Track ordered product </a>
                        <a class="btn btn_secondary" href="{{url('/')}}"> Continue shopping </a>
                    </div>
                </div>
            </section>
<!-- empty_cart_section - end
================================================== -->
@endsection