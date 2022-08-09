@extends('frontend.master')

@section('content')
<div class="container">
    <div class="row">
        @if(session('success'))
            <h4 class="text-center mt-5 mb-5" style="color:violet">{{session('success')}}</h3>
        @elseif(session('error'))
            <h4 class="text-center mt-5 mb-5" style="color:red">{{session('error')}}</h3>
            <div class="card col-lg-5 m-auto mb-5">
                <div class="card-body">
                    <form action="{{url('/send_link')}}" method="POST">
                        @csrf
                        <label for="">Your Email</label>
                        <input type="email" name="mail" required>
                        <button type="submit" class="btn btn-danger mt-3">Get Link</button>
                    </form>
                </div>  
            </div>
            @else
            <div class="card col-lg-5 m-auto mt-5 mb-5">
                <div class="card-header">
                    <h3>New Password Request</h3>
                </div>

                <div class="card-body">
                    <form action="{{url('/send_link')}}" method="POST">
                        @csrf
                        <p style="color:#fc034e"><b> Please enter your email for your password restoration.We will send you a link to your email to change your password</b></p>
                        <label for="">Your Email</label>
                        <input type="email" name="mail" required>
                        <button type="submit" class="btn btn-danger mt-3">Get Link</button>
                    </form>
                </div>  
            </div>
        @endif
    </div>
</div>
@endsection