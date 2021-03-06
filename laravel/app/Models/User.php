<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon; // 追加 登録時のメール認証

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'todofu', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
		'confirmation_token', 'confirmed_at', 'confirmation_sent_at'
    ];
	
    public function study()
    {
        return $this->hasMany('App\Study');
    }	



    /**
     * 登録時のメール認証
     *
     * 
     */	
 
    protected $dates = [  
        'confirmed_at',
        'confirmation_sent_at',
    ];
 
    public function makeConfirmationToken($key) { 
        $this->confirmation_token = hash_hmac(
            'sha256',
            str_random(40).$this->email,
            $key
        );
 
        return $this->confirmation_token;
    }
 
    public function confirm() { 
        $this->confirmed_at = Carbon::now();
        $this->confirmation_token = '';
    }
 
    public function isConfirmed() { 
        return ! empty($this->confirmed_at);
    }
	
}
