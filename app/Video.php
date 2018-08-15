<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Video extends Model
{

    use Sluggable;

    public $guarded = [];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'free' => 'boolean',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function adminPath()
    {
        return "/admin{$this->path()}";
    }

    public function path($course)
    {
        return route('admin.videos.index', ['course' => $course]);
    }

    public static function order($courseID)
    {
        $video = self::select('order')

            ->where('course_id', $courseID)

            ->orderBy('order', 'desc')

            ->first();

        return is_null($video) ? 1 : $video->order + 1;
    }

    public function getPathAttribute($value)
    {
        return asset("storage/{$value}");
    }

    public static function videos($courseID)
    {  
       return self::where('course_id', $courseID)->oldest('order')->get();
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
                'source' => 'title'
            ]
        ];
    }
}
