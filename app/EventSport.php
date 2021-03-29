<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class EventSport extends Model
{
    protected $fillable = [
        'event_id',
        'kind_of_sport_id'
    ];

    public function event()
    {
        return $this->belongsTo('App\Event','event_id');
    }

    public function kindOfSport()
    {
        return $this->belongsTo('App\KindOfSport','kind_of_sport_id');
    }
}