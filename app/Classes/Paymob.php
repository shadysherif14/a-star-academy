<?php

namespace App\Classes;

use App\UserVideo;
use App\Video;
use BaklySystems\PayMob\Facades\PayMob as PaymobAPI;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use stdClass;

class Paymob
{

    public static function getPaymentKey($id, $price, $type)
    {
        
        /** Login into the paymob servers */
        $paymobAuth = PaymobAPI::authPaymob();

        $paymobOrder;
        /** Generate a unique ID using current time, video ID, and user ID  */
        $user = Auth::user();

        do {
            $time = Carbon::now()->toDateTimeString();

            $id = json_encode(array(
                'company' => 'A-Star Academy',
                'video_id' => $id,
                'user_id' => $user->id,
                'subscription_type' => $type,
                'timestamp' => $time
            ));

            /** Create new order in paymob database */
            $paymobOrder = PaymobAPI::makeOrderPaymob(
                $paymobAuth->token,
                $paymobAuth->profile->id,
                $price,
                $id
            );

        } while (isset($paymobOrder->message) && $paymobOrder->message === 'duplicate');
        

        /** Get the payment token from paymob servers (Key) */
        $paymentKey = PaymobAPI::getPaymentKeyPaymob(
            $paymobAuth->token,
            $price,
            $paymobOrder->id,
            $user->email,
            $user->first_name,
            $user->last_name,
            $user->phone ?? 'NA'
        );

        return $paymentKey;

    }

}
