@extends('frontend.master')
@section('content')


            <!-- breadcrumb_section - start
            ================================================== -->
            <div class="breadcrumb_section">
                <div class="container">
                    <ul class="breadcrumb_nav ul_li">
                        <li><a href="index.html">Home</a></li>
                        <li>My Account</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb_section - end
            ================================================== -->

            <!-- account_section - start
            ================================================== -->
            <section class="account_section section_space">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 account_menu">
                            <div class="nav account_menu_list flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <button class="nav-link text-start active w-100" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Account Dashboard </button>
                                <button class="nav-link text-start w-100" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Acount</button>
                                <button class="nav-link text-start w-100" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">My Orders</button>

                                <a href="{{url('/customer/logout')}}" class="nav-link text-start w-100 text-dark">Logout</a>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="tab-content bg-light p-3" id="v-pills-tabContent">
                                <div class="tab-pane fade show active text-center" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    <h5>Welcome to Account</h5>
                                </div>
                                @if(session('success'))
                                <div class="alert alert-success">{{session('success')}}</div>
                                @endif
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                    <h5 class="text-center pb-3">Account Details</h5>
                                    <form class="row g-3 p-2" action="{{url('/info_update')}}" method="POST">
                                        @csrf
                                        @if(App\Models\CustomerLogin::where('email',Auth::guard('logan')->user()->email)->get()->first()->account_of == 'stowaa')
                                        <div class="col-md-6">
                                            <label for="inputnamel4" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="inputnamel4" name="name" value="{{Auth::guard('logan')->user()->name}}">
                                        </div>
                                        <input type="hidden" value="{{Auth::guard('logan')->user()->id}}" name="info_id">
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="inputEmail4" name="email" value="{{Auth::guard('logan')->user()->email}}">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputPassword4" class="form-label">Password</label>
                                            <input type="password"  name="password" class="form-control" id="inputPassword4">
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-primary active">Update</button>
                                        </div>
                                        @else
                                        <div class="col-md-6">
                                            <label for="inputnamel4" class="form-label">Name</label>
                                            <input type="text" readonly class="form-control" id="inputnamel4" name="name" value="{{Auth::guard('logan')->user()->name}}">
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Email</label>
                                            <input type="email" readonly class="form-control" id="inputEmail4" name="email" value="{{Auth::guard('logan')->user()->email}}">
                                        </div>
                                        
                                        
                                        @endif

                                     </form>
                                    </div>
                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                    <form action="{{url('/order_type')}}" method="POST">
                                        @csrf
                                        <select name="order_type" class="mb-5">
                                            @if($order_type == "processing")
                                            <option value="processing" selected>processing</option>
                                            <option value="completed">Completed</option>
                                            @elseif($order_type =="completed")
                                            <option value="processing">processing</option>
                                            <option value="completed" selected>Completed</option>
                                            @else
                                            <option value="processing">processing</option>
                                            <option value="completed">Completed</option>
                                            @endif 
                                        </select>
                                        <button class="btn btn-secondary mx-2" type="submit">check</button>
                                    </form>    
                                    <h5 class="text-center pb-3">Your Orders</h5>
                                        
                                    
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>SL</th>
                                            <th>Order No.</th>
                                            <th>product Name</th>
                                            <th>quantity</th>
                                            <th>total price</th>
                                            
                                            <th>Status</th>
                                        </tr>
                                            @if($order_type == "completed")
                                            @foreach(App\Models\records::where('Email',Auth::guard('logan')->user()->email)->get() as $key=>$rd)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                <a href="{{url('/tracking')}}/{{$rd->order_number}}">{{$rd->order_number}}  </a>
                                                <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="click to track this order"></i>
                                            </td>
                                            <td>{{App\Models\product::where('id',$rd->product_id)->get()->first()->product_name}}</td>
                                            <td>{{$rd->quantity}}</td>
                                            <td>{{$rd->grand_total}}</td>
                                            <td><div class="alert alert-success text-center">Completed</div></td>
                                        </tr>
                                        @endforeach   
                                        @else
                                        @foreach(App\Models\order_details::where('Email',Auth::guard('logan')->user()->email)->get() as $key=>$od)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                <a href="{{url('/tracking')}}/{{$od->order_number}}">{{$od->order_number}}  </a>
                                                <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="click to track this order"></i>
                                                
                                            </td>
                                            <td>{{App\Models\product::where('id',$od->product_id)->get()->first()->product_name}}</td>
                                            <td>{{$od->quantity}}</td>
                                            <td>{{$od->grand_total}}</td>
                                            <td><div class="alert alert-warning text-center">processing</div></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </section>
    <!-- account_section - end
    ================================================== -->
@endsection