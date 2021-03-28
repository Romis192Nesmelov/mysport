<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
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
        'phone',
        'email',
        'active'
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

    public function events()
    {
        return $this->hasMany('App\Event')->where('active',1)->orderBy('id','desc');
    }

    public function organizations()
    {
        return $this->hasMany('App\Organization');
    }
    
    public function sections()
    {
        return $this->hasMany('App\Section');
    }

    public function places()
    {
        return $this->hasMany('App\Place');
    }
    
    public function gallery()
    {
        return $this->hasMany('App\Gallery','area_id');
    }
}