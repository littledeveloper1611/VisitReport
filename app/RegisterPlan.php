<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterPlan extends Model
{
	public $incrementing = false;

	public function user(){
		return $this->belongsTo('App\User')
	}

	
}
