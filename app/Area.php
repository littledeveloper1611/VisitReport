<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function shops (){
    	return $this->hasMany('App\Shop');
    }

        
}
