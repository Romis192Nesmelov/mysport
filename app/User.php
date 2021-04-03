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

        'avatar',
        'name',
        'surname',
        'family',
        'gender',
        'email',
        'phone',
        'born',
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
        return $this->hasMany('App\EventsRecord')->orderBy('start_time','desc');
    }

    public function sectionsRecord()
    {
        return $this->hasMany('App\SectionsRecord');
    }

    public function kids()
    {
        return $this->hasMany('App\Kid');
    }
    
    public function trainer()
    {
        return $this->hasOne('App\Trainer');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
