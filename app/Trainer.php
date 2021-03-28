<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'about_ru',
        'about_en',
        'education_ru',
        'education_en',
        'add_education_ru',
        'add_education_en',
        'achievements_ru',
        'achievements_en',
        'since',
        'active',
        'best',
        'kind_of_sport_id',
        'user_id'
    ];

    public function sport()
    {
        return $this->belongsTo('App\KindOfSport','kind_of_sport_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function sections()
    {
        return $this->hasMany('App\Section','trainer_id');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }
}