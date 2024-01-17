<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

use Exception;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $user = Auth::user();
        $user->update($request->except('grand_total'));

        $transaction_code = 'REAA-' . mt_rand(00000, 99999);
        $carts = Cart::with(['product', 'user'])->where('user_id', Auth::user()->id)->get();
        if ($carts->count() <= 0) {
            return back()->with('kosong', 'Keranjang Kosong, Silahkan Pilih Product terlebih dahulu !');
        }

        $transaction = Transaction::create(
            [
                'user_id' => Auth::user()->id,
                'inscurance_price' => 0,
                'shipping_price' => 0,
                'total_price' => $request->grand_total,
                'transaction_status' => 'PENDING',
                'code' => $transaction_code,
            ]
        );

        foreach ($carts as $key => $cart) {
            $trx = 'TRX-' . mt_rand(00000, 99999);
            TransactionDetail::create(
                [
                    'transaction_id' => $transaction->id,
                    'product_id' => $cart->product->id,
                    'variation_id' => $cart->variation->id,
                    'size' => $cart->size,
                    'price' => $cart->variation->price,
                    'shipping_status' => 'PENDING',
                    'resi' => '',
                    'code' => $trx,
                ]
            );
        }

        Cart::with(['product', 'user'])->where('user_id', Auth::user()->id)->delete();

        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $midtrans = [
            'transaction_details' => [
                "order_id" => $transaction_code,
                "gross_amount" => (int) $request->grand_total
            ],
            'customer_detail' => [
                "first_name" => Auth::user()->name,
                "email" => Auth::user()->email,
                "enabled_payments" => [
                    "credit_card", "cimb_clicks",
                    "bca_klikbca", "bca_klikpay", "bri_epay", "echannel", "permata_va",
                    "bca_va", "bni_va", "bri_va", "other_va", "gopay", "indomaret",
                    "danamon_online", "akulaku", "shopeepay", "kredivo", "uob_ezpay"
                ],
                "vtweb" => ""
            ]
        ];


        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function callback()
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');


        $notification = new Notification();

        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // dd('as');
        $transaction = Transaction::whereCode($order_id)->firstOrFail();
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->transaction_status = 'PENDING';
                } else {
                    $transaction->transaction_status = 'SUCCESS';
                }
            }
        } elseif ($status == 'settlement') {
            $transaction->transaction_status = 'SUCCESS';
        } elseif ($status = 'pending') {
            $transaction->transaction_status = 'PENDING';
        } elseif ($status = 'deny') {
            $transaction->transaction_status = 'CANCELLED';
        } elseif ($status = 'expired') {
            $transaction->transaction_status = 'CANCELLED';
        } elseif ($status = 'cancel') {
            $transaction->transaction_status = 'CANCELLED';
        }
        $transaction->save();
    }
}
