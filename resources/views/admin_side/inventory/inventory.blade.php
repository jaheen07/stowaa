@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h3>{{App\Models\product::where('id',$jk_id)->first()->product_name}}</h3>
                </div>
                <div class="card-body">
                    <div class="card-group">
                        
                        <div class="mx-3" style="border:'gray'">
                            <img src="{{asset('uploads/products/preview')}}/{{App\Models\product::where('id',$jk_id)->first()->product_image}}"alt="..." width="180px"> 
                        </div>
                        
                        @foreach(App\models\productThumbnail::where('product_id',$jk_id)->get() as $pt)
                        
                        <div class="mt-5">
                            <img src="{{asset('uploads/products/thumbnails')}}/{{$pt->product_thumbnail_name}}" alt="..." width="70px">
                        </div>
                        @endforeach
                    </div>
                            
                    <div class="mt-3">
                        <p><b>Total quantity:{{App\Models\product::where('id',$jk_id)->first()->quantity}}</b></p>
                    </div>
                    @if($pro->first()->size_exists == 'N' && $pro->first()->color == NULL)

                    @elseif($pro->first()->size_exists == 'N' && $pro->first()->color != NULL)
                    <div>
                        <table class="table table-bordered text-center">
                            <tr>
                                <th>Color</th>
                                <th>quantity</th>
                            </tr>
                            
                            @foreach($color as $col)
                            @foreach(App\Models\inventory::where('product_id',$jk_id)->where('color',$col)->get() as $clr)
                                <tr> 
                                    <td>{{$clr->color}}</td>
                                    <td>{{$clr->quantity}}</td>
                                </tr>
                            @endforeach
                            @endforeach
                            
                        </table>
                    </div>
                    @elseif($pro->first()->size_exists == 'Y' && $pro->first()->color == NULL)
                    <div>
                        <table class="table table-bordered text-center">
                            <tr>
                                <th>Size</th>
                                <th>quantity</th>
                            </tr>
                            @foreach($size as $siz)
                            @foreach(App\Models\inventory::where('product_id',$jk_id)->where('size',$siz)->get() as $sz)
                                <tr> 
                                    <td>{{$sz->size}}</td>
                                    <td>{{$sz->quantity}}</td>
                                </tr>
                            @endforeach
                            @endforeach
                        </table>
                    </div>
                    @elseif($pro->first()->size_exists == 'Y' && $pro->first()->color != NULL)
                    <div class="card-group mt-5">
                        @foreach($color as $col)
                            <div class="card">
                                <div class="card-header text-center">
                                    {{$col}}
                                </div>
                                <div class="card-body">
                                <table class="table table-bordered text-center">
                                    <tr>
                                        <th>Size</th>
                                        <th>quantity</th>
                                    </tr>
                                    
                                    @foreach(App\Models\inventory::where('product_id',$jk_id)->where('color',$col)->get() as $clr)
                                        <tr> 
                                            <td>{{$clr->size}}</td>
                                            <td>{{$clr->quantity}}</td>
                                        </tr>
                                    @endforeach
                                    
                                </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h3>Add Items</h3>
                </div>
                <div class="card-header">
                    <form action="{{'/inventory/insert'}}" method="POST">
                        @csrf
                        @if($pro->first()->size_exists == 'N' && $pro->first()->color == NULL)
                        
                        @elseif($pro->first()->size_exists == 'N' && $pro->first()->color != NULL)
                        <div class="form-group">
                            <label for="">Color:</label>
                            <select name="color" id="" class="form-control">
                                <option>--Choose colour--</option>
                                @foreach($color as $col)
                                <option value="{{$col}}">{{$col}}</option>
                                @endforeach
                            </select>
                        </div>
                        @elseif($pro->first()->size_exists == 'Y' && $pro->first()->color == NULL)
                        <div class="form-group">
                            <label for="">size</label>
                            <input type="text" class="form-control" name="size">
                        </div>
                        @elseif($pro->first()->size_exists == 'Y' && $pro->first()->color != NULL)
                        <div class="form-group">
                            <label for="">Color:</label>
                            <select name="color" id="" class="form-control">
                                <option>--Choose colour--</option>
                                @foreach($color as $col)
                                <option value="{{$col}}">{{$col}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">size</label>
                            <input type="text" class="form-control" name="size">
                        </div>
                        @endif
                        <div class="form-group mt-3">
                            <label for="">Quantity</label>
                            <input class="form-control" type="text" name="quantity" required>
                            <input type="hidden" name="id" value="{{$jk_id}}">
                        </div>

                        <button class="btn btn-primary mt-3" type="submit">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection