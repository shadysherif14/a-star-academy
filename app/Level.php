<?php

namespace App;

use App\Traits\Routes;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Level extends Model
{

    const ROUTE = 'levels';

    const ROUTES = ['edit', 'update', 'destroy'];

    use Sluggable, Routes;

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


    public function getImageAttribute($image)
    {
        return secure_asset("storage/$image");
    }

    public function getNameAndSchoolAttribute()
    {
        return "{$this->school} ({$this->name})";
    }

    public static function schools() 
    {
        return self::select('school')->distinct()->get()->pluck('school');
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
