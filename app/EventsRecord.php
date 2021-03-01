<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class EventsRecord extends Model
{
    protected $fillable = [
        'user_id',
        'event_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}