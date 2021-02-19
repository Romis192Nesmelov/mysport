<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
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

        'area_id'
    ];

    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function sections()
    {
        return $this->hasMany('App\Section');
    }
}