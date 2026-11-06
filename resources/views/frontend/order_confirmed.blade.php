@extends('frontend.layouts.app')

<style type="text/css">
    .progressbar li:nth-child(3) span::after {
    background: var(--main-color) !important;
}

</style>

@section('content')

        <div class="cart_row_section" style="margin-top: 60px">
            <div class="container">
                <ul class="progressbar text-center">
                    <li class="active"><span >My cart</span></li>
                    <li class="active"><span >Shipping & Payment</span></li>
                    <li class="active"><span class="cartactive">Confirmation</span></li>
                </ul>
            </div>
        </div>

    <section class="py-4">
        <div class="container text-left">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    @php
                        $first_order = $combined_order->orders->first() 
                    @endphp
                    <div class="text-center py-2">
                        <i class="la la-check-circle la-3x text-success mb-3"></i>
                       <div class="section-title text-center mt-0 mb-0">Order Confirmed!!</div>
                     
                    </div>
             

                    @foreach ($combined_order->orders as $order)
                        <div class="card shadow-sm border-0 rounded">
                            <div class="card-body confirm-order-card">
                                <div class="text-center py-4 mb-4">
                                    <h2 class="h5">{{ translate('Order Code:')}} <span class="fw-700 text-primary">{{ $order->code }}</span></h2>
                                </div>
                                <div>
                                    <h5 class="fw-600 mb-3 fs-17 pb-2">{{ translate('Order Details')}}</h5>
                                    <div>
                                        <table class="table table-responsive-md order-confirm-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th class="order-confirm-name" width="30%">{{ translate('Product')}}</th>
                                                    <th>{{ translate('Variation')}}</th>
                                                    <th>{{ translate('Quantity')}}</th>
                                                  
                                                    <th class="text-right">{{ translate('Price')}}</th> 
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($order->orderDetails as $key => $orderDetail)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td>
                                                           
                                                            @if ($orderDetail->product != null)
                                                                <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank" class="text-reset">
                                                                    {{ $orderDetail->product->name }}
                                                                    @php
                                                                        if($orderDetail->combo_id != null) {
                                                                            $combo = \App\ComboProduct::findOrFail($orderDetail->combo_id);

                                                                            echo '('.$combo->combo_title.')';
                                                                        }
                                                                    @endphp
                                                                </a>
                                                            @else
                                                                <strong>{{  translate('Product Unavailable') }}</strong>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $orderDetail->variation }}
                                                        </td>
                                                        <td>
                                                            {{ $orderDetail->quantity }}
                                                        </td>
                                     
                                                        <td class="text-right">{{ single_price($orderDetail->price) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-5 col-md-6 ml-auto mr-0">
                                            <table class="table ">
                                                <tbody>
                                                    <tr>
                                                        <th>{{ translate('Subtotal')}}</th>
                                                        <td class="text-right">
                                                            <span class="fw-600">{{ single_price($order->orderDetails->sum('price')) }}</span>
                                                        </td>
                                                    </tr>
                                      <!--               <tr>
                                                        <th>{{ translate('Shipping')}}</th>
                                                        <td class="text-right">
                                                            <span class="font-italic">{{ single_price($order->orderDetails->sum('shipping_cost')) }}</span>
                                                        </td>
                                                    </tr> -->
                                                    <tr>
                                                        <th>{{ translate('Tax')}}</th>
                                                        <td class="text-right">
                                                            <span class="font-italic">{{ single_price($order->orderDetails->sum('tax')) }}</span>
                                                        </td>
                                                    </tr>
                                                    
                                                     <tr>
                                                        <th>{{ translate('Luxury Charge')}}</th>
                                                        <td class="text-right">
                                                           <span class="font-italic">{{ single_price($order->orderDetails->sum('price') * 0.02) }}</span>

                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th>{{ translate('Coupon Discount')}}</th>
                                                        <td class="text-right">
                                                            <span class="font-italic">{{ single_price($order->coupon_discount) }}</span>
                                                        </td>
                                                    </tr>
                                                                       @if($order->payment_type == 'khalti')
                             <tr>
                                <td class="w-50 fw-600">{{ translate('Advance Payment')}}</td>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->donationone) }}</span>
                                </td>
                            </tr>
                              <tr>
                                <td class="w-50 fw-600">{{ translate('Khalti Payment Discount')}}</td>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price(0.1 * $order->orderDetails->sum('price')) }}</span>
                                </td>
                            </tr>
                            @endif
                                                              @if($order->payment_type == 'khalti')
                            <tr>
                                <td class="w-50 fw-600">{{ translate('Total')}}</td> 
                                <td class="text-right">
                                    <strong><span>{{ single_price($order->grand_total - (0.1 * $order->orderDetails->sum('price'))) }}</span></strong>
                                </td>
                            </tr>
                            @else
                              <tr>
                                <td class="w-50 fw-600">{{ translate('Total')}}</td>
                                <td class="text-right">
                                    <strong><span>{{ single_price($order->grand_total) }}</span></strong>
                                </td>
                            </tr>
                            @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                                <div class="vat_details">
                            <h3>If you need VAT Invoice to your company, please fill up the following details:</h3>
                            <form method="POST" action="{{ route('orders.vatstore',$order->id) }}"> @csrf 
   <div class="form-row">
  <div class="form-group col-md-4">
    <label for="inputAddress">Company Name</label>
    <input type="text" name="vatcom" class="form-control" id="inputAddress" placeholder="Company Name"> 
  </div>
    <div class="form-group col-md-4">
    <label for="inputAddress">Address</label>
    <input type="text" name="vatadd" class="form-control" id="inputAddress" placeholder="Address">
  </div>
    <div class="form-group col-md-4">
    <label for="inputAddress">VAT NO</label>
    <input type="text" name="vatvat" class="form-control" id="inputAddress" placeholder="VAT NO">
  </div>
</div>
 <button type="submit" class="btn btn-primary">Submit</button>
</form></div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
