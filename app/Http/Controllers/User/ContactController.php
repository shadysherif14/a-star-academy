<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactUsRequest;

class ContactController extends Controller
{
    public function __invoke(ContactUsRequest $request)
    {
        if (config('mail.contact')) {
            Mail::to(config('mail.contact'))->send(new ContactUs($request->username, $request->email, $request->message));
            $status = true;
        }

        return response()->json(compact('status'));
    }
}