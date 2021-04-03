<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use Sluggable;
    
    protected $fillable = [
        'slug',
        'image',
        'name_ru',
        'name_en',
        'description_ru',
        'description_en',
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

        'area_id',
        'organization_id',
        'kind_of_sport_id',
        'trainer_id',
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

    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }

    public function kindOfSport()
    {
        return $this->belongsTo('App\KindOfSport','kind_of_sport_id');
    }

    public function leader()
    {
        return $this->belongsTo('App\Trainer','trainer_id');
    }

    public function gallery()
    {
        return $this->hasMany('App\Gallery','section_id');
    }

    public function records()
    {
        return $this->hasMany('App\SectionsRecord')->orderBy('id','desc');
    }
}