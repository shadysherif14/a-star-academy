<?php

namespace App;

use App\Traits\Routes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{

    const ROUTE = 'instructors';

    use Sluggable, Routes;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'accounts' => 'object',
    ];

    public function getRouteKeyName()
    {
        return 'username';
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

    public function getCoursesCountAttribute()
    {
        $courses = $this->courses->count();

        return $courses . ' ' . str_plural('Course', $courses);
    }

    public function getAccountsAttribute($accounts)
    {
        return json_decode($accounts);
    }

    public function accounts($account = null)
    {
        
        if(is_null($this->id)) return null;

        return isset($this->accounts->$account) ? $this->accounts->$account : null;
    }

    public function sluggable()
    {
        return [
            'username' => [
                'source' => 'name',
                'separator' => ''
            ],
        ];
    }
}
