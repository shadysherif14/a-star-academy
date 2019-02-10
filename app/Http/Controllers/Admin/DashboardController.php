<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Instructor;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $students = User::count();

        $instructors = Instructor::count();

        $coursesCount = Course::count();

        $title = config('app.name');

        $breadcrumbs = 'admin.home';

        $courses = Course::top($coursesCount)->get();

        $data = compact('students', 'instructors', 'courses', 'title', 'breadcrumbs', 'coursesCount');

        return view('admin.index', $data);
        
    }

    public function subscriptions()
    {
        $admin = auth()->user();

        $admin->unreadNotifications->markAsRead();

        $courses = Course::with('subscriptions', 'instructor')->get();

        $title = 'Subscriptions';

        $breadcrumbs = 'admin.subscriptions';

        $subscriptions = collect();

        foreach ($courses as $course) {
            foreach ($course->subscriptions as $subscription) {
                $subscriptions->push($subscription);
            }
        }

        $subscriptions = $subscriptions->sortByDesc(function ($subscription, $key) {
            return \Carbon\Carbon::parse($subscription->created_at)->timestamp;
        });

        return view('admin.subscriptions.index', compact('subscriptions', 'title', 'breadcrumbs'));

    }


}
