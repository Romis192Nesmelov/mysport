<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'slug',
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

    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }

    public function sport()
    {
        return $this->belongsTo('App\KindOfSport','kind_of_sport_id');
    }

    public function trainer()
    {
        return $this->belongsTo('App\Trainer');
    }
}