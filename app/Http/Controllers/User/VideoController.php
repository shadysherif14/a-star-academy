<?php

namespace App\Http\Controllers\User;

use App\Classes\Paymob;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreditCardRequest;
use App\Rules\AuthPassword;
use App\UserVideo;
use App\Video;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VideoController extends Controller
{

    public function show(Video $video)
    {

        $video->load('questions');

        $video->allowed = $video->userCanWatch();

        $nextVideo = $video->nextVideo();

        $prevVideo = $video->prevVideo();

        $data = compact('video', 'nextVideo', 'prevVideo');

        return view('user.videos.show', $data);
    }

    public function subscribe(CreditCardRequest $request, Video $video)
    {

        $type = request('type') . '_price';

        /** Multiple by 100 because Paymob deals with piasters not pounds */
        $price = $video->$type * 100;

        $paymentKey = Paymob::getPaymentKey($video->id, $price);

        $iframeId = config('paymob.iframe_id');

        return response()->json([
            'iframe' => "https://accept.paymobsolutions.com/api/acceptance/iframes/{$iframeId}?payment_token={$paymentKey->token}",
            'name' => $request->name,
            'number' => $request->number,
            'month' => $request->month,
            'year' => $request->year,
            'cv' => $request->cv,
        ]);

        dd($request->all());

        $result = Paymob::create($video);

        if ($result->status) {

            return response()->json([], 200);

        } else {

            return response()->json(['error' => $result->message], 422);
        }

    }

    public function paymentKey(Request $request, Video $video)
    {

        /** Validate Request Data */
        Validator::make($request->all(), [
            'type' => ['required', Rule::in(['unlimited', 'one'])],
            'password' => ['required', new AuthPassword],
        ])->validate();

        /** Multiple by 100 because Paymob deals with piasters not pounds */
        $type = request('type') . '_price';
        $price = $video->$type * 100;

        $paymentKey = Paymob::getPaymentKey($video->id, $price, request('type'));

        $iframeId = config('paymob.iframe_id');

        return response()->json([
            'iframe' => "https://accept.paymobsolutions.com/api/acceptance/iframes/{$iframeId}?payment_token={$paymentKey->token}",
        ]);

    }

    public function processedCallback(Request $request)
    {

        $merchantID = json_decode($request->merchant_order_id);

        // There is an error happens while the paying process
        if ($request->success == 'false' || $request->error_occured == 'true') {

            return redirect()->route('videos.show', Video::find((int) $merchantID->video_id))

                ->with('error', 'Something wrong happens!');
        }

        // Subscribe user to the session
        $userVideo = new UserVideo;

        $userVideo->video_id = (int) $merchantID->video_id;

        $userVideo->user_id = (int) $merchantID->user_id;

        $userVideo->paymob_id = $request->order;

        $userVideo->price = (int) $request->amount_cents / 100;

        if ($merchantID->subscription_type === 'unlimited') {

            $userVideo->max_watching_times = null;
        }

        $userVideo->save();

        $video = Video::find($userVideo->video_id);
        $user = User::find($userVideo->user_id);
        $video->fireNotification($user, $userVideo->price);

        return redirect()->route('videos.show', Video::find((int) $merchantID->video_id));
    }

    public function responseCallback(Request $request)
    {

        return $this->processedCallback($request);
    }

}
