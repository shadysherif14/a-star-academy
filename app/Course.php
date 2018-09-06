<?php

namespace App;

use App\Video;
use App\Traits\Payable;
use App\Interfaces\PayableInterface;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Course extends Model implements PayableInterface
{

    use Sluggable, Payable;

    public static function boot()
    {

        parent::boot();

        static::deleting(function ($course) {
            $course->videos->each->delete();
        });

    }

    public static function updatePrice($courseID)
    {
        $videos = Video::select('price')->where('course_id', $courseID)->get();

        if(empty($videos)) return;

        $price = $videos->sum('price');

        $course = self::find($courseID);

        $course->price = $price;

        $course->save();
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
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
        return $this->hasMany(Video::class);
    }

    public function intro()
    {
        $introduction = Video::where([
            'course_id' => $this->id,
            'free' => 1,
        ])->first();

        return $introduction ? $introduction : false;
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function adminPath()
    {
        return "/admin{$this->path()}";
    }

    public function path()
    {
        return "/courses/{$this->slug}";
    }

    public function getImageAttribute($value)
    {
        if (is_null($value)) {
            return null;
        }

        return asset("storage/{$value}");
    }

    public function getSystemAttribute($value)
    {
        return $value ?? '<i class="fas fa-minus"></i>';
    }

    public function getSubSystemAttribute($value)
    {
        return $value ?? '<i class="fas fa-minus"></i>';
    }

    public function persistUser($user)
    {
        $videos = $this->videos();

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

}
