@extends('layouts.app')

@section('content')
<section>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Categories</h3>
                </div>
                @if (session('delete'))
                <div class="alert alert-success">{{session('delete')}}</div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Category name</th>
                            <th>icons</th>
                            <th>Added by</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>{{$category->icons}}</td>
                            <td>
                                <img src="{{asset('/uploads/category')}}/{{$category->category_image}}" width="80" height="50">
                            </td>
                            <td>{{App\Models\User::find($category->added_by)->name}}</td>
                            <td>{{$category->created_at}}</td>
                            <td>
                                <a href="{{url('/category/delete')}}/{{$category->id}}" class="btn btn-danger">Delete</a>
                                
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
                    <h3>Add Category</h3>
                </div>
                @if (session('success'))
                   <div class="alert alert-success">{{session('success')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{url('/category/insert')}}" method="POST" enctype="multipart/form-data">
                    @csrf    
                        <div class="from-group">
                            <label for="" class="form-label">Category name</label>
                            <input type="text" class="form-control" name="category_name">
                            <label for="" class="form-label">Icon</label>
                            <input type="text" class="form-control" name="icons">
                            <label for="" class="form-label">category image</label>
                            <input type="file" class="form-control" name="category_image">
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
</section>


@endsection