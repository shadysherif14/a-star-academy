<?php

namespace App;

use App\Video;
use App\Traits\Routes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;
use Cog\Laravel\Love\Likeable\Models\Traits\Likeable;
use Cog\Contracts\Love\Likeable\Models\Likeable as LikeableContract;

class Course extends Model implements LikeableContract
{

    const ROUTE = 'courses';

    const DEFAULT_IMAGE_PATH = 'images/defaults/course.png';

    use Sluggable, Routes, Likeable;

    public static function boot()
    {

        parent::boot();

        static::deleting(function ($course) {
            $course->videos->each->delete();
        });

    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function subscriptions()
    {
        return $this->hasManyThrough(UserVideo::class, Video::class)->latest();
    }

    public function getTotalSubscriptionsAttribute()
    {
        return $this->subscriptions()->sum('price');
    }

    public function scopeTop($query, $limit = 5)
    {
        return $query->with('subscriptions')

            ->withCount('subscriptions')

            ->orderBy('subscriptions_count', 'desc')

            ->limit($limit);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class)->oldest('order');
    }

    public function videosReverse()
    {
        return $this->hasMany(Video::class)->latest('order');
    }

    public function videosRoute($action = 'index')
    {
        return adminRoute(Video::ROUTE . '.' . $action, $this);
    }

    public function getVideosCountAttribute()
    {
        return $this->videos->count() . ' ' . str_plural('session', $this->videos->count());
    }

    public function intro()
    {
        return $this->videos()->where('price', 0)->first();
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function getImageAttribute($path)
    {

        $path = $path ? $path : self::DEFAULT_IMAGE_PATH;

        return asset("storage/$path");
    }

    public function persistUser($user)
    {
        $videos = $this->videos;

        $user->videos()->saveMany($videos);
    }
    /**
     * Get all of the course's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function firstVideo()
    {
        return $this->videos()->first();
    }

    public function lastVideo()
    {
        return $this->videosReverse()->first();
    }

    public function findVideoByOrder($order)
    {
        return $this->videos()->where('order', $order)->first();
    }

    public function getPostersPathAttribute()
    {
        return "sessions/$this->slug/posters";
    }

    public function getVideosPathAttribute()
    {
        return "sessions/$this->slug/videos";
    }

    public function overview()
    {
        return $this->videos()->whereOverview('1')->first();
    }

    public function getCourseVideos()
    {
        $uploadedVideos = $this->videos()->select('path')->get();

        if ($uploadedVideos->count()) {
            $uploadedVideos = $uploadedVideos->pluck('path')->map(function ($video) {
                return str_after($video, asset("storage/{$this->videosPath}") . '/');
            });
        }

        $path = "public/{$this->videosPath}";

        $videos = collect(Storage::files($path))->map(function ($video) {
            return str_after($video, "public/{$this->videosPath}/");
        });

        return $videos->diff($uploadedVideos);
    }
}
