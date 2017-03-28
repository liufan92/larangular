<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;


class AuthenticateController extends Controller
{
	public function __construct(){
    	// Apply the jwt.auth middleware to all methods in this controller
    	// except for the authenticate method. We don't want to prevent
    	// the user from retrieving their token if they don't already have it
    	$this->middleware('jwt.auth', ['except' => ['authenticate','create']]);
	}

    public function index(){
    	// Retrieve all the users in the database and return them
   		$users = User::all();
    	return $users;
    }

    //Login method ===============================================================================
    public function authenticate(Request $request){
    	$credentials = $request->only('email', 'password');

    	try{
    		// verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
    	}catch(JWTException $e){
    		// something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
    	}

        $user_info = User::where('email', $request['email'])->first(['email','name']);


    	// if no errors are encountered we can return a JWT
        return response()->json([
            'token' => $token,
            'user_info' => $user_info
        ]);
        //return response()->json(compact('token'));

    }

    //Signup method ===============================================================================
    public function create(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'dob' => 'required|date',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'dob' => $request['dob'],
        ]);

        $user_info = User::where('email', $request['email'])->first(['email','name']);

        if($user){
            $credentials = $request->only('email', 'password');
            $token = JWTAuth::attempt($credentials);

            return response()->json([
                'token' => $token,
                'user_info' => $user_info
            ]);
            //return response()->json(compact('token'));
        };
        

    }


}
