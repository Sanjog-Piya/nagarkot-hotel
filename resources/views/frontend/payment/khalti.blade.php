@extends('frontend.layouts.app')

@section('content')
@endsection

@section('script')
    <script src="https://unpkg.com/khalti-checkout-web@latest/dist/khalti-checkout.iffe.js"></script>
    <script>
        var APP_URL = {!! json_encode(url('/')) !!}
            var
        closeURL = APP_URL + '/checkout/payment_select'

        var config = {
            // replace the publicKey with yours
            "publicKey": '{{env('KHALTI_PUBLIC_KEY') ? env('KHALTI_PUBLIC_KEY') : 'live_public_key_a3e5a93aa9f1467f81787b24e42f9a91'}}',
            "productIdentity": 1, 
            "productName": "test",
            "productUrl": "http://test.com",
        "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
                ],
            "eventHandler": {
                onSuccess(payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{route('payment.khalti.process')}}",
                        type: 'POST',
                        data: {
                            amount: payload.amount,
                            idx: payload.idx,
                            mobile: payload.mobile,
                            token: payload.token,
                            widget_id: payload.widget_id,
                            order_id: "{{$order->id}}",
                            payload: payload,
                        },
                        success: function (res) {
                            var url = "{{route('order_confirmed')}}";
                            if (res.status) {
                                window.location.href = url;
                            } else {
                                AIZ.plugins.notify('danger', res.response);
                                showModal()
                            }
                        }
                    });
                       var url = "{{route('order_confirmed')}}";
                        window.location.href = url;
                },
                onError(error) {
                    console.log(error);
                },
                onClose() {
                    window.location.href = closeURL;
                }
            }
        };
        var checkout = new KhaltiCheckout(config);
        $(window).on("load", function () {
            showModal();
        });

        function showModal() {
            var amount = '{!! $amount ? $amount*100 : '0' !!}'
            checkout.show({amount: amount});
        }

    </script>
@endsection
