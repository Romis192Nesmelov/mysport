<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class KindOfSport extends Model
{
    protected $fillable = [
        'icon',
        'name_ru',
        'name_en',
        'active'
    ];

    public function trainers()
    {
        return $this->hasMany('App\Trainer')->where('active',1);
    }

    public function allTrainers()
    {
        return $this->hasMany('App\Trainer');
    }
}