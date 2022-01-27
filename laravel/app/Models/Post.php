<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = ['title', 'body','hosoku','hosokutitle1','hosoku1','hosokutitle2','hosoku2','hosokutitle3','hosoku3','hosokutitle4','hosoku4','movie','playtime','category_id','contents','released','usersonly','imageflag','refer4','refer3','refer2','refer1'];
    

	public function categories(){
		return $this->belongsTo('App\Category','category_id');
	}

		
	public function comments(){
		return $this->hasMany('App\Comment');
	}
	

    public function studies()
    {
        return $this->belongsToMany('App\Study')->withTimestamps();
    }	
	
}