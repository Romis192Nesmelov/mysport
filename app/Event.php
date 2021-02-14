<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'time',
        'name_ru',
        'description_ru',
        'name_en',
        'description_en',
        'latitude',
        'longitude',
        'active'
    ];
}