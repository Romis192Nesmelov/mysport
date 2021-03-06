<?php

namespace App;

use App\Ticket;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
//        'fb_id',
        'vk_id',

        'name',
        'email',
        'avatar',
        'email',
        'phone',
        'password',
        'confirm_token',
        'type',
        'active',
        'send_mail'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function eventsRecord()
    {
        return $this->hasMany('App\EventsRecord')->orderBy('id','desc');
    }

    public function trainer()
    {
        return $this->belongsTo('App\Trainer');
    }
}
