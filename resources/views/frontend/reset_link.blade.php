@extends('frontend.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-5 m-auto mt-5 mb-5">
            <div class="card ">
                <div class="card-header">
                    <h3>Set Your Password</h3>
                </div>
                

                <div class="card-body">
                    @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif
                    @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <form action="{{url('/reseted')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">New password</label>
                            <input type="password" name="new_pass" value="" required>

                            <label for="" class="mt-3">confirm password</label>
                            <input type="password" name="confirm_pass" value="" required>
                            <input type="hidden" name="new_token" value="{{$token}}">
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-danger">confirm</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection