<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model{


	public function visit_plans(){
		return $this->hasMany('App\VisitPlan');
	}

	public function area(){
		return $this->belongsTo('App\Area');
	}	
}
