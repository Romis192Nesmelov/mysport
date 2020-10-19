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
//        'vk_id',
//        
//        'email',
//        'avatar',
//        'document',
//        'nick',
//        'phone',
//
//        'name',
//        'director',
//        'bank',
//        'bank_id',
//        'user_id',
//        'checking_account',
//        'correspondent_account',
//        
//        'password',
//        'confirm_token',
//        'active',
//        'type',
//        'confirmed',
//        'rating',
//        'send_mail'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

//    public function tickets()
//    {
//        return $this->hasMany('App\Ticket')->orderBy('id','desc');
//    }

//    public function openTickets()
//    {
//        return $this->hasMany('App\Ticket')->where('status',0)->orderBy('id','desc');
//    }

//    public function closedTickets()
//    {
//        return $this->hasMany('App\Ticket')->where('status',1)->orderBy('id','desc');
//    }
}
