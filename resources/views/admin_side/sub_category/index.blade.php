@extends('layouts.app')
<title>Sub Category</title>
@section('content')
<div class="container">
    <div class="row">

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Sub-Categories</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Sl No.</th>
                            <th>Under category</th>
                            <th>Sub-Category Name</th>
                            <th>Added by</th>
                            <th>created At</th>
                            <th>action</th>
                            
                        </tr>

                        @foreach($subcategories as $key=>$sub)
                        
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{App\models\category::where('id',$sub->under_category)->first()->category_name}}</td>
                            <td>{{$sub->subcategory_name}}</td>
                            <td>{{App\Models\User::find($sub->added_by)->name}}</td>
                            <td>{{$sub->created_at}}</td>
                            <td>
                                <a href="{{url('/sub_category/delete')}}/{{$sub->id}}" class="btn btn-danger">Delete</a>
                               
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
                    <h3>Add Sub-categories</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/subcategory/insert')}}" method="POST">
                        @csrf
                        @if(session('exists'))
                            <div class="alert alert-danger">{{session('exists')}}</div>
                        @endif
                        <div class="form-group">
                            <label for="">categories</label>
                            <select name="category_id" class="form-control">
                                        <option value="">--select category--</option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                                        <label for="">Sub-category</label>
                                        <input type="text" name="subcategory_name" class="form-control">
                        </div>

                        <div class="form-group mt-3 text-center">
                            <button type="submit" class="btn btn-primary">Add sub category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection