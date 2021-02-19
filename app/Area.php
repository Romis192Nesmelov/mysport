<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'name_ru',
        'name_en',
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
}