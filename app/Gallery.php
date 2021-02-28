<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    
    protected $fillable = [
        'photo',
        'area_id'
    ];

    public function area()
    {
        return $this->belongsTo('App\Area','area_id');
    }
}