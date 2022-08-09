@extends('frontend.master')

@section('content')

            <!-- breadcrumb_section - start
            ================================================== -->
            <div class="breadcrumb_section">
                <div class="container">
                    <ul class="breadcrumb_nav ul_li">
                        <li><a href="index.html">Home</a></li>
                        <li>Login/Register</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb_section - end
            ================================================== -->

            <!-- register_section - start
            ================================================== -->
            <section class="register_section section_space">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">

                            <ul class="nav register_tabnav ul_li_center" role="tablist">
                                <li role="presentation">
                                    <button class="active" data-bs-toggle="tab" data-bs-target="#signin_tab" type="button" role="tab" aria-controls="signin_tab" aria-selected="true">Sign In</button>
                                </li>
                                <li role="presentation">
                                    <button data-bs-toggle="tab" data-bs-target="#signup_tab" type="button" role="tab" aria-controls="signup_tab" aria-selected="false">Register</button>
                                </li>
                            </ul>
                            @if(session('success'))
                            <div class="alert alert-success text-center">{{session('success')}}</div>
                            @elseif(session('error'))
                            <div class="alert alert-warning text-center">{{session('error')}}</div>
                            @endif
                            <div class="register_wrap tab-content">
                                <div class="tab-pane fade show active" id="signin_tab" role="tabpanel">
                                    <form action="{{url('/customer/login')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="get_url" value="{{$get_url}}">
                                        <div class="form_item_wrap">
                                            <h3 class="input_title">Email*</h3>
                                            <div class="form_item">
                                                <label><i class="fas fa-envelope"></i></label>
                                                <input type="email" name="email" placeholder="email" >
                                            </div>   
                                        </div>

                                        <div class="form_item_wrap">
                                            <h3 class="input_title">Password*</h3>
                                            <div class="form_item">
                                                <label for=""><i class="fas fa-lock"></i></label>
                                                <input  type="password" name="password" placeholder="Password">
                                            </div>
                                            
                                            <div class="checkbox_item">
                                                <input id="remember_checkbox" type="checkbox" name="rememberme">
                                                <label for="remember_checkbox">Remember Me</label>
                                            </div>
                                        </div>

                                        <div class="form_item_wrap">
                                        <div class="checkbox_item">
                                                <a href="{{url('/forgot_pass')}}" style="color:gray">Forgot password</a>
                                            </div>
                                            <button type="submit" class="btn btn_primary button">Sign In</button>
                                        </div>
                                    </form>
                                    
                                    <div class="col col-lg-12 mx-auto mb-0 mt-3 text-center"><strong><i>Or<br>(Login with social account)</i></strong>
                                    <hr class="m-0 mb-4"style="border-width:10px;">
                                    <ul class=" ul_li mx-auto">
                                        <li style="margin-left:15%"><a href="{{url('/google/redirect')}}" class="btn btn_primary">google</a></li>
                                        <li style="margin-left:10%"><a href="{{url('/github/redirect')}}" class="btn btn_primary">github</a></li>
                                        <li style="margin-left:10%"><a href="{{url('/facebook/redirect')}}" class="btn btn_primary">facebook</a></li>
                                    </ul>
                                    </div>
                                    
                                </div>

                                <div class="tab-pane fade" id="signup_tab" role="tabpanel">
                                    <form action="{{url('/customer/register')}}" method="POST">
                                        @csrf
                                        <div class="form_item_wrap">
                                            <h3 class="input_title">User Name*</h3>
                                            <div class="form_item">
                                                <label><i class="fas fa-user"></i></label>
                                                <input type="text" name="name" placeholder="User Name" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form_item_wrap">
                                            <h3 class="input_title">Email*</h3>
                                            <div class="form_item">
                                                <label><i class="fas fa-envelope"></i></label>
                                                <input type="email" name="email" placeholder="Email" id="email" value="" reqired>
                                                <p style="color:red" class="para"></p>
                                            </div>
                                        </div>

                                        <div class="form_item_wrap">
                                            <h3 class="input_title">Password*</h3>
                                            <div class="form_item">
                                                <label ><i class="fas fa-lock"></i></label>
                                                <input type="password" name="password" id="password" placeholder="Password" value="" required>
                                                <p style="color:red" class="para2"></p>
                                            </div>
                                        </div>
                                        <input type="hidden" class="emin" value="0">
                                        <input type="hidden" class="pasin" value="0">
                                        <div class="form_item_wrap">
                                            <button disabled class="btn btn_secondary jk_btn">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- register_section - end
            ================================================== -->

@endsection

@section('footer')
<script>
    $('#email').mousedown(function(){
        var eval = $(this).val();
    

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'GET',
            url:'/check_email',
            data:{jaheen:eval},
            success:function(data){
                if(data == "no found"){
                    $('.para').html("");
                    $('.emin').val("1");      
                }
                else if (data == "field null"){
                    $('.jk_btn').prop("disabled",true);
                    $('.emin').val("0");
                }
                else{
                    $('.para').html(data);
                    $('.emin').val("0");
                }
                
                if($('.emin').val() == 1 && $('.pasin').val()== 1)
                {
                    $('.jk_btn').removeAttr("disabled");
                    
                }
                else{
                    $('.jk_btn').prop("disabled",true);
                }
            }
        })
    });

    
</script>

<script>
    $('#password').mousedown(function(){
        
        var pass_val = $(this).val().length;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'GET',
            url:'/check_pass',
            data:{khan:pass_val},
            success:function(data){
                if(data == "ok")
                {
                    $('.para2').html("");
                    $('.pasin').val("1");
                }
                else if(data == "field null"){
                    $('.jk_btn').prop("disabled",true);
                    $('.pasin').val("0");
                }
                else{
                    $('.para2').html("password is less than 8 characters");
                    $('.pasin').val("0");
                }
                
                if($('.emin').val() == 1 && $('.pasin').val()== 1)
                {
                    $('.jk_btn').removeAttr("disabled");
                    
                }
                else{
                    $('.jk_btn').prop("disabled",true);
                }
            }
        })

    });
    
    
</script>

@endsection