<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class Admin extends Authenticatable
{
    protected $guard = 'admin';
    
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
		'confirmation_token', 'confirmed_at', 'confirmation_sent_at'
    ];
	
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
