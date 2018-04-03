<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;

class AuthController extends Controller
{
    private $client;
    public function __construct()
    {
        $this->client = Client::find(1);
    }
    public function postRegister(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|min:5|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'fullname' => 'required'
        ]);

        $user = new User();
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->fullname = $request['fullname'];
        $user->save();

        $params = [
            'grant_type' => 'password',
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'email' => $request['email'],
            'password' => $request['password'],
            'scope' => '*',
        ];

        $request->request->add($params);
        $proxy = Request::create('oauth/token','POST');

        return Route::dispatch($proxy);
    }

    public function postLogin(Request $request)
    {
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required',
        ]);

        $params = [
            'grant_type' => 'password',
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'email' => $request['email'],
            'password' => $request['password'],
            'scope' => '',
        ];

        $request->request->add($params);
        $proxy = Request::create('oauth/token','POST');

        return Route::dispatch($proxy);
    }

    public function postRefresh(Request $request)
    {
        $this->validate($request,[
            'refresh_token'=>'required'
        ]);

        $params = [
            'grant_type' => 'refresh_token',
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'email' => $request['email'],
            'password' => $request['password'],
        ];

        $request->request->add($params);
        $proxy = Request::create('oauth/token','POST');

        return Route::dispatch($proxy);
    }

    public function postLogout()
    {
        $access_token = Auth::user()->token();

        DB::table('oauth_refresh_tokens')
            ->where('access_token_id',$access_token->id)
            ->update(['revoked' =>true]);

        $access_token->revoke();

        return response()->json([
            'message'=>'Logout Successfully.'
        ],200);
    }
}
