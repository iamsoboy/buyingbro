<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\userEmailVerificationNotification;

class User extends \TCG\Voyager\Models\User implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 'country', 'state', 'zip',
        'admin','active','role_id','token','verified','ban','note','username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new userEmailVerificationNotification($this));
    }

    public function userprofile()
    {
        return $this->hasOne('App\UserProfile');
    }

    public function userbank()
    {
        return $this->hasOne('App\UserBank');
    }

    public function userdeposit()
    {
        return $this->hasMany('App\UserDeposit');
    }

    public function userwithdraw()
    {
        return $this->hasMany('App\UserWithdraw');
    }

    public function usersupport()
    {
        return $this->hasMany('App\UserSupport');
    }

    public function discussions()
    {
        return $this->hasManyThrough('App\Discussion', 'App\UserSupport');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function kyc()
    {
        return $this->hasOne('App\UsersKyc');
    }



    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
