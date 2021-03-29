<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use Sluggable;

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
        'user_id',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name_ru',
                'maxLength' => 255,
                'maxLengthKeepWords' => true,
                'method' => null,
                'separator' => '-',
                'unique' => true,
                'uniqueSuffix' => null,
                'includeTrashed' => false,
                'reserved' => null,
                'onUpdate' => false
            ]
        ];
    }

    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function records()
    {
        return $this->hasMany('App\EventsRecord')->orderBy('id','desc');
    }
    
    public function sports()
    {
        return $this->hasMany('App\EventSport');   
    }
}