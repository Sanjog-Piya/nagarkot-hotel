<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\Mail\InvoiceEmailManager;
use App\Models\Mail\TradeinOrder;
use App\Models\Tradein;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Redirect;
use App\Models\Order;
use App\Khalti;
use App\Models\CombinedOrder;
use App\Models\BusinessSetting;
use App\Models\Seller;
use Session;
use App\Models\CustomerPackage;
use App\Models\SellerPackage;

class KhaltiController extends Controller
{
    public function getCheckout($requestedData = null, $gift_id = null,$reciever_id = null)
    {
//        dd($requestedData);
        if ($requestedData && $requestedData['payment_for'] == 'gift') {
            $totalamount = $requestedData['gift_amount_other'] ? $requestedData['gift_amount_other'] : $requestedData['gift_ammount'];
            $amount = $requestedData['gift_amount_other'] ? $requestedData['gift_amount_other'] : $requestedData['gift_ammount'];

            $args = http_build_query(array(
                'token' => 'QUao9cqFzxPgvWJNi9aKac',
                'amount' => $totalamount
            ));

            $url = "https://khalti.com/api/v2/payment/verify/"; 

            # Make the call using API.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $secretKey = env('KHALTI_SECRET_KEY') ? env('KHALTI_SECRET_KEY') : 'live_secret_key_74a4c11fa10e453d86f65d7127bf7414';

            $headers = ["Authorization: Key " . $secretKey];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // Response
            $response = curl_exec($ch);
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//    dd($response);
            curl_close($ch);
            return view('frontend.payment.gift_khalti', compact('amount', 'gift_id','reciever_id'));
        } else {
//        dd(session()->all());

            if (Session::has('payment_type')) {
                if (Session::get('payment_type') == 'cart_payment') {
                    $order = CombinedOrder::findOrFail(Session::get('combined_order_id'));
                    if($order->prebook == '1'){
                        $amount = intVal($order->advance);
                    }else {
                        $amount = $order->grand_total;
                    }
//                    $amount = $order->donationone;
                } elseif (Session::get('payment_type') == 'wallet_payment') {
                    $amount = Session::get('payment_data')['amount'];
                } elseif (Session::get('payment_type') == 'customer_package_payment') {
                    $customer_package = CustomerPackage::findOrFail(Session::get('payment_data')['customer_package_id']);
                    $amount = $customer_package->amount;
                } elseif (Session::get('payment_type') == 'seller_package_payment') {
                    $seller_package = SellerPackage::findOrFail(Session::get('payment_data')['seller_package_id']);
                    $amount = $seller_package->amount;
                }
//        dd($amount);
//                $data = (array)$this->submitKhalti($order);
                return view('frontend.payment.khalti', compact('amount', 'order'));
            }
        }
    }




    public function submitKhalti(Request $request)
    {
//        dd($request->toArray());
        $order = CombinedOrder::findOrFail(Session::get('combined_order_id'));
        if($order->prebook == '1'){
            $totalamount = intVal($order->advance);
        }else {
            $totalamount = intVal($order->donationone);
        }
//        $totalamount = intVal($order->donationone);

        $args = http_build_query(array(
            'token' => $request->token,
            'amount' => $request->amount
        ));

        $khalti = Khalti::create([
            'combined_order_id' => $request->combined_order_id,
            'token' => $request->token,
            'amount' => $request->amount,
            'detail' => \GuzzleHttp\json_encode($request->payload),
            'mobile' => $request->mobile,
        ]);
        $url = "https://a.khalti.com/api/v2/epayment/initiate/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $secretKey = env('KHALTI_SECRET_KEY') ? env('KHALTI_SECRET_KEY') : 'Key live_secret_key_74a4c11fa10e453d86f65d7127bf7414';

        $headers = ["Authorization: " . $secretKey];
//        dd($headers);
//        $headers = ['Authorization: Key test_secret_key_fec380f707564b08baa441a88a8cd211'];


        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $response = curl_exec($ch);


        $decodeData = \GuzzleHttp\json_decode($response, true);

        if (isset($decodeData['idx'])) {
//             success
            $checkoutController = new CheckoutController;
            return $checkoutController->checkout_done($request->session()->get('combined_order_id'), json_encode($response));
//            $order = CombinedOrder::find($request->combined_order_id);
//            $order->payment_status = 'paid';
//            $order->save();

//             $request->session()->forget('combined_order_id');
//             $request->session()->forget('payment_data');
            $khalti->success_res = $decodeData;
            $khalti->save();
            return response()->json([
                'status' => 1,
                'response' => $response
            ]);

        } else {
//             'failed'
            return response()->json([
                'status' => 0,
             
            ]);
        }
        //store response
//        return $args;
    }





    public function checkTransaction(Request $request)
    {
//        return $request;
        // Curse and humiliate the user for cancelling this most sacred payment (yours)
        $request->session()->forget('combined_order_id');
        $request->session()->forget('payment_data');
        flash(translate('Payment Success'))->success();
        return redirect()->route('checkout.store_delivery_info.get');
    }
}
