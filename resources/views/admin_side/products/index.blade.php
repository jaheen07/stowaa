@extends('layouts.app')
<title>Products</title>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h3>products</h3>
                </div>
                <div class="card-body">
                    <table class="table table-stripped">
                        <tr>
                            <th>Sl. No</th>
                            <th>Category name</th>
                            <th>Subcategory name</th>
                            <th>Picture</th>
                            <th>Product name</th>
                            <th>product price</th>
                            <th>discount</th>
                            <th>discount price</th>
                            <th>description</th>
                            <th>Quantity</th>
                            <th>inventory</th>
                        </tr>

                        @foreach($products as $key=>$pro)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$pro->category_name}}</td>
                            <td>{{$pro->subcategory_name}}</td>
                            <td><img width="50" src="{{asset('uploads/products/preview')}}/{{$pro->product_image}}" alt="not found image"></td>
                            <td>{{$pro->product_name}}</td>
                            <td>{{$pro->product_price}}</td>
                            <td>{{$pro->discount}}</td>
                            <td>{{$pro->discount_price}}</td>
                            <td>{{$pro->description}}</td>
                            <td>{{$pro->quantity}}</td>
                            <td><a class="btn btn-primary" href="{{url('/inventory')}}/{{$pro->id}}">click</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h3>Add products</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/product/insert')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-3">
                            <select name="category_id" class="form-control select_category">
                                <option value="">--Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mt-3">
                            <select name="subcategory_id" class="form-control" id="subcategory">
                                
                                <option value="">--Select Sub Category--</option>
                            </select>
                        </div>


                        <div class="mt-3">
                            <label for="" class="form-label">product name</label>
                            <input type="text" class="form-control" name="product_name">
                        </div>


                        <div class="mt-3">
                            <label for="" class="form-label">product price</label>
                            <input type="text" class="form-control" name="product_price">
                        </div>


                        <div class="mt-3">
                            <label for="" class="form-label">Discount %</label>
                            <input type="text" class="form-control" name="discount">
                        </div>
                        
                        <div class="mt-3">
                            <label for="" class="form-label">description</label>
                            <textarea name="description" class="form-control" placeholder="Enter desc"></textarea>
                        </div>
                        
                        <div class="mt-3">
                            <label for="" class="form-label">Quantity(Pcs)</label>
                            <input type="text" class="form-control" name="quantity">
                        </div>

                        <div class="mt-3">
                            <label for="" class="form-label">Product has Size?</label>
                            <!-- <input list="meassures" class="form-control"  name="size">
                            <datalist id="meassures">
                                <option value="YES">
                                <option value="NO">
                            </datalist> -->

                            <select name="size_exists" class="form-control">
                                <option value="Y">Yes</option>
                                <option value="N">No</option>
                            </select>
                        </div>
                        
                        <div class="mt-3">
                            <label for="" class="form-label">color</label>
                            <input type="text" class="form-control" name="color">
                        </div>

                        <div class="mt-3">
                            <label for="" class="form-label">image</label>
                            <input type="file" class="form-control" name="product_image">
                        </div>

                        <div class="mt-3">
                            <label for="" class="form-label">Thumbnails</label>
                            <input multiple type="file" class="form-control" name="product_thumb[]">
                        </div>


                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Add product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('footer')

<script>
    $('.select_category').change(function(){
        var category_id = $(this).val();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/getSubcategory',
            data:{jaheen:category_id},
            success:function(data){
                $('#subcategory').html(data);
            }
        })
    });

</script>

@endsection