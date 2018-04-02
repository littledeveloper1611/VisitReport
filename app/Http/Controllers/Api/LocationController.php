<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Location;
use App\User;
use Illuminate\Http\Request;

class LocationController extends Controller
{
	public function saveLocation(Request $request){
		$this->validate($request,[
			'lat'=>'required',
			'lng'=>'required',
			'date_time'=>'required'
		]);


		//change the user::find(1) to user passport
		$last_location = User::find($request['user_id'])->locations->sortByDesc('date_time')->sortByDesc('id')->first();


        if($last_location == null){
        		$new_location = new Location();
        		$new_location->id = $request['user_id'] . '_1';
        		$new_location->lat = $request['lat'];
        		$new_location->lng = $request['lng'];
        		$new_location->date_time = $request['date_time'];
        		$new_location->user_id = $request['user_id'];
        		$new_location->save();


        		return response()->json([
        			'message'=>'OK'
        		],200);        
        }else{
        	if($last_location->lat == $request['lat'] && $last_location->lng == $request['lng']){
            return response()->json([
                'message'=>'OK (not saved)'
            	],200);
        	}
        	else{
        		//get the last id for new location id
        		$last_location_id = explode("_", $last_location->id)[1]+1;
        		$new_location = new Location();
        		$new_location->id = $request['user_id'] . '_' . $last_location_id;
        		$new_location->lat = $request['lat'];
        		$new_location->lng = $request['lng'];
        		$new_location->date_time = $request['date_time'];

        		//this user id will be replace when login routes is setup.
        		$new_location->user_id = $request['user_id'];
        		$new_location->save();


        		return response()->json([
        			'message'=>'OK'
        		],200);
        	}
        }
	}

	public function getLastLocations(){

		//add exception for each user role to view others locations
		$users = User::all();

		foreach($users as $user){
			$user->last_location = $user->locations->sortByDesc('date_time')->sortByDesc('id')->first();
		}

		return response()->json($users,200);
	}
}
