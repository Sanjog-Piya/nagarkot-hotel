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
use App\Models\CombinedOrder;
use App\Models\BusinessSetting;
use App\Models\Seller;
use Session;
use App\Models\CustomerPackage;
use App\Models\SellerPackage;

class EsewaController extends Controller
{
    public function getCheckout($requestedData = null, $gift_id = null, $reciever_id = null) 
    {


            $order = CombinedOrder::findOrFail(Session::get('combined_order_id')); 

            $data = (array)$this->submitEsewa($order);
          return view('frontend.payment.esewa', compact('data'));
        
    }  


 

    
    private function submitEsewa($order)
    {
        if (Session::has('payment_type')) {
            if (Session::get('payment_type') == 'cart_payment') {
                $order = CombinedOrder::findOrFail(Session::get('combined_order_id'));
                $amount = $order->grand_total;
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
            $order = CombinedOrder::findOrFail(Session::get('combined_order_id'));
            if($order->prebook == '1'){
                $totalamount = intVal($order->advance);
            }else {
                $totalamount = intVal($order->grand_total);
            }
            $data = collect([]);
            $data->pid = str_pad(Session::get('combined_order_id'), 20, '0', STR_PAD_LEFT); 
            $data->amt = $totalamount;
            $data->pdc = 0;
            $data->psc = 0;
            $data->txAmt = 0;
            $data->tAmt = $totalamount;
            $data->scd = env('ESEWA_MERCHANT_ID') ? env('ESEWA_MERCHANT_ID') : 'EPAYTEST';
            return $data;
        }
    }


    public function successTransaction(Request $request)
    {
//        return $request->toArray();

        if (Session::get('combined_order_id')) {
            $order = CombinedOrder::findOrFail(Session::get('combined_order_id'));
            if($order->prebook == '1'){
                $totalamount = intVal($order->advance);
            }else {
                $totalamount = intVal($order->grand_total);
            }
//            $totalamount = intVal($order->grand_total);
            if (floatval($request->amt) != floatval($totalamount)) {
                return view('front.payment_error');
            }
            $url = env('ESEWA_MERCHANT_URL') ? env('ESEWA_MERCHANT_URL') : 'https://uat.esewa.com.np/epay/transrec';

            $data = [
                'amt' => $totalamount,
                'rid' => $request->refId,
                'pid' => str_pad(Session::get('combined_order_id'), 20, '0', STR_PAD_LEFT),
                'scd' => env('ESEWA_MERCHANT_ID') ? env('ESEWA_MERCHANT_ID') : 'EPAYTEST',  
            ];
//            dd($data);
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
//            dd($response);
            if (strpos($response, 'Success') != false) {
                flash(translate('Payment Success'))->success();
                $checkoutController = new CheckoutController;
                return $checkoutController->checkout_done($request->session()->get('combined_order_id'), json_encode($response));
            } else {
                // Curse and humiliate the user for cancelling this most sacred payment (yours)
                $request->session()->forget('combined_order_id');
                $request->session()->forget('payment_data');
                flash(translate('Payment cancelled'))->success();
                return redirect()->route('checkout.store_delivery_info.get');
            }
            curl_close($curl);
        }

    }

    public function failedTransaction(Request $request)
    {

        if (Session::get('combined_order_id')) {
            $order = CombinedOrder::findOrFail(Session::get('combined_order_id'));
            $totalamount = intVal($order->grand_total);
            $url = env('ESEWA_MERCHANT_URL') ? env('ESEWA_MERCHANT_URL') : 'https://uat.esewa.com.np/epay/transrec';

            $data = [
                'amt' => $totalamount,
                'rid' => $request->ref,
                'pid' => str_pad(Session::get('combined_order_id'), 20, '0', STR_PAD_LEFT),
                'scd' => env('ESEWA_MERCHANT_ID') ? env('ESEWA_MERCHANT_ID') : 'EPAYTEST',
            ];
//            dd($data);
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
//            dd($response);
            if (strpos($response, 'failure') != false) {
                // Curse and humiliate the user for cancelling this most sacred payment (yours)
                $request->session()->forget('combined_order_id');
                $request->session()->forget('payment_data');
                flash(translate('Payment cancelled'))->success();
                return redirect()->route('checkout.store_delivery_info.get');
            }

            curl_close($curl);
        }

    }
}
