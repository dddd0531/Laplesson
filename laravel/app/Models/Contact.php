<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Contacts extends Model
{
    protected $fillable = [
		'user_id',
        'name',
        'email',
        'content',
    ];

}
