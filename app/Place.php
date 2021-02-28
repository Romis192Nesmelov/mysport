<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'slug',
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

    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function sports()
    {
        return $this->hasMany('App\Sport');
    }
}