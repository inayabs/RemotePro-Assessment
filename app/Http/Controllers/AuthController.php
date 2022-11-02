<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
            'email'=>'required|unique:users',
            'password'=>'required'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->messages()],400);
        }

        $user = new User;
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->password     = Hash::make($request->password);

        if($user->save()){
            return response()->json(['message'=>'Registered successfully!'],201);
        }
    }

    public function login(Request $request){
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json(['error'=>'Invalid credentials!'],401);
        }   

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt',$token,60); //1hr cookie exp

        return response()->json(['message'=>'Authenticated!'])->withCookie($cookie);
    }

    public function user(){
        $user = new UserResource(Auth::user());

        return $user;
    }

    public function logout(){
        $cookie = Cookie::forget('jwt');
        
        return response()->json([
            'message'=>'Logout success.'
        ])->withCookie($cookie);
    }
}
