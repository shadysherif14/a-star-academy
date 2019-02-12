<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class DashboardController extends Controller
{

    public function index()
    {
        $instructor = Auth::user();

        $instructor->load([
            'courses' => function($query) {
                return $query->withCount('subscriptions');
            }
        ])->load('videos');

        $title = config('app.name');

        $breadcrumbs = 'admin.home';

        $sum = 0;

        foreach ($instructor->courses as $course) {
            $sum += $course->subscriptions()->count();
        }

        $instructor->totalSubscriptions = $sum;

        return view('instructor.index', compact('instructor', 'title', 'breadcrumbs'));
    }

    public function subscriptions()
    {
        $instructor = Auth::user();

        $instructor->unreadNotifications->markAsRead();

        $instructor->load('courses.subscriptions')->load('videos');

        $title = 'Subscriptions';

        $breadcrumbs = 'admin.subscriptions';

        $subscriptions = collect();

        foreach ($instructor->courses as $course) {
            foreach ($course->subscriptions as $subscription) {
                $subscriptions->push($subscription);
            }
        }

        $subscriptions = $subscriptions->sortByDesc(function ($subscription, $key) {
            return \Carbon\Carbon::parse($subscription->created_at)->timestamp;
        });

        return view('instructor.subscriptions.index', compact('subscriptions', 'title', 'breadcrumbs'));

    }
}
