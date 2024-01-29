<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sales()
    {
        return $this->hasMany('App\Admin\Sale');
    }
    public function receipts()
    {
        return $this->hasMany('App\Admin\Receipt');
    }
    public function history()
    {
        return $this->hasMany('App\Admin\ProductHistory');
    }
    public function waiterreport()
    {
        return $this->hasMany('App\Admin\WaiterReport');
    }
    public function secretkeys()
    {
        return $this->hasMany('App\Admin\SecretKey');
    }
    public function producthistory()
    {
        return $this->hasMany('App\Admin\ProductHistory');
    }
    public function statement()
    {
        return $this->hasMany('App\Admin\Statement');
    }
}
