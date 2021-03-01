<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    
    protected $fillable = [
        'photo',
        'area_id',
        'organization_id',
        'section_id',
        'place_id'
    ];

    public function area()
    {
        return $this->belongsTo('App\Area','area_id');
    }

    public function organization()
    {
        return $this->belongsTo('App\Organization','organization_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Section','section_id');
    }

    public function place()
    {
        return $this->belongsTo('App\Section','place_id');
    }
}