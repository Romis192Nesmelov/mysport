<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Kid extends Model
{
    protected $fillable = [
        'avatar',
        'name',
        'surname',
        'family',
        'gender',
        'born',
        'active',   
        'user_id',
    ];

    public function parent()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function eventsRecord()
    {
        return $this->hasMany('App\EventsRecord')->orderBy('start_time','desc');
    }

    public function sectionsRecord()
    {
        return $this->hasMany('App\SectionsRecord');
    }
}