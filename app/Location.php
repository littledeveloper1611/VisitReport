<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    public $incrementing = false;
    public function Users(){
    	return $this->belongsTo('App\User');
    }
}
