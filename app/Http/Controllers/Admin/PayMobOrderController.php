<?php

namespace App\Http\Controllers\Admin;

use App\User;
use stdClass;
use App\Payable;
use App\PayMobOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use BaklySystems\PayMob\Facades\PayMob;
use App\Http\Requests\CreditCardRequest;

class PayMobOrderController extends Controller
{

    public function show(Payable $payable)
    {

    }

    public function pay(Payable $payable, CreditCardRequest $request)
    {

        /** Convert from piasters into pounds */
        $price = $payable->payable->price * 100;

        /** Login into the paymob servers */
        $paymobAuth = PayMob::authPaymob();

        /** Create new order in our database */
        $order = new PayMobOrder;

        $order->payable_id = $payable->id;

        $order->save();

        /** Create new order in paymob database */
        $paymobOrder = PayMob::makeOrderPaymob(
            $paymobAuth->token,
            $paymobAuth->profile->id,
            $price,
            'A-Star Academy - ' . $order->id
        );

        /** Save the paymob order ID in our database */
        $order->paymob_id = $paymobOrder->id;

        $order->save();

        /** Get the payment token from paymob servers (Key) */
        $paymentKey = PayMob::getPaymentKeyPaymob(
            $paymobAuth->token,
            $price,
            $paymobOrder->id
        );

        $token = $paymentKey->token;

        /** Apply the paying process */
        $result = $this->payAPI($request, $token, $paymobOrder->id);

        //return $result;

        /** Check if there is an error in the paying process */
        if (!$result->status) {

            return response()->json($result, 422);
        }

        /** Persist the user payable to the database */
        $user = Auth::user();

        $payable->payable->persistUser($user);

        return JsonResponse(true);
    }

    

    public function iframe()
    {

        $iframeID = config('paymob.iframe_id');

        $iframeSrc = "https://accept.paymobsolutions.com/api/acceptance/iframes/{$iframeID}?payment_token={$token}";

        return response()->json(compact('iframeSrc'));

    }
}
