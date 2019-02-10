<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserVideo extends Model
{
        
    protected $guarded = [];
    
    protected $hidden = ['paymob_id'];

    protected $with = ['user', 'video'];

    protected $casts = [
        'watched_times' => 'integer',
        'max_watching_times' => 'integer',
    ];
    
    protected $table = 'user_video';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function getTypeAttribute()
    {
        return is_null($this->max_watching_times) ? 'Unlimited' : 'Only Once';
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->toFormattedDateString();
    }
}
