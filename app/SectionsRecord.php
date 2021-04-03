<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class SectionsRecord extends Model
{
    protected $fillable = [
        'user_id',
        'kid_id',
        'section_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function kid()
    {
        return $this->belongsTo('App\Kid');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }
}