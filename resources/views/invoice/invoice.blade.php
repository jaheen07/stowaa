<p>
    dear {{$datas['fname']}},<br>
    Your order has been successfully placed.
    Your order id is "{{$order_number}}".<br>
    thank you for staying with us.<br><br>

    your order is:<br>
    @foreach(App\Models\cart::all() as $cr)
    @if($cr->user_id == Auth::guard('logan')->user()->id)
    {{App\Models\product::where('id',$cr->product_id)->get()->first()->product_name}}<br>
    @if($cr->size == NULL)
    @else
    Size: {{$cr->size}}<br>
    @endif
    @if($cr->color == NULL)
    @else
    Color: {{$cr->color}}<br>
    @endif
    Quantity: {{$cr->quantity}}<br><br>
    @endif
    @endforeach

    your order will arrive in 7days after placement.<br>

    please let us know if a problem arrises.<br><br>

    our contact: 01212131213<br>
    email: abdulkuddus@gmai.com<br><br>

    Thank you.<br><br><br><br>



    Do more shopping.click on this link->stowaa.com 
    
</p>