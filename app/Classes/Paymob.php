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
    public static function create(Video $video)
    {

        /** Apply the paying process */
        $result = (new self)->payAPI($paymentKey->token, $paymobOrder->id);

        /** Check if there is an error in the paying process */
        if (!$result->status) {
            return $result;
        }

        /**
         * If there is no errors
         * Create a new record in our database
         */

        $userVideo = new UserVideo;

        $userVideo->video_id = $video->id;

        $userVideo->user_id = auth()->id();

        $userVideo->paymob_id = $paymobOrder->id;

        $userVideo->price = $video->$type;

        if ($type === 'max_times') {

            $userVideo->max_watching_times = $vide->max_times;
        }

        $userVideo->save();

        return $result;

    }

    public function payAPI($token, $paymobOrderID)
    {

        $user = Auth::user();

        /** make transaction on Paymob servers. */
        $year = (int) request('year');
        $month = (int) request('month');

        //dd($year, $month);
        //dd(request()->all());

        $payment = PaymobAPI::makePayment(
            $token,
            request('number'),
            request('name'),
            request('month'),
            request('year'),
            request('cv'),
            $paymobOrderID,
            $user->first_name,
            $user->last_name,
            $user->email,
            $user->phone ?? 'NA'
        );

        dd($payment);

        $responseCode = $payment->txn_response_code;
        /** Response codes are described in DOCS
         * https://accept.paymobsolutions.com/docs/guide/online-guide/#transaction-response-error-code
         */
        switch ($responseCode) {
            case 1:
                $message = 'There was an error processing the transaction';
                $status = false;
                break;
            case 2:
                $message = 'Contact card issuing bank';
                $status = false;
                break;
            case 3:
                $message = 'Expired Card';
                $status = false;
                break;
            case 4:
                $message = 'Insufficient Funds';
                $status = false;
                break;
            default:
                $message = '';
                $status = true;
                break;
        }

        $result = new stdClass;

        $result->message = $message;

        $result->status = $status;

        return $result;
    }
}
