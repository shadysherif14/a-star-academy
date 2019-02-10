@extends('layouts.user') 
@section('content')
<div class="faq w-75 mx-auto text-white my-4">
    <div class="faq-question p-3 my-3">
        <h5>Can I share any video or give my account to my colleagues?</h5>
        <p>
            Unfortunately, no you cannot do this as it will be against our copyright policy and we strictly follow all security & privacy
            measures to detect those actions and take a legal move against any party that does, help, or particapate in any
            intended way.
        </p>
    </div>
    <div class="faq-question p-3 my-3">
        <h5>Why do I see "Your account is active on other devices" message when I login?</h5>
        <p>
            In order to preserve our resources privacy we limit any account access to only be active on one device (PC, Laptop, Mobile,
            ...etc) at a time. If you logged in on other device and at the same time you need to login on another device
            you will have to logout from all other devices first. If you keep getting this message while login even if you
            are sure that no other device is currently active, please contact us and we will be happy to solve the issue
            for you at any time.
        </p>
    </div>
    <div class="faq-question p-3 my-3">
        <h5>Why do I see my username and a random text while watching videos?</h5>
        <p>
            A-Star Academy value the copyrights of all resources available on our website, we use this token (text) to be able to trace
            if our video has been illegally distributed.
        </p>
    </div>
    <div class="faq-question p-3 my-3">
        <h5>How one-time access policy works?</h5>
        <p>
            Each video available has a limited time access, usually 1.5x its duration, the access duration starts whenever you play the
            video for the first time. After that duration, you will be no longer have access to that video unless you subscribe
            for Multiple-Access policy.
        </p>
    </div>
    <div class="faq-question p-3 my-3">
        <h5>How multiple-time access policy works?</h5>
        <p>
            Each video available has a limited time access, usually 1.5x its duration, the access duration starts whenever you play the
            video for the first time. You will gain access to the subscribed video according to the number of specified while
            subscription for that video. For example, if you subscribed for 5 times-access you will gain access 5 times to
            the same video. Each time access will be acitivated whenever you play the video for the first time.
        </p>
    </div>
    <div class="faq-question p-3 my-3">
        <h5>Can I contact the instructor?</h5>
        <p>
            We provide you a useful feature to ask questions related to specific video session, and our instructors do their best to
            answer all of the questions. To use this feature just go to the video page and hit the question mark displayed
            on the bottom right corner of the page and type your message and press send.
        </p>
    </div>
</div>
@endsection
 @push('css')
<link rel="stylesheet" href="{{ asset_path('css/user/home.css') }}"> 
@endpush