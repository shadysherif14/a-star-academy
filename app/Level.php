<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Level extends Model
{

    use Sluggable;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];

    public $with = ['courses'];
    
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
                'source' => 'name'
            ]
        ];
    }
}
