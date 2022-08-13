@extends('layouts.app')
<title>Orders</title>
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-14">
            @if(session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            <div class="card">
                <div class="card-header">
                  <h3> Pending Orders details </h3>
                </div>
                <div class="card-body">
                    <table class ="table table-bordered">
                        <tr>
                            <th>Sl No.</th>
                            <th>Order Id</th>
                            <th>product name</th>
                            <th>user name </th>
                            <th>phone</th>
                            <th>address</th>
                            <th>Full Details</th>
                            <th>packaging done</th>
                            <th>shipped</th>
                            <th>delivery completed</th>
                            
                        </tr>
                       
                            @foreach(App\Models\order_details::all() as $key=>$od)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$od->order_number}}</td>
                                <td>{{App\Models\product::where('id',$od->product_id)->first()->product_name}}</td>
                                <td>{{$od->user_name}}</td>
                                <td>{{$od->phone}}</td>
                                <td>{{$od->address}}</td>
                                <td><a class="btn btn-secondary" style="pointer-events: none;" href="{{url('/orders/details')}}/{{$od->id}}">see details(currently disabled)</a></td>
                                @if($od->packaging_status == 0 )
                                <td><a class="btn btn-secondary" href="{{url('/orders/packaging')}}/{{$od->id}}">click to set ok</a></td>
                                @else
                                <td>order packed</td>
                                @endif
                                @if($od->shipping_status == 0 )
                                <td><a class="btn btn-secondary" href="{{url('/orders/shipping')}}/{{$od->id}}">click to set ok</a></td>
                                @else
                                <td>order shipped</td>
                                @endif
                                <td><a class="btn btn-secondary" href="{{url('/orders/delivery_complete')}}/{{$od->id}}">click to set done</a></td>
                            </tr>
                            @endforeach
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection