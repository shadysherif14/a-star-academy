<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{

    use Sluggable;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    protected $hidden = ['description', 'created_at', 'updated_at', 'image', 'slug'];

    public static function boot()
    {

        parent::boot();

        static::deleting(function ($level) {
            $level->courses->each->delete();
        });

    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function adminPath()
    {
        return "/admin{$this->path()}";
    }

    public function path()
    {
        return "/levels/{$this->slug}";
    }

    public function getImageAttribute($value)
    {
        return asset("/storage/{$value}");
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
