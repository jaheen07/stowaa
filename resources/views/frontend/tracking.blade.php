@extends('frontend.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="card m-auto mt-3 mb-3">
            <header class="card-header"> My Orders / Tracking </header>
            <div class="card-body">
                <h6>Order ID: {{$order_detail->get()->first()->order_number}}</h6>

                <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong>Estimated Delivery time:</strong> <br>{{date('d M,Y',strtotime($order_detail->get()->first()->estimated_time))}}</div>
                        <div class="col"> <strong>Shipping BY:</strong> <br> Pouchey dibo, | <i class="fa fa-phone"></i> +1598675986 </div>
                        
                        <div class="col"> <strong>Product Name:</strong>
                        
                         <br> {{$pro->first()->product_name}} 
                        
                        </div>
                        
                    </div>
                </article>
                <div class="track">
                    @if($stat == 0)
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                    @if($order_detail->get()->first()->packaging_status == 1)
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"> packaging done</span> </div>
                    @else
                    <div class="step"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> packaging done</span> </div>
                    @endif

                    @if($order_detail->get()->first()->shipping_status == 1)
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"> Shipped </span> </div>
                    @else
                    <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Shipped </span> </div>
                    @endif
                    
                    <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">delivered</span> </div>
                    @elseif($stat == 1)
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>          
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"> packaging done</span> </div>
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text"> Shipped </span> </div>
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">delivered</span> </div>
                    @endif
                </div>
                <hr>
                
                <hr>
            
            </div>
        </div>
    </div>
    
</div>
@endsection