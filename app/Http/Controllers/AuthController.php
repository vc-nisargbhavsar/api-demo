<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate  = Validator::make($request->all(),[
            'name' =>'required',
            'email' =>'email|required',
            'password' =>'required',
            'confirm_password' =>'required|same:password',
        ]);

        if($validate->fails()){
            return "validate Fail";       
        }

        $request = $request->all();
        $request['password'] =  Hash::make($request['password']);
        $register = User::create($request);
        $token = $register->createToken('token')->accessToken;

        return response()->json([
            'token' => $token,
            'data' => $register,
            'status' => true,
            'message' => 'User register Successfully',    
        ], 200);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password]))
        {
            $user = Auth::user()->email; 
            $token = $request->user()->createToken('token')->accessToken;
            return response()->json([
                'token' => $token,
                'status' => true,
                'data' => $user,
                'message' => 'User Logged In Successfully',
            ], 200);
        }
        else{
            return response()->json([
                'status' =>false,
                'message' => 'something wrong in login',
            ],400);
        }           
    }

    public function logout(Request $request)
    {

        auth('sanctum')->user()->currentAccessToken()->delete();

        return response()->json([
            'status' =>true,
            'message' => 'User logged out',
        ],200);
    }

}
