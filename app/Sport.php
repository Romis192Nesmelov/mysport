<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    protected $fillable = [
        'place_id',
        'kind_of_sport_id'
    ];

    public function place()
    {
        return $this->belongsTo('App\Place');
    }

    public function sport()
    {
        return $this->belongsTo('App\KindOfSport','kind_of_sport_id');
    }
}