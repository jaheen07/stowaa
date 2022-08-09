@extends('frontend.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="card col-lg-5 m-auto mt-5 mb-5">
            <div class="card-header">
                <h3>Order Tracking </h3>
            </div>

            <div class="card-body">
                <form action="{{url('/track-order')}}" method="GET">
                    @csrf
                    <p style="color:#fc034e" class="text-center"><b>Enter order ID to track your Order</b></p>
                    <label for="">Your order Id</label>
                    <input type="text" name="track_id" value="" required>
                    <button type="submit" class="btn btn-danger mt-3">Track Order</button>
                </form>
            </div>  
        </div>
    </div>
</div>
@endsection