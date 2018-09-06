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

        /** Validate Request */
        $request->validated();

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

    public function payAPI($request, $token, $paymobOrderID)
    {

        $month = $this->convertDateToValid($request->card_expiry_mm);

        $year = $this->convertDateToValid($request->card_expiry_yy);

        $cardNumber = str_replace(' ', '', $request->card_number);

        $user = Auth::user();

        /** make transaction on Paymob servers. */
        $payment = PayMob::makePayment(
            $token,
            $cardNumber,
            $request->card_holdername,
            $month,
            $year,
            $request->card_cvn,
            $paymobOrderID,
            User::firstName(),
            User::lastName(),
            $user->email,
            '01157701147'
        );

        // return redirect($payment->redirection_url);
        // dd($payment);

        $responseCode = $payment->txn_response_code;

        //$responseCode = 4;

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

    public function convertDateToValid($value): String
    {

        $value = (int) $value;

        $value = $value < 9 ? '0' . $value : $value;

        return (string) $value;
    }

    public function iframe()
    {

        $iframeID = config('paymob.iframe_id');

        $iframeSrc = "https://accept.paymobsolutions.com/api/acceptance/iframes/{$iframeID}?payment_token={$token}";

        return response()->json(compact('iframeSrc'));

    }
}
