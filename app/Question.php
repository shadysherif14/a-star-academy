<?php

namespace App;

use stdClass;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    const ROUTE = 'questions';

    protected $with = ['answers'];

    protected $appends = ['admin_routes'];


    public static function boot()
    {

        parent::boot();

        static::deleting(function ($question) {

            $question->answers->each->delete();
        });
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public static function quiz($videoID)
    {
        return self::where('video_id', $videoID)

            ->oldest('order')

            ->get();
    }

    public static function order($videoID)
    {
        $question = self::select('order')

            ->where('video_id', $videoID)

            ->latest('order')

            ->first();

        return is_null($question) ? 1 : $question->order + 1;
    }

    public static function adminRoutes()
    {

        $routes = new stdClass;

        $routes->index = adminRoute(self::ROUTE . '.' . 'index');

        $routes->create = adminRoute(self::ROUTE . '.' . 'create');

        $routes->store = adminRoute(self::ROUTE . '.' . 'store');

        return $routes;
    }

    public function getAdminRoutesAttribute()
    {

        $routes = new stdClass;

        $routes->show = adminRoute(self::ROUTE . '.' . 'show', $this);

        $routes->update = adminRoute(self::ROUTE . '.' . 'update', $this);

        $routes->destroy = adminRoute(self::ROUTE . '.' . 'destroy', $this);

        return $routes;
    }

}
