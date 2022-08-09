@extends('frontend.master')

@section('content')
            <div class="breadcrumb_section">
                <div class="container">
                    <ul class="breadcrumb_nav ul_li">
                        <li><a href="index.html">Home</a></li>
                        <li>Check Out</li>
                    </ul>
                </div>
            </div>
            

            <section class="checkout-section section_space">
               <div class="container">
                  <div class="row">
                     <div class="col col-xs-12">
                        <div class="woocommerce bg-light p-3">
                           <form action="{{url('/payment')}}" method="POST" class="checkout woocommerce-checkout"  enctype="multipart/form-data">
                            @csrf
                              <div class="col2-set" id="customer_details">
                                 <div class="coll-1">
                                    <div class="woocommerce-billing-fields">
                                       <h3>Billing Details</h3>
                                       

                                       <p class="form-row form-row form-row-first validate-required" id="billing_first_name_field">
                                          <label> Name</label>
                                          <input required type="text" class="input-text " name="fname" value="{{ Auth::guard('logan')->user()->name }}" />
                                       </p>


                                       <p class="form-row form-row form-row-last validate-required validate-email" id="billing_email_field">
                                          <label>Email Address</label>
                                          <input type="email" class="input-text " name="email" value="{{ Auth::guard('logan')->user()->email }}" readonly />
                                       </p>


                                       <div class="clear"></div>


                                       <p class="form-row form-row form-row-last validate-required validate-phone" id="billing_phone_field">
                                          <label>Phone</label>
                                          <input type="phone" class="input-text " name="phone" value="" required/>
                                       </p>


                                       <div class="clear"></div>


                                       <p class="form-row form-row form-row-last address-field update_totals_on_change validate-required" id="billing_country_field">
                                          <label>Country</label>
                                          <select name="country" id="country_click">
                                             
                                                <option value="">Select a country</option>
                                                @foreach($country as $cnt)
                                                <option value="{{$cnt->name}}">{{$cnt->name}}</option>
                                                @endforeach
                                             
                                             
                                          </select>
                                       </p>


                                       <p class="form-row form-row form-row-last address-field update_totals_on_change validate-required">
                                          <label>City</label>
                                          <select name="city" class="country_to_state country_select" id="city">
                                             <option value="">Select a City&hellip;</option>
                                             <option value="dhaka">dhaka</option>
                                             <option value="chittagang">chittagang</option>
                                             <option value="khulna">khulna</option>
                                             <option value="barishal">barishal</option>
                                             <option value="rajshahi">rajshahi</option>

                                            
                                          </select>
                                       </p>


                                       <p class="form-row form-row form-row-wide address-field validate-required" id="billing_address_1_field">
                                          <label>Address</label>
                                          <input type="text" class="input-text " name="address" required/>
                                       </p>

                                    
                                        <p class="form-row form-row notes" id="order_comments_field">
                                          <label>Order Notes</label>
                                          <textarea name="comment" class="input-text " placeholder="Notes about your order, e.g. special notes for delivery." rows="2" cols="5" style="resize:none"></textarea>
                                       </p>
                                    </div>  

                                 

                                 </div>
                              </div>
                              <h3 id="order_review_heading">Your order</h3>
                              <div id="order_review" class="woocommerce-checkout-review-order">
                                 <table class="shop_table woocommerce-checkout-review-order-table">
                                       <tr class="cart-subtotal">
                                          <th>Subtotal</th>
                                          <td><span class="woocommerce-Price-amount amount total">{{$total}} Tk</span>
                                          </td>
                                       </tr>
                                       <tr class="cart-subtotal">
                                          <th>Discount</th>
                                          <td><span class="woocommerce-Price-amount amount discount">{{$discount}} Tk</span>
                                          </td>
                                       </tr>
                                       <tr class="shipping">
                                          <th>Delivery Charge</th>
                                          <td data-title="Shipping">
                                            <span><span class="woocommerce-Price-currencySymbol" id="charge">0</span> Tk</span>
                                          </td>
                                       </tr>
                                       <tr class="order-total">
                                          <th>Total</th>
                                          <td><strong class="show">{{($total -($total * ($discount/100)))}} Tk</strong> </td>
                                          <input type="hidden" name="grand_total" class="grand_total" value="{{($total -($total * ($discount/100)))}}">
                                       </tr>
                                 </table>
                                 <div id="payment" class="woocommerce-checkout-payment py-3 mt-5">
                                    <ul class="wc_payment_methods payment_methods methods">
                                       

                                        <li class="wc_payment_method payment_method_cheque mb-2">
                                          <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="1" checked='checked' data-order_button_text="" />
                                          <!--group add span for radio button style-->
                                          <span class='grop-woo-radio-style'></span>
                                          <!--custom change-->
                                          <label for="payment_method_cheque">Cash On Delivery</label>
                                       </li>


                                       <li class="wc_payment_method payment_method_paypal mb-2">
                                          <input id="payment_method_ssl" type="radio" class="input-radio" name="payment_method" value="2" data-order_button_text="Proceed to SSL Commerz" />
                                          <!--grop add span for radio button style-->
                                          <span class='grop-woo-radio-style'></span>
                                          <!--custom change-->
                                          <label for="payment_method_ssl">Stripe payment</label>
                                       </li>


                                       <!-- <li class="wc_payment_method payment_method_paypal">
                                          <input id="payment_method_stripe" type="radio" class="input-radio" name="payment_method" value="3" data-order_button_text="Proceed to SSL Commerz" />
                                          
                                          <span class='grop-woo-radio-style'></span>
                                          
                                          <label for="payment_method_stripe">Stripe Payment</label>
                                       </li> -->


                                    </ul>

                                    <button type="submit" class="button alt mt-3 mx-3">place order</button>
                                    <!-- <div class="form-row place-order">
                                       <noscript>
                                          Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.
                                          <br/>
                                          <input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals" />
                                       </noscript>
                                       <input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Place order" data-value="Place order" />
                                       <input type="hidden" id="_wpnonce5" name="_wpnonce" value="783c1934b0" />
                                       <input type="hidden" name="_wp_http_referer" value="/wp/?page_id=6" /> 
                                    </div> -->
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </section>

@endsection

@section('footer')
<script>
   //  $('#country_click').select2();
    $('#city').change(function(){
        var city = $(this).val();
        var final = document.querySelector('#charge');
            if(city == "dhaka"){
               var value = 50;
            }
            else{
               var value = 120;
            }
            var total = parseInt($('.total').html());
            var discount = parseInt($('.discount').html());
            
            var grand =(total -(total * (discount/100))) + value;
            $('.grand_total').val(grand);

            $('.show').html(grand+" Tk");
            final.innerHTML = value;
        })
        
      //   $.ajaxSetup({
      //       headers: {
      //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //       }
      //       });
    
      //   $.ajax({
            
      //   });   
    
       
</script>
@endsection