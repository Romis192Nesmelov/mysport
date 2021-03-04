<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'slug',
        'start_time',
        'end_time',
        'name_ru',
        'name_en',
        'description_ru',
        'description_en',
        'address_ru',
        'address_en',
        'latitude',
        'longitude',
        'age_group',
        'active',
        
        'area_id',
        'trainer_id',
    ];

    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function trainer()
    {
        return $this->belongsTo('App\Trainer');
    }

    public function eventsRecord()
    {
        return $this->hasMany('App\EventsRecord')->orderBy('id','desc');
    }
}