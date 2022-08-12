@extends('layouts.app')

<title>Records</title>

@section('content')
<div class="jk mx-3">
    <div class="row">
        <div class="col-lg-20">
            <div class="card">
                <div class="card-header"><h3>Records</h3></div>

                <div class="card-body">
                    <table class=" table table-striped"style="font-size:0.8rem;">
                <tr class="text-center">
                    <th>Sl No.</th>
                    <th>order_number</th>
                    <th>user_name</th>
                    <th>product</th>
                    <th>size</th>
                    <th>color</th>
                    <th>quantity</th>
                    <th>total_price</th>
                    <th>Email</th>
                    <th>phone</th>
                    <th>country</th>
                    <th>city</th>
                    <th>address</th>
                    <th>notes</th>
                    <th>grand Total</th>
                    <th>Payment method</th>
                    <th>Created At</th>
                </tr>

                @foreach($records as $key=>$rd)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$rd->order_number}}</td>
                    <td>{{$rd->user_name}}</td>
                    <td>{{App\models\product::where('id',$rd->product_id)->get()->first()->product_name}}</td>
                    @if($rd->size == NULL)
                    <td>N/A</td>
                    @else
                    <td>{{$rd->size}}</td>
                    @endif
                    @if($rd->color == NULL)
                    <td>N/A</td>
                    @else
                    <td>{{$rd->color}}</td>
                    @endif
                    <td>{{$rd->quantity}}</td>
                    <td>{{$rd->total_price}}</td>
                    <td>{{$rd->Email}}</td>
                    <td>{{$rd->phone}}</td>
                    <td>{{$rd->country}}</td>
                    <td>{{$rd->city}}</td>
                    <td>{{$rd->address}}</td>
                    <td>{{$rd->notes}}</td>
                    <td>{{$rd->grand_total}}</td>
                    <td>{{$rd->payment_method}}</td>
                    <td>{{$rd->created_at}}</td>
                </tr>
                @endforeach
            </table> 
                </div>
            </div>
           
        </div>
    </div>
</div>
@endsection