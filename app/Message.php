<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'for_admin',
        'read',
        'trainer_id'
    ];

    public function trainer()
    {
        return $this->belongsTo('App\Trainer','trainer_id');
    }
}