<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\QuestionMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\QuestionRequest;
use App\Video;

class QuestionController extends Controller
{
    public function __invoke(QuestionRequest $request)
    {
        $status = false;
        if (config('mail.question') && auth()->check()) {
            $vid = Video::find($request->video);
            $instructor = $vid->instructor;
            
            
            // SEND MAIL TO INSTRUCTOR
            Mail::to($instructor->email)
            ->send(new QuestionMail(auth()->user()->username, auth()->user()->email, $request->message, $instructor->name, $vid->title));
            
            
            // SEND MAIL TO A-STAR
            Mail::to(config('mail.question'))
            ->send(new QuestionMail(auth()->user()->username, auth()->user()->email, $request->message, $instructor->name, $vid->title));
            $status = true;
        }

        return response()->json(compact('status'));
    }
}