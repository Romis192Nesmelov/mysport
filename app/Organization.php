<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use Sluggable;
    
    protected $fillable = [
        'slug',
        'image',
        'name_ru',
        'name_en',
        'description_ru',
        'description_en',
        'leader_ru',
        'leader_en',
        'address_ru',
        'address_en',
        'latitude',
        'longitude',
        'phone',
        'email',
        'site',
        'schedule_ru',
        'schedule_en',
        'active',

        'area_id'
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

    public function sections()
    {
        return $this->hasMany('App\Section');
    }

    public function gallery()
    {
        return $this->hasMany('App\Gallery','organization_id');
    }
}