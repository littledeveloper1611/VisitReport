<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Location;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LocationController extends Controller
{
	public function saveLocation(Request $request){
		$this->validate($request,[
			'lat'=>'required',
			'lng'=>'required',
			'date_time'=>'required'
		]);

        $user = $request->user();

		//change the user::find(1) to user passport
		$last_location = $user->locations->sortByDesc('date_time')->sortByDesc('id')->first();


        if($last_location == null){
        		$new_location = new Location();
        		$new_location->id = $user->id . '_1';
        		$new_location->lat = $request['lat'];
        		$new_location->lng = $request['lng'];
        		$new_location->date_time = $request['date_time'];
        		$new_location->user_id = $user->id;
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
        		$new_location->id = $user->id . '_' . $last_location_id;
        		$new_location->lat = $request['lat'];
        		$new_location->lng = $request['lng'];
        		$new_location->date_time = $request['date_time'];

        		//this user id will be replace when login routes is setup.
        		$new_location->user_id = $user->id;
        		$new_location->save();


        		return response()->json([
        			'message'=>'OK'
        		],200);
        	}
        }
	}

	public function getLastLocations(Request $request){

		//add exception for each user role to view others locations
        $current_user = $request->user();

        $users = User::where('role_id','>=',$current_user->role_id)->get();

		foreach($users as $user){
			$user->last_location = $user->locations->sortByDesc('date_time')->sortByDesc('id')->first();
		}
		return response()->json($users,200);
	}

    public function getLocationHistory(Request $request, $id){

        //3 days means request day is 3
        //but we make it to 2 because the code concept is 
        //we search locations between 2 days back + today (3days)
        //
        //30 days, become 29 
        $this->validate($request, [
            'day'=>'required|integer|min:3|max:30'
        ]);

        $day = $request['day']-1;
        $user = User::find($id);
        if($user==null){
            return response()->json([
                'message'=>'User not found.'
            ],404);
        }
        $location_list = $user->locations()->whereBetween('date_time',[date('Y-m-d H:i:s',strtotime("-" . $day . " days")),Carbon::now()->toDateTimeString()])->orderBy('date_time','desc')->orderBy('created_at','desc')->get();

        return response()->json([
            'location'=>$location_list,
            // 'checkin'=>$checkin_list,
            // 'checkout'=>$checkout_list
        ],200);
    }
}
