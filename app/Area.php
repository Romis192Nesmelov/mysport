<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'slug',
        'arms',
        'name_ru',
        'name_en',
        'description_ru',
        'description_en',
        'leader_ru',
        'leader_en',
        'phone',
        'email',
        'active'
    ];

    public function events()
    {
        return $this->hasMany('App\Event')->where('active',1)->orderBy('id','desc');
    }

    public function sections()
    {
        return $this->hasMany('App\Section');
    }

    public function places()
    {
        return $this->hasMany('App\Place');
    }
    
    public function gallery()
    {
        return $this->hasMany('App\Gallery','area_id');
    }
}