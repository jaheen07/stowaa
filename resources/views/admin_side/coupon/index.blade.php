@extends('layouts.app')
<title>Coupon</title>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>coupons</h3>
                </div>
                @if (session('delete'))
                <div class="alert alert-success">{{session('delete')}}</div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Coupon name</th>
                            <th>validation</th>
                            <th>discount</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($coupons as $loop => $coupon)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$coupon->coupon_name}}</td>
                            <td>{{$coupon->validation}}</td>
                            <td>{{$coupon->discount}}</td>
                            <td>{{$coupon->created_at}}</td>
                            <td>
                                <a href="{{url('/category/delete')}}/{{$coupon->id}}" class="btn btn-danger">Delete</a>
                                <a href="{{url('/category/edit')}}/{{$coupon->id}}" class="btn btn-primary">Edit</a>
                            </td>
                        </tr>  
                        @endforeach  
                    </table>
                </div>
            </div>
        </div>



        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add coupon</h3>
                </div>
                @if (session('success'))
                   <div class="alert alert-success">{{session('success')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{url('/coupon/insert')}}" method="POST">
                    @csrf    
                        <div class="from-group">
                            <label for="" class="form-label">Coupon name</label>
                            <input type="text" class="form-control" name="coupon_name">
                            <label for="" class="form-label">validation</label>
                            <input type="date" class="form-control" name="validation">
                            <label for="" class="form-label">discount</label>
                            <input type="text" class="form-control" name="discount">
                            <!-- @error('category_name')
                                <strong class="text-danger pt-1">{{$message}}</strong>
                            @enderror -->
                        </div>
                        <div class="form-group mt-3 text-center">
                            <button type="submit" class="btn btn-primary">add category</button>
                        </div>
                        
                    </form>    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection