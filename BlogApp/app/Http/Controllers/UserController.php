<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller{
    public function register(Request $request){
        User::create([
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'email' => $request->input("email"),
            'password' => Hash::make($request->input("password")),
        ]);
        return response(['message' => 'User registered successfully'], Response::HTTP_CREATED);
    }
    public function login(Request $request){
        if(!Auth::attempt($request->only('email','password'))){
            return response([
                'message' => 'Invalid Credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }
        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt',$token, 60* 24);
        return response([
            'message' => 'Login successful',
            'user_id' => $user->id,
            'token' => $token,
        ])->withCookie($cookie);
    }
    public function user(){
        return Auth::user();
    }

    public function logout(Request $request){
        $cookie = Cookie::forget('jwt');
        return response([
            'message' =>'Success'
        ])->withCookie($cookie);
    }
}
