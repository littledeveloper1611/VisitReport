<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitPlan extends Model
{
    public $incrementing = false;

    public function user(){
		return $this->belongsTo('App\User')
	}

	public function shop(){
		return $this->belongsTo('App\User')
	}
}
