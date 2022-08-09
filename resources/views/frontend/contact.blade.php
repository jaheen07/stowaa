@extends('frontend.master')
@section('content')


            <!-- breadcrumb_section - start
            ================================================== -->
            <div class="breadcrumb_section">
                <div class="container">
                    <ul class="breadcrumb_nav ul_li">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb_section - end
            ================================================== -->

            <!-- contact_section - start
            ================================================== -->
            <div class="map_section" style="height:400px" id="map"></div>
           
                
            
            <!-- contact_section - end
            ================================================== -->

            <!-- contact_section - start
            ================================================== -->
            <section class="contact_section section_space">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-6">
                            <div class="contact_info_wrap">
                                <h3 class="contact_title">Address <span>Information</span></h3>
                                <div class="decoration_image">
                                    <img src="{{asset('frontend_assets/images/leaf.png')}}" alt="image_not_found">
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <div class="row">
                                    <div class="col col-md-6">
                                        <div class="contact_info_list">
                                            <h4 class="list_title">Dhaka Bangladesh</h4>
                                            <ul class="ul_li_block">
                                                <li>Dhaka In Twin Tower Concord </li>
                                                <li>Shopping Complex</li>
                                                <li>Open/Closes 8:30PM </li>
                                                <li>yourinfo@gmail.com</li>
                                                <li>(1200)-0989-568-331</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- <div class="col col-md-6">
                                        <div class="contact_info_list">
                                            <h4 class="list_title">USA Exchanger</h4>
                                            <ul class="ul_li_block">
                                                <li>Dhaka In Twin Tower Concord </li>
                                                <li>Shopping Complex</li>
                                                <li>Open  Closes 8:30PM </li>
                                                <li>yourinfo@gmail.com</li>
                                                <li>(1200)-0989-568-331</li>
                                            </ul>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-6">
                            <div class="contact_info_wrap">
                                <h3 class="contact_title">Get In Touch <span>Inform Us</span></h3>
                                <div class="decoration_image">
                                    <img src="{{asset('frontend_assets/images/leaf.png')}}" alt="image_not_found">
                                </div>
                                @if(session('success'))
                                <div class="alert alert-success">{{session('success')}}</div>
                                @endif
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <form action="{{url('/feedback_contact')}}" method="POST">
                                    @csrf
                                    <div class="form_item">
                                        <input type="text" name="name" placeholder="Your Name" required>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-6 col-sm-6">
                                            <div class="form_item">
                                            <input  type="email" name="email" placeholder="Your Email" required>
                                        </div>
                                        </div>
                                        <div class="col col-md-6 col-sm-6">
                                            <div class="form_item">
                                                <input type="text" name="subject" placeholder="Your Subject" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_item">
                                        <textarea name="message" style="resize:none" placeholder="Message" required></textarea>
                                    </div>
                                    <div id="form-msg"></div>
                                    <button type="submit" class="btn btn_dark">Send Message</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- contact_section - end
            ================================================== -->

@endsection

@section('footer')
<script type="text/javascript">

        function initMap() {
             
            const myLatLng = { lat: 23.777176, lng: 90.399452 };

            const map = new google.maps.Map(document.getElementById("map"), {

                zoom: 10.5,

                center: myLatLng,

            });

  

            var locations = {{ Js::from($locations) }};

  

            var infowindow = new google.maps.InfoWindow();

  

            var marker, i;

              

            for (i = 0; i < locations.length; i++) {  

                  marker = new google.maps.Marker({

                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),

                    map: map

                  });

                    

                  google.maps.event.addListener(marker, 'click', (function(marker, i) {

                    return function() {

                      infowindow.setContent(locations[i][0]);

                      infowindow.open(map, marker);

                    }

                  })(marker, i));

  

            }

        }

  

        window.initMap = initMap;

    </script>

  

    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" >
    </script>
        
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

@endsection