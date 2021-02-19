<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
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