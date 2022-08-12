@extends('layouts.app')
<title>Banner</title>
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h3>banner details</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Sl. No.</th>
                            <th>Banner Photo</th>
                            <th>Banner Number</th>
                            <th>Product Name</th>
                            <th>Action</th>
                        </tr>
                        @foreach($banner as $key=>$bn)
                           <tr> 
                            <td>{{$key+1}}</td>
                            <td>
                                <img src="{{asset('/uploads/banner')}}/{{$bn->banner_image}}" width="80" height="50">
                            </td>
                            <td>{{$bn->banner_number}}</td>
                            @if($bn->product_id == 'none')
                            <td></td>
                            @else
                            <td>{{App\Models\product::where('id',$bn->product_id)->first()->product_name}}</td>
                            @endif
                            <td><a class="btn btn-danger" href="{{url('/delete/banner')}}/{{$bn->id}}">delete</a></td>
                           </tr>
                        @endforeach
                        
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h3>banner insert</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/banner/insert')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-3">
                            <label for="">Banner Section Number</label>
                            <select name="banner_number" class="form-control banner_id">
                                <option>--select banner--</option>
                                @if(($banner->where('banner_number',0)->count() + $banner->where('banner_number',1)->count()) !=3)
                                <option value="0">banner 0 (showcase photo banner)</option>
                                <option value="1">banner 1 (showcase product banner)</option>
                                @endif
                                @if($banner->where('banner_number',2)->count() == 0)
                                <option value="2">banner 2</option>
                                @endif
                                @if($banner->where('banner_number',3)->count() == 0)
                                <option value="3">banner 3</option>
                                @endif
                                @if($banner->where('banner_number',4)->count() == 0)
                                <option value="4">banner 4</option>
                                @endif
                                @if($banner->where('banner_number',5)->count() == 0)
                                <option value="5">banner 5</option>
                                @endif
                                @if($banner->where('banner_number',6)->count() == 0)
                                <option value="6">banner 6</option>
                                @endif
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="">Product Name</label>
                            <select name="product" class="form-control" id="products" required>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label">Image</label>
                            <input type="file" class="form-control" name="banner_image">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
<script>
    $('.banner_id').change(function(){
        var banner_id = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/getproduct',
            data:{jaheen:banner_id},
            success:function(data){
                $('#products').html(data);
            }
        })
    });
</script>
@endsection
