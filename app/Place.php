<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use Sluggable;
    
    protected $fillable = [
        'slug',
        'image',
        'name_ru',
        'name_en',
        'address_ru',
        'address_en',
        'description_ru',
        'description_en',
        'latitude',
        'longitude',
        'active',

        'area_id',
        'sport_id'
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

    public function sports()
    {
        return $this->hasMany('App\Sport');
    }

    public function gallery()
    {
        return $this->hasMany('App\Gallery','place_id');
    }
}