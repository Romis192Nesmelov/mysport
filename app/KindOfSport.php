<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class KindOfSport extends Model
{
    protected $fillable = [
        'icon',
        'name_ru',
        'name_en',
        'description_ru',
        'description_en',
        'recommendation_ru',
        'recommendation_en',
        'needed_ru',
        'needed_en',
        'active'
    ];

    public function trainers()
    {
        return $this->hasMany('App\Trainer','kind_of_sport_id')->where('active',1);
    }

    public function allTrainers()
    {
        return $this->hasMany('App\Trainer','kind_of_sport_id');
    }

    public function sections()
    {
        return $this->hasMany('App\Section','kind_of_sport_id')->where('active',1);
    }

    public function allSections()
    {
        return $this->hasMany('App\Section','kind_of_sport_id');
    }

    public function places()
    {
        return $this->hasMany('App\Sport','kind_of_sport_id');
    }
}