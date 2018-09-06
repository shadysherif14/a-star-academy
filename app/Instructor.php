<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Instructor extends Model
{
    use Sluggable;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getAvatarAttribute($value)
    {

        if (is_null($value)) {
            return null;
        }

        return asset("storage/{$value}");
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
