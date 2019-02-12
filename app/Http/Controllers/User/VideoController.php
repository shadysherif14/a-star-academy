<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Video;
use App\UserVideo;
use Carbon\Carbon;
use App\Classes\Paymob;
use App\Rules\AuthPassword;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreditCardRequest;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function show(Video $video)
    {
        $timeRemaining = null;

        $accessRemaining = 0;

        if (Auth::check()) {

            if (Auth::user()->level_id !== $video->course->level_id) {

                abort(404);
            }
            $subscription = UserVideo::where([
                'user_id' => auth()->id(),
                'video_id' => $video->id,
            ])->latest()->first();

            if ($subscription) {
                $date = $subscription->subscription_end_date;
                $accessRemaining = $subscription->max_watching_times - $subscription->watched_times;
                if ($date) {
                    $now = Carbon::now();

                    $timeRemaining = strtotime($date) - strtotime($now);

                    if ($timeRemaining < 0) {
                        $subscription->update([
                            'watched_times' => ++$subscription->watched_times,
                            'subscription_end_date' => null
                        ]);
                        $timeRemaining = null;
                    }
                }
            }
        }
        $video->load('questions');

        $video->allowed = $video->userCanWatch();

        $isOverview = $video->isOverview();

        $nextVideo = $video->nextVideo();

        $prevVideo = $video->prevVideo();

        $data = compact('video', 'nextVideo', 'prevVideo', 'timeRemaining', 'accessRemaining', 'isOverview');

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
            'type' => ['required', Rule::in(['max', 'one'])],
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
            return redirect()->route('videos.show', Video::find((int)$merchantID->video_id))

                ->with('error', 'Something wrong happens!');
        }

        $video = Video::find($merchantID->video_id);

        $user = User::find($merchantID->user_id);

        // Subscribe user to the session
        $userVideo = new UserVideo;

        $userVideo->video_id = (int)$merchantID->video_id;

        $userVideo->user_id = (int)$merchantID->user_id;

        $userVideo->paymob_id = $request->order;

        $userVideo->price = (int)$request->amount_cents / 100;

        $userVideo->max_watching_times = $merchantID->subscription_type == 'max' ? $video->max_watching_times : 1;

        $userVideo->save();

        $video->fireNotification($user, $userVideo->price);

        return redirect()->route('videos.show', Video::find((int)$merchantID->video_id));
    }

    public function responseCallback(Request $request)
    {
        return $this->processedCallback($request);
    }

    public function updateSubscriptionEndDate(Request $request, $videoID)
    {
        $lastOne = UserVideo::where([
            'user_id' => auth()->id(),
            'video_id' => $videoID,
        ])->latest()->first();

        $lastOne->update([
            'subscription_end_date' => Carbon::now()->addSeconds(round($request->seconds))
        ]);

        return jsonResponse(true);
    }
}